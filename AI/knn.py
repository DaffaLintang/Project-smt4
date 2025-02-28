from sklearn.neighbors import NearestNeighbors
from sklearn.preprocessing import LabelEncoder
import numpy as np
import pandas as pd
from pymongo import MongoClient

class WorkoutRecommender:
    def __init__(self, df):
        self.df = df.copy()
        self.encoder_type = LabelEncoder()
        self.encoder_bodypart = LabelEncoder()
        self.encoder_equipment = LabelEncoder()
        self.encoder_level = LabelEncoder()
        self.model = NearestNeighbors(n_neighbors=3, metric='cosine')
        self.prepare_data()
    
    def prepare_data(self):
        self.df['Rating'] = self.df['Rating'].fillna(self.df['Rating'].mean())
        self.df['Type'] = self.encoder_type.fit_transform(self.df['Type'].fillna('Unknown'))
        self.df['BodyPart'] = self.encoder_bodypart.fit_transform(self.df['BodyPart'].fillna('Unknown'))
        self.df['Equipment'] = self.encoder_equipment.fit_transform(self.df['Equipment'].fillna('Unknown'))
        self.df['Level'] = self.encoder_level.fit_transform(self.df['Level'].fillna('Unknown'))
        self.features = self.df[['Type', 'BodyPart', 'Equipment', 'Level']]
        self.model.fit(self.features)
    
    def print_encodings(self):
        print("Type Encoding:", dict(zip(self.encoder_type.classes_, self.encoder_type.transform(self.encoder_type.classes_))))
        print("BodyPart Encoding:", dict(zip(self.encoder_bodypart.classes_, self.encoder_bodypart.transform(self.encoder_bodypart.classes_))))
        print("Equipment Encoding:", dict(zip(self.encoder_equipment.classes_, self.encoder_equipment.transform(self.encoder_equipment.classes_))))
        print("Level Encoding:", dict(zip(self.encoder_level.classes_, self.encoder_level.transform(self.encoder_level.classes_))))
    
    def recommend(self, workout_input):
        input_df = pd.DataFrame([workout_input], columns=self.features.columns)
        distances, indices = self.model.kneighbors(input_df)
        recommendations = self.df.iloc[indices[0]]
        
        # Filter rekomendasi untuk BodyPart, Type, Equipment, dan Level
        recommendations = recommendations[(recommendations['BodyPart'] == workout_input[1]) &
                                          (recommendations['Type'] == workout_input[0]) &
                                          (recommendations['Equipment'] == workout_input[2]) &
                                          (recommendations['Level'] == workout_input[3])]
        
        # Kalau tidak ada yang cocok, kasih tahu
        if recommendations.empty:
            return "Tidak ada workout yang cocok untuk kombinasi yang dipilih. Coba input lain!"
        
        # Acak hasil rekomendasi agar berbeda tiap kali
        recommendations = recommendations.sample(frac=1).reset_index(drop=True)
        
        return recommendations[['Title', 'Desc', 'Type', 'BodyPart', 'Equipment', 'Level']]

if __name__ == "__main__":
    # Koneksi ke MongoDB
    client = MongoClient('mongodb://localhost:27017/')
    db = client['workout_db']
    collection = db['workouts']
    
    # Ambil data dari MongoDB dan ubah jadi DataFrame
    data = pd.DataFrame(list(collection.find()))
    
    # Hapus kolom _id kalau ada
    if '_id' in data.columns:
        data.drop('_id', axis=1, inplace=True)
    
    recommender = WorkoutRecommender(data)
    recommender.print_encodings()
    
    # Contoh input
    recommendations = recommender.recommend([4, 0, 2, 2])
    print(recommendations)

# Silakan coba jalankan ulang kodenya! 🚀
