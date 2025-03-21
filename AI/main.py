from flask import Flask
from flask_cors import CORS
from workoutRekomendasi import workout_api  # Import workout API
from bmiApi import bmi_api  # Import BMI API

app = Flask(__name__)
CORS(app)

# Registrasi Blueprint untuk kedua API
app.register_blueprint(workout_api, url_prefix='/workout')
app.register_blueprint(bmi_api, url_prefix='/bmi')


if __name__ == '__main__':
    app.run(debug=True, port=5000)
