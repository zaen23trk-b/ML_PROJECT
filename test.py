import pandas as pd
import pickle
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier
from sklearn.metrics import classification_report, confusion_matrix

# =========================
# DATA COLLECTION
# =========================
print("📥 Data Collection")
df = pd.read_csv("cybersecurity_intrusion_data.csv")
print("Jumlah data:", df.shape[0])
print("Jumlah atribut:", df.shape[1])

# =========================
# DATA CURATION
# =========================
print("\n🧹 Data Curation")

# Cek missing value
print("Missing value sebelum handling:")
print(df.isna().sum())

df['encryption_used'] = df['encryption_used'].fillna("Unknown")
df = df.drop(columns=['session_id'], errors='ignore')

print("\nMissing value setelah handling:")
print(df.isna().sum())

# =========================
# DATA EXPLORATION
# =========================
print("\n🔍 Data Exploration")

# Info dataset
print("\nInfo Dataset:")
print(df.info())

# Statistik deskriptif
print("\nStatistik Deskriptif:")
print(df.describe())

# Distribusi label
print("\nDistribusi Label (attack_detected):")
print(df['attack_detected'].value_counts())

# Korelasi numerik (ringkas)
print("\nKorelasi fitur numerik terhadap label:")
numeric_cols = df.select_dtypes(include=['int64', 'float64'])
print(numeric_cols.corr()['attack_detected'].sort_values(ascending=False))

# =========================
# FEATURE ENGINEERING
# =========================
print("\n🛠 Feature Engineering")

# ONE-HOT ENCODING (FULL)
df = pd.get_dummies(
    df,
    columns=['protocol_type', 'encryption_used', 'browser_type'],
    drop_first=False
)

print("Total fitur setelah encoding:", df.shape[1])

# =========================
# FEATURES & LABEL
# =========================
X = df.drop('attack_detected', axis=1)
y = df['attack_detected']

print("Jumlah fitur final:", X.shape[1])

# =========================
# TRAIN-TEST SPLIT
# =========================
X_train, X_test, y_train, y_test = train_test_split(
    X, y, test_size=0.2, stratify=y, random_state=42
)

print("Data train:", X_train.shape)
print("Data test :", X_test.shape)

# =========================
# MODEL TRAINING
# =========================
print("\n🌲 Model Training (Decision Tree Friendly)")

model = DecisionTreeClassifier(
    criterion='gini',
    max_depth=6,
    min_samples_leaf=10,
    class_weight='balanced',
    random_state=42
)
model.fit(X_train, y_train)

print("Model selesai dilatih")

# =========================
# EVALUATION
# =========================
print("\n📊 Evaluation")

y_pred = model.predict(X_test)

print("=== Classification Report ===")
print(classification_report(y_test, y_pred))

print("=== Confusion Matrix ===")
print(confusion_matrix(y_test, y_pred))

# =========================
# DEPLOYMENT (MODEL SAVING)
# =========================
print("\n🚀 Deployment")

with open("attack_detection_model.pkl", "wb") as f:
    pickle.dump({
        "model": model,
        "features": list(X.columns)
    }, f)

print("✅ Model Decision Tree friendly tersimpan di attack_detection_model.pkl")
