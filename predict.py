import pickle
import sys
import json
import pandas as pd
import warnings

warnings.filterwarnings("ignore")

# =========================
# LOAD MODEL
# =========================
with open("attack_detection_model.pkl", "rb") as f:
    data = pickle.load(f)

model = data["model"]
feature_names = data["features"]

# =========================
# AMBIL INPUT DARI PHP / CLI
# =========================
input_data = json.loads(sys.stdin.read())

# =========================
# RULE-BASED OVERRIDE (Buat traffic normal nyata)
# =========================
if (
    input_data.get("ip_reputation_score", 0) >= 0.9 and
    input_data.get("failed_logins", 0) == 0 and
    input_data.get("login_attempts", 0) <= 2 and
    input_data.get("unusual_time_access", 0) == 0
):
    output = {
        "prediction": 0,
        "label": "Normal",
        "prob_normal": 0.9,
        "prob_attack": 0.1,
        "input_vector": input_data,
        "reason": "Rule-based safe traffic"
    }
    print(json.dumps(output, indent=2))
    sys.exit()

# =========================
# BUAT DATAFRAME UNTUK ML
# =========================
X = pd.DataFrame([[input_data.get(f, 0) for f in feature_names]], columns=feature_names)

# =========================
# PREDIKSI
# =========================
prediction = int(model.predict(X)[0])
probs = model.predict_proba(X)[0]

# Cari index kelas
cls_index = {cls: i for i, cls in enumerate(model.classes_)}

prob_normal = float(probs[cls_index.get(0, 0)])
prob_attack = float(probs[cls_index.get(1, 1)])

output = {
    "prediction": prediction,
    "label": "Normal" if prediction == 0 else "Attack",
    "prob_normal": round(prob_normal, 3),
    "prob_attack": round(prob_attack, 3),
    "input_vector": input_data
}

print(json.dumps(output, indent=2))

# =========================
# DEBUG PRINT (opsional)
# =========================
print("\n===== DEBUG INPUT VECTOR =====")
print(X)
print("\n===== DEBUG PREDICTION PROBABILITIES =====")
print(f"Normal: {prob_normal:.3f}, Attack: {prob_attack:.3f}")
print(f"Predicted Class: {'Normal' if prediction == 0 else 'Attack'}")
