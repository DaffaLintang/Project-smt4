from flask import Blueprint, request, jsonify
import pandas as pd
import joblib

bmi_api = Blueprint('bmi_api', __name__)

# Load model dan preprocessing tools saat aplikasi dimulai
model = joblib.load('bmi_classification_model_rf.pkl')
encoder = joblib.load('encoder.pkl')
scaler = joblib.load('scaler.pkl')
label_encoder = joblib.load('label_encoder_ObesityCategory.pkl')

@bmi_api.route('/predict', methods=['POST'])
def predict_obesity():
    try:
        input_data = request.json
        age = input_data['Age']
        gender = input_data['Gender']
        height = input_data['Height']
        weight = input_data['Weight']
        bmi = weight / (height ** 2)  # Hitung BMI

        # Buat dataframe dari input pengguna
        df_input = pd.DataFrame([{ 
            'Age': age, 
            'Gender': gender, 
            'Height': height, 
            'Weight': weight, 
            'BMI': bmi 
        }])

        # One-hot encoding untuk Gender
        categorical_encoded = encoder.transform(df_input[['Gender']]).toarray()
        input_final = pd.concat([
            pd.DataFrame(categorical_encoded, columns=encoder.get_feature_names_out()),
            df_input[['Age', 'Height', 'Weight', 'BMI']].reset_index(drop=True)
        ], axis=1)

        # Scaling fitur numerik
        input_scaled = scaler.transform(input_final)

        # Prediksi
        prediction = model.predict(input_scaled)
        predicted_category = label_encoder.inverse_transform(prediction)

        return jsonify({"prediction": str(predicted_category[0])})
    except Exception as e:
        return jsonify({'error': str(e)})
