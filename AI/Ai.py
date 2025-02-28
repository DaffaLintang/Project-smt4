import pandas as pd
from pymongo import MongoClient
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import OneHotEncoder, StandardScaler, LabelEncoder
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import accuracy_score, classification_report
import joblib

# Koneksi ke MongoDB
client = MongoClient('mongodb://localhost:27017/')
db = client['workout_db']
collection = db['workouts']

# Ambil data dari MongoDB
data = pd.DataFrame(list(collection.find()))

# Pastikan data tidak kosong
if data.empty:
    raise ValueError("Data dari MongoDB kosong. Pastikan koleksi terisi!")

# Hapus kolom yang tidak relevan
irrelevant_columns = ['_id', 'RatingDesc', 'Rating', 'Unnamed: 0']

for col in irrelevant_columns:
    if col in data.columns:
        data = data.drop(columns=[col])

# Hapus baris dengan Title NaN
if 'Title' in data.columns:
    data = data.dropna(subset=['Title'])

# Encode Title jadi angka
if 'Title' in data.columns:
    le = LabelEncoder()
    data['Title'] = le.fit_transform(data['Title'])
    joblib.dump(le, 'label_encoder_title.pkl')

# Mengubah deskripsi jadi fitur
for text_col in ['Description', 'Desc']:
    if text_col in data.columns:
        tfidf_vectorizer = TfidfVectorizer(max_features=500)
        text_features = tfidf_vectorizer.fit_transform(data[text_col].fillna(""))
        joblib.dump(tfidf_vectorizer, f'tfidf_vectorizer_{text_col}.pkl')
        
        data = data.drop(columns=[text_col])
        text_df = pd.DataFrame(text_features.toarray(), columns=tfidf_vectorizer.get_feature_names_out())
        data = pd.concat([data.reset_index(drop=True), text_df], axis=1)

# Pisahkan fitur dan label
X = data.drop(columns=['Title'])
y = data['Title']

# Encoding fitur kategori
categorical_features = ['Type', 'BodyPart', 'Level', 'Equipment']
encoder = OneHotEncoder(handle_unknown='ignore')
categorical_encoded = encoder.fit_transform(X[categorical_features]).toarray()
joblib.dump(encoder, 'encoder.pkl')

# Gabungkan fitur kategori dan numerik
X = X.drop(columns=categorical_features)
X_final = pd.concat([
    pd.DataFrame(categorical_encoded, columns=encoder.get_feature_names_out()),
    X.reset_index(drop=True)
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
joblib.dump(model, 'workout_classification_model_rf.pkl')

# Evaluasi
predictions = model.predict(X_test)
accuracy = accuracy_score(y_test, predictions)
report = classification_report(y_test, predictions)

print(f"Akurasi: {accuracy * 100:.2f}%")
print("\nLaporan Klasifikasi:")
print(report)

print("Pipeline selesai! Model siap digunakan.")

# 🚀 Kalau ini sudah jalan, nanti kita bisa bikin bagian prediksi dari input user! 🚀
