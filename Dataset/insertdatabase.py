import pandas as pd
from sqlalchemy import create_engine

# Load kedua dataset CSV
file_path1 = "C:/Projectsem4/Project-smt4/Dataset/obesity_data.csv"
file_path2 = "C:/Projectsem4/Project-smt4/Dataset/megaGymDataset(1).csv"

df1 = pd.read_csv(file_path1)
df2 = pd.read_csv(file_path2)

# Koneksi ke MySQL
username = "root"   # Ganti dengan username MySQL
password = ""       # Isi jika ada password
host = "localhost"  # Sesuaikan dengan host MySQL
database = "workout_db"  # Nama database

# Buat engine koneksi
engine = create_engine(f"mysql+pymysql://{username}:{password}@{host}/{database}")

# Masukkan df1 ke tabel "obesity"
df1.to_sql(name="obesity", con=engine, if_exists="replace", index=False)

# Masukkan df2 ke tabel "workouts"
df2.to_sql(name="workouts", con=engine, if_exists="replace", index=False)

print("Data dari kedua file berhasil dimasukkan ke MySQL dalam tabel berbeda!")
