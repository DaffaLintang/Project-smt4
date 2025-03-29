from flask import Blueprint, request, jsonify
import pandas as pd
import pymysql
from sqlalchemy import create_engine
from sklearn.neighbors import NearestNeighbors
from sklearn.preprocessing import LabelEncoder

workout_api = Blueprint('workout_api', __name__)

# Koneksi ke MySQL
username = "root"   # Ganti dengan username MySQL
password = "admin"       # Isi jika ada password
host = "localhost"  # Sesuaikan dengan host MySQL
database = "workout_db"  # Nama database

# Buat engine koneksi
engine = create_engine(f"mysql+pymysql://{username}:{password}@{host}/{database}")

# Ambil data dari MySQL
query = "SELECT * FROM workouts"
data = pd.read_sql(query, con=engine)

# Pastikan data tidak kosong
if data.empty:
    raise ValueError("Data dari MySQL kosong. Pastikan tabel 'workouts' terisi!")

# Inisialisasi Model
class WorkoutRecommender:
    def __init__(self, df):
        self.df = df.copy()
        self.encoder_type = LabelEncoder()
        self.encoder_bodypart = LabelEncoder()
        self.encoder_equipment = LabelEncoder()
        self.encoder_level = LabelEncoder()
        self.model = NearestNeighbors(n_neighbors=1, metric='cosine')
        self.prepare_data()

    def prepare_data(self):
        self.df['Rating'] = self.df['Rating'].fillna(self.df['Rating'].mean())
        self.df['Type'] = self.encoder_type.fit_transform(self.df['Type'].fillna('Unknown'))
        self.df['BodyPart'] = self.encoder_bodypart.fit_transform(self.df['BodyPart'].fillna('Unknown'))
        self.df['Equipment'] = self.encoder_equipment.fit_transform(self.df['Equipment'].fillna('Unknown'))
        self.df['Level'] = self.encoder_level.fit_transform(self.df['Level'].fillna('Unknown'))
        self.features = self.df[['Type', 'BodyPart', 'Equipment', 'Level']]
        self.model.fit(self.features)

    def recommend(self, workout_input):
        input_df = pd.DataFrame([workout_input], columns=self.features.columns)
        distances, indices = self.model.kneighbors(input_df)
        recommendations = self.df.iloc[indices[0]]

        recommendations = recommendations[(recommendations['BodyPart'] == workout_input[1]) &
                                          (recommendations['Type'] == workout_input[0]) &
                                          (recommendations['Equipment'] == workout_input[2]) &
                                          (recommendations['Level'] == workout_input[3])]

        if recommendations.empty:
            return []

        return recommendations[['Title', 'Desc', 'Type', 'BodyPart', 'Equipment', 'Level']].to_dict(orient='records')

recommender = WorkoutRecommender(data)

@workout_api.route('/encoding-info', methods=['GET'])
def get_encoding_info():
    try:
        encoding_info = {
            "Type": {index: label for index, label in enumerate(recommender.encoder_type.classes_)},
            "BodyPart": {index: label for index, label in enumerate(recommender.encoder_bodypart.classes_)},
            "Equipment": {index: label for index, label in enumerate(recommender.encoder_equipment.classes_)},
            "Level": {index: label for index, label in enumerate(recommender.encoder_level.classes_)}
        }
        return jsonify(encoding_info)
    except Exception as e:
        return jsonify({'error': str(e)})

@workout_api.route('/recommend', methods=['POST'])
def get_recommendations():
    try:
        input_data = request.json
        workout_input = [input_data['Type'], input_data['BodyPart'], input_data['Equipment'], input_data['Level']]
        recommendations = recommender.recommend(workout_input)

        # Konversi ke DataFrame untuk manipulasi data
        recommendations = pd.DataFrame(recommendations).fillna("")

        # Dekode kembali nilai numerik ke label aslinya
        recommendations['Type'] = recommender.encoder_type.inverse_transform(recommendations['Type'])
        recommendations['BodyPart'] = recommender.encoder_bodypart.inverse_transform(recommendations['BodyPart'])
        recommendations['Equipment'] = recommender.encoder_equipment.inverse_transform(recommendations['Equipment'])
        recommendations['Level'] = recommender.encoder_level.inverse_transform(recommendations['Level'])

        # Konversi ke list of dict untuk JSON response
        recommendations_list = recommendations.to_dict(orient='records')

        return jsonify({'recommendations': recommendations_list})
    except Exception as e:
        return jsonify({'error': str(e)})
