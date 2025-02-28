from pymongo import MongoClient
import pandas as pd
import joblib
from sklearn.preprocessing import OneHotEncoder

# Koneksi ke MongoDB
client = MongoClient('mongodb://localhost:27017/')
db = client['workout_db']
collection = db['workouts']

# Ambil data workout dan ubah ke DataFrame
workout_data = list(collection.find())
workout_df = pd.DataFrame(workout_data)

# Hapus kolom '_id' kalau ada
if '_id' in workout_df.columns:
    workout_df.drop('_id', axis=1, inplace=True)

# Load model, scaler, encoder, dan nama fitur
scaler = joblib.load('scaler.pkl')
model = joblib.load('workout_recommendation_model_rf.pkl')
feature_names = joblib.load('feature_names.pkl')
encoder = joblib.load('encoder.pkl')

# Contoh data pengguna
user_data = pd.DataFrame({
    'age': [25],
    'height': [170],
    'weight': [70],
    'activity_level': [3],
    'Type': ['Strength'],
    'BodyPart': ['Legs'],
    'Level': ['Beginner'],
    'Equipment': ['Barbell']
})

# Pastikan fitur cocok
missing_features = set(feature_names) - set(user_data.columns)
if missing_features:
    raise ValueError(f"Ada fitur yang hilang di data pengguna: {missing_features}")

# Encoding fitur kategori
categorical_features = ['Type', 'BodyPart', 'Level', 'Equipment']
user_data_encoded = encoder.transform(user_data[categorical_features])
encoded_df = pd.DataFrame(user_data_encoded, columns=encoder.get_feature_names_out())

# Gabungkan fitur numerik dan kategori
numerical_features = user_data.drop(columns=categorical_features)
user_data_final = pd.concat([
    encoded_df.reset_index(drop=True),
    numerical_features.reset_index(drop=True)
], axis=1)

# Susun fitur sesuai urutan training
user_data_final = user_data_final[feature_names]

# Scaling
user_data_scaled = scaler.transform(user_data_final)

# Prediksi
predicted_rating = model.predict(user_data_scaled)[0]

# Mapping rating ke label
rating_labels = {0: 'Low', 1: 'Medium', 2: 'High'}

# Tampilkan rekomendasi
print(f"Rekomendasi workout rating: {rating_labels[predicted_rating]}")

# Ambil workout yang sesuai rating
title_key = 'Title' if 'Title' in workout_df.columns else 'title'
recommended_workouts = workout_df[workout_df['rating'] == predicted_rating][title_key].tolist()

if recommended_workouts:
    print("Workout yang direkomendasikan:")
    for workout in recommended_workouts:
        print(f"- {workout}")
else:
    print("Maaf, tidak ada workout yang cocok dengan preferensi Anda.")

# Yuk dicoba lagi! 🚀

# Kasih tahu aku kalau ada kendala lain! 🔥
