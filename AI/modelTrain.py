import pandas as pd
import joblib
from sklearn.metrics import accuracy_score, classification_report
from imblearn.combine import SMOTETomek
from sklearn.model_selection import train_test_split, RandomizedSearchCV
from sklearn.preprocessing import StandardScaler, OneHotEncoder
from sklearn.ensemble import RandomForestClassifier

# Load data hasil preprocessing
X_train = pd.read_csv('X_train.csv')
X_test = pd.read_csv('X_test.csv')
y_train = pd.read_csv('y_train.csv').values.ravel()
y_test = pd.read_csv('y_test.csv').values.ravel()

# Hapus kolom 'Title' agar tidak dipakai sebagai fitur
if 'Title' in X_train.columns:
    X_train = X_train.drop(columns=['Title'])
if 'Title' in X_test.columns:
    X_test = X_test.drop(columns=['Title'])

# Bersihkan NaN dari fitur dan label
train_df = pd.concat([pd.DataFrame(X_train), pd.Series(y_train, name='target')], axis=1)
train_df = train_df.dropna()

X_train = train_df.drop(columns=['target'])
y_train = train_df['target'].values

# Debugging: Cek NaN
print("Jumlah NaN di X_train:", X_train.isnull().sum().sum())
print("Jumlah NaN di X_test:", X_test.isnull().sum().sum())

# Encoding fitur kategori
categorical_features = ['Type', 'BodyPart', 'Level', 'Equipment']
encoder = OneHotEncoder(handle_unknown='ignore')
X_train_encoded = encoder.fit_transform(X_train[categorical_features])
X_test_encoded = encoder.transform(X_test[categorical_features])

# Simpan encoder untuk prediksi nanti
joblib.dump(encoder, 'encoder.pkl')

# Pastikan fitur prediksi sama dengan fitur training
X_test_encoded_df = pd.DataFrame(X_test_encoded.toarray(), columns=encoder.get_feature_names_out())

for feature in encoder.get_feature_names_out():
    if feature not in X_test_encoded_df.columns:
        X_test_encoded_df[feature] = 0

# Gabungkan fitur numerik
numerical_features = X_train.drop(columns=categorical_features)
numerical_features_test = X_test.drop(columns=categorical_features).reindex(columns=numerical_features.columns, fill_value=0)

X_train_final = pd.concat([
    pd.DataFrame(X_train_encoded.toarray(), columns=encoder.get_feature_names_out()),
    numerical_features.reset_index(drop=True)
], axis=1)

X_test_final = pd.concat([
    X_test_encoded_df,
    numerical_features_test.reset_index(drop=True)
], axis=1)

# Simpan nama kolom untuk prediksi nanti
feature_names = X_train_final.columns.tolist()
joblib.dump(feature_names, 'feature_names.pkl')

# Konversi rating ke kategori diskrit
def categorize_rating(rating):
    if rating <= 2:
        return 0  # Low
    elif rating <= 4:
        return 1  # Medium
    else:
        return 2  # High

y_train = pd.Series(y_train).apply(categorize_rating)
y_test = pd.Series(y_test).apply(categorize_rating)

# Feature Scaling
scaler = StandardScaler()
X_train_scaled = scaler.fit_transform(X_train_final)
X_test_scaled = scaler.transform(X_test_final)

# Simpan scaler untuk prediksi nanti
joblib.dump(scaler, 'scaler.pkl')

# Mengatasi class imbalance dengan SMOTE + Tomek Links
smote_tomek = SMOTETomek(random_state=42)
X_train_resampled, y_train_resampled = smote_tomek.fit_resample(X_train_scaled, y_train)

# Debugging: Cek distribusi label
print("Distribusi label setelah balancing:")
print(pd.Series(y_train_resampled).value_counts())

# Hyperparameter tuning untuk Random Forest
param_dist_rf = {
    'n_estimators': [100, 200, 300],
    'max_depth': [10, 20, None],
    'min_samples_split': [2, 5, 10],
    'min_samples_leaf': [1, 2, 4]
}

rf = RandomForestClassifier(random_state=42)

rf_random_search = RandomizedSearchCV(
    rf, param_distributions=param_dist_rf, n_iter=10, cv=3, scoring='f1_weighted', random_state=42, n_jobs=-1, error_score='raise'
)

try:
    rf_random_search.fit(X_train_resampled, y_train_resampled)

    # Evaluasi model Random Forest terbaik
    best_rf_model = rf_random_search.best_estimator_
    rf_predictions = best_rf_model.predict(X_test_scaled)
    rf_accuracy = accuracy_score(y_test, rf_predictions)
    rf_report = classification_report(y_test, rf_predictions)

    # Simpan model terbaik
    joblib.dump(best_rf_model, 'workout_recommendation_model_rf.pkl')
    print(f"Model terbaik: Random Forest")

    # Tampilkan hasil evaluasi
    print(f"Akurasi Model Random Forest: {rf_accuracy * 100:.2f}%")
    print("\nLaporan Klasifikasi Random Forest:")
    print(rf_report)

except ValueError as e:
    print("Terjadi error saat training:", e)
    print("Cek tipe data fitur:")
    print(pd.DataFrame(X_train_final).dtypes)

print("Model terbaik berhasil dilatih dan disimpan dengan SMOTE + Tomek Links dan hyperparameter tuning lanjutan!")

# Yuk dicoba lagi kalau ada kendala! 🚀
