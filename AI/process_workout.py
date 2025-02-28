import pandas as pd
from pymongo import MongoClient
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
import joblib

def load_data_from_mongodb():
    # Koneksi ke MongoDB
    client = MongoClient('mongodb://localhost:27017/')
    db = client['workout_db']               # Ganti dengan nama database
    collection = db['workouts']           # Ganti dengan nama koleksi

    # Ambil data dari MongoDB, exclude '_id' jika tidak dibutuhkan
    data = list(collection.find({}, {'_id': 0}))
    df = pd.DataFrame(data)
    
    if df.empty:
        raise ValueError("Data dari MongoDB kosong atau tidak ditemukan!")

    return df

def preprocess_and_save(df):
    # Pilih kolom yang dibutuhkan
    df = df[['Type', 'BodyPart', 'Equipment', 'Level', 'Rating', 'Title']]

    # Encode data kategori
    label_encoders = {}
    for col in ['Type', 'BodyPart', 'Equipment', 'Level', 'Title']:
        le = LabelEncoder()
        df[col] = le.fit_transform(df[col])
        label_encoders[col] = le

    # Pisahkan fitur (X) dan label (y)
    X = df.drop(columns=['Rating'])
    y = df['Rating']

    # Bagi dataset jadi training & testing
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

    # Simpan hasil preprocessing
    joblib.dump(label_encoders, 'label_encoders.pkl')
    X_train.to_csv('X_train.csv', index=False)
    X_test.to_csv('X_test.csv', index=False)
    y_train.to_csv('y_train.csv', index=False)
    y_test.to_csv('y_test.csv', index=False)

    print("Preprocessing selesai dan data tersimpan!")

if __name__ == "__main__":
    try:
        # Load data & jalankan preprocessing
        df = load_data_from_mongodb()
        preprocess_and_save(df)
    except Exception as e:
        print(f"Terjadi kesalahan: {e}")
