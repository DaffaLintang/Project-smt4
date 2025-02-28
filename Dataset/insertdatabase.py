import pandas as pd
from pymongo import MongoClient

# Load dataset CSV
file_path = "C:/daffa/njajal/TA-Semester 4/megaGymDataset(1).csv"
df = pd.read_csv(file_path)

# Koneksi ke MongoDB
client = MongoClient("mongodb://localhost:27017/")
db = client["workout_db"]
collection = db["workouts"]

# Konversi dataset ke JSON lalu masukkan ke MongoDB
data = df.to_dict(orient="records")
collection.insert_many(data)