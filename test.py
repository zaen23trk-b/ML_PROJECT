import pandas as pd
import pickle
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier
from sklearn.metrics import classification_report, confusion_matrix

# =========================
# LOAD DATA
# =========================
df = pd.read_csv("cybersecurity_intrusion_data.csv")

# =========================
# DATA CURATION
# =========================
df['encryption_used'] = df['encryption_used'].fillna("Unknown")
df = df.drop(columns=['session_id'], errors='ignore')

# =========================
# ONE-HOT ENCODING (FULL)
# =========================
df = pd.get_dummies(
    df,
    columns=['protocol_type', 'encryption_used', 'browser_type'],
    drop_first=False
)

# =========================
# FEATURES & LABEL
# =========================
X = df.drop('attack_detected', axis=1)
y = df['attack_detected']

# =========================
# TRAIN-TEST SPLIT
# =========================
X_train, X_test, y_train, y_test = train_test_split(
    X, y, test_size=0.2, stratify=y, random_state=42
)

# =========================
# DECISION TREE "FRIENDLY"
# =========================
model = DecisionTreeClassifier(
    criterion='gini',
    max_depth=6,              # lebih dangkal → normal lebih terlihat
    min_samples_leaf=10,      # hindari leaf terlalu kecil
    class_weight='balanced',  # balance antara normal vs attack
    random_state=42
)
model.fit(X_train, y_train)

# =========================
# EVALUASI
# =========================
y_pred = model.predict(X_test)
print("=== Classification Report ===")
print(classification_report(y_test, y_pred))
print("=== Confusion Matrix ===")
print(confusion_matrix(y_test, y_pred))

# =========================
# SIMPAN MODEL
# =========================
with open("attack_detection_model.pkl", "wb") as f:
    pickle.dump({
        "model": model,
        "features": list(X.columns)
    }, f)

print("✅ Model Decision Tree friendly tersimpan di attack_detection_model.pkl")
