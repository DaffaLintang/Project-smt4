import pandas as pd
from pymongo import MongoClient
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import OneHotEncoder, StandardScaler, LabelEncoder
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import accuracy_score, classification_report
import joblib

# Koneksi ke MongoDB
client = MongoClient('mongodb://localhost:27017/')
db = client['workout_db']
collection = db['obesity']

# Ambil data dari MongoDB
data = pd.DataFrame(list(collection.find()))

# Pastikan data tidak kosong
if data.empty:
    raise ValueError("Data dari MongoDB kosong. Pastikan koleksi terisi!")

# Hapus kolom yang tidak relevan
irrelevant_columns = ['_id', 'PhysicalActivityLevel']
for col in irrelevant_columns:
    if col in data.columns:
        data = data.drop(columns=[col])

# Hapus baris dengan nilai NaN pada ObesityCategory
if 'ObesityCategory' in data.columns:
    data = data.dropna(subset=['ObesityCategory'])

# Encode ObesityCategory
le = LabelEncoder()
data['ObesityCategory'] = le.fit_transform(data['ObesityCategory'])
joblib.dump(le, 'label_encoder_ObesityCategory.pkl')

# Pisahkan fitur dan label
X = data.drop(columns=['ObesityCategory'])
y = data['ObesityCategory']

# Fitur kategorikal dan numerik
categorical_features = ['Gender']  # Hanya Gender yang kategorikal
numerical_features = ['Age', 'Height', 'Weight', 'BMI']  # BMI disertakan

# One-hot encoding untuk Gender
encoder = OneHotEncoder(handle_unknown='ignore')
categorical_encoded = encoder.fit_transform(X[categorical_features]).toarray()
joblib.dump(encoder, 'encoder.pkl')

# Gabungkan kembali dengan fitur numerik
X_final = pd.concat([
    pd.DataFrame(categorical_encoded, columns=encoder.get_feature_names_out()),
    X[numerical_features].reset_index(drop=True)
], axis=1)

# Scaling fitur numerik
scaler = StandardScaler()
X_scaled = scaler.fit_transform(X_final)
joblib.dump(scaler, 'scaler.pkl')

# Split data
X_train, X_test, y_train, y_test = train_test_split(X_scaled, y, test_size=0.2, random_state=42)

# Training model
model = RandomForestClassifier(random_state=42)
model.fit(X_train, y_train)
joblib.dump(model, 'bmi_classification_model_rf.pkl')

# Evaluasi
predictions = model.predict(X_test)
accuracy = accuracy_score(y_test, predictions)
report = classification_report(y_test, predictions)

print(f"Akurasi: {accuracy * 100:.2f}%")
print("\nLaporan Klasifikasi:")
print(report)
