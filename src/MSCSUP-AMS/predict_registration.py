import mysql.connector
import pandas as pd
from datetime import timedelta
from statsmodels.tsa.arima.model import ARIMA
import json
import os

# ✅ Connect to MySQL
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="msc_sup"
)

# ✅ Query the date_register column
query = "SELECT date_register FROM info"
df = pd.read_sql(query, conn)
conn.close()

# ✅ Ensure date format and group by day
df['date_register'] = pd.to_datetime(df['date_register'])
ts = df.groupby(df['date_register'].dt.date).size()

# ✅ Build and fit ARIMA model
model = ARIMA(ts, order=(1, 1, 1))
model_fit = model.fit()

# ✅ Forecast for the next 7 days
forecast = model_fit.forecast(steps=7)
forecast_dates = [(ts.index[-1] + timedelta(days=i+1)).strftime('%Y-%m-%d') for i in range(7)]
forecast_values = [max(0, round(val)) for val in forecast.tolist()]  # Avoid negatives

# ✅ Output dictionary
predicted_data = {
    "dates": forecast_dates,
    "predictions": forecast_values
}

# ✅ Save JSON next to script
output_path = os.path.join(os.path.dirname(__file__), "predicted_registrations.json")
with open(output_path, "w") as f:
    json.dump(predicted_data, f)

print("✅ Prediction saved to", output_path)
