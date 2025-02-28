import joblib
import pandas as pd

def predict_workout(user_input):
    # Load model dan preprocessing tools
    model = joblib.load('workout_classification_model_rf.pkl')
    encoder = joblib.load('encoder.pkl')
    scaler = joblib.load('scaler.pkl')
    label_encoder = joblib.load('label_encoder_title.pkl')
    tfidf_vectorizer = joblib.load('tfidf_vectorizer_Desc.pkl')

    # Buat DataFrame dari input user
    user_df = pd.DataFrame([user_input])

    # Transformasi teks
    if 'Description' in user_df.columns:
        text_features = tfidf_vectorizer.transform(user_df['Description'].fillna(""))
        text_df = pd.DataFrame(text_features.toarray(), columns=tfidf_vectorizer.get_feature_names_out())
        user_df = user_df.drop(columns=['Description'])
        user_df = pd.concat([user_df.reset_index(drop=True), text_df], axis=1)

    # Encode fitur kategori
    categorical_features = ['Type', 'BodyPart', 'Level', 'Equipment']
    encoded_features = encoder.transform(user_df[categorical_features]).toarray()
    encoded_df = pd.DataFrame(encoded_features, columns=encoder.get_feature_names_out())
    user_df = user_df.drop(columns=categorical_features)
    user_df_final = pd.concat([encoded_df, user_df.reset_index(drop=True)], axis=1)

    # Scaling fitur numerik
    user_df_scaled = scaler.transform(user_df_final)

    # Prediksi
    prediction = model.predict(user_df_scaled)
    predicted_title = label_encoder.inverse_transform(prediction)

    return predicted_title[0]

# Contoh input pengguna
user_input = {
    "Description": "",
    "Type": "Stretching",
    "BodyPart": "Shoulders",
    "Level": "Beginner",
    "Equipment": "Body Only"
}

predicted_workout = predict_workout(user_input)
print(f"Prediksi Olahraga: {predicted_workout}")
