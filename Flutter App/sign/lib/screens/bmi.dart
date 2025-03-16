import 'package:flutter/material.dart';

void main() {
  runApp(BMICalculatorApp());
}

class BMICalculatorApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: BMICalculatorScreen(),
    );
  }
}

class BMICalculatorScreen extends StatefulWidget {
  @override
  _BMICalculatorScreenState createState() => _BMICalculatorScreenState();
}

class _BMICalculatorScreenState extends State<BMICalculatorScreen> {
  final TextEditingController _weightController = TextEditingController();
  final TextEditingController _heightController = TextEditingController();
  final TextEditingController _ageController = TextEditingController();

  String _result = "";
  String _gender = "Select a Gender";
  String _category = "";
  Color _categoryColor = Colors.black;
  String _bmiRange = "";

  void _calculateBMI() {
    if (_weightController.text.isEmpty ||
        _heightController.text.isEmpty ||
        _ageController.text.isEmpty ||
        _gender == "Select a Gender") {
      setState(() {
        _result = "Please fill in all fields correctly.";
      });
      return;
    }

    double weight = double.parse(_weightController.text);
    double height = double.parse(_heightController.text);
    double bmi = weight / ((height / 100) * (height / 100));

    setState(() {
      if (bmi < 18.5) {
        _category = "Berat Rendah";
        _categoryColor = Colors.blue;
        _bmiRange = "< 18.5";
      } else if (bmi < 24.9) {
        _category = "Normal";
        _categoryColor = Colors.green;
        _bmiRange = "18.5 - 24.9";
      } else if (bmi < 29.9) {
        _category = "Berat Berlebih";
        _categoryColor = Colors.orange;
        _bmiRange = "25 - 29.9";
      } else {
        _category = "Obesitas";
        _categoryColor = Colors.red;
        _bmiRange = "≥ 30";
      }

      _result =
          "BMI Kamu: ${bmi.toStringAsFixed(1)} ($_category)\nRange Sehat: $_bmiRange";
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Column(
        children: [
          // Kotak merah atas lebih kecil
          Container(
            color: Colors.red,
            padding: EdgeInsets.only(top: 25, bottom: 5),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.start,
              children: [
                IconButton(
                  icon: Icon(Icons.arrow_back, color: Colors.white),
                  onPressed: () {},
                ),
              ],
            ),
          ),

          // Jarak antar kotak merah dan tulisan BMI
          SizedBox(height: 10),
          Text(
            "BMI",
            style: TextStyle(fontSize: 26, fontWeight: FontWeight.bold),
          ),
          SizedBox(height: 20), // Jarak antar tulisan BMI dan teks berikutnya

          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 16.0),
            child: Column(
              children: [
                Text(
                  "Hitung BMI mu Sekarang",
                  style: TextStyle(
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                      color: Colors.black),
                ),
                SizedBox(height: 35), // Jarak antar teks dan input

                // Row pertama: Height & Weight
                Row(
                  children: [
                    Expanded(
                        child:
                            buildTextField("Tinggi (cm)", _heightController)),
                    SizedBox(width: 70),
                    Expanded(
                        child: buildTextField("Berat (kg)", _weightController)),
                  ],
                ),
                SizedBox(height: 30), // Jarak antar baris input

                // Row kedua: Age & Gender
                Row(
                  children: [
                    Expanded(child: buildTextField("Usia", _ageController)),
                    SizedBox(width: 70),
                    Expanded(child: buildDropdown()),
                  ],
                ),

                SizedBox(height: 25), // Jarak antar input dan tombol

                // Tombol Hitung & Reset
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    buildButton("HITUNG", _calculateBMI),
                    SizedBox(width: 10),
                    buildButton("RESET", () {
                      setState(() {
                        _weightController.clear();
                        _heightController.clear();
                        _ageController.clear();
                        _gender = "Select a Gender";
                        _result = "";
                      });
                    }),
                  ],
                ),

                SizedBox(height: 25), // Jarak antar tombol dan hasil
                buildResult(),
              ],
            ),
          ),
        ],
      ),
    );
  }

  // Input Field untuk angka
  Widget buildTextField(String label, TextEditingController controller) {
    return TextField(
      controller: controller,
      keyboardType: TextInputType.number,
      decoration: InputDecoration(
        labelText: label,
        labelStyle: TextStyle(color: Colors.black),
        focusedBorder: OutlineInputBorder(
          borderSide: BorderSide(color: Colors.red),
          borderRadius: BorderRadius.circular(20),
        ),
        enabledBorder: OutlineInputBorder(
          borderSide: BorderSide(color: Colors.red),
          borderRadius: BorderRadius.circular(20),
        ),
      ),
    );
  }

  // Dropdown untuk memilih Gender
  Widget buildDropdown() {
    return DropdownButtonFormField<String>(
      value: _gender,
      decoration: InputDecoration(
        border: OutlineInputBorder(
          borderSide: BorderSide(color: Colors.red),
          borderRadius: BorderRadius.circular(20),
        ),
      ),
      items: ["Select a Gender", "Male", "Female"].map((String value) {
        return DropdownMenuItem<String>(
          value: value,
          child: Text(value, style: TextStyle(color: Colors.black)),
        );
      }).toList(),
      onChanged: (newValue) {
        setState(() {
          _gender = newValue!;
        });
      },
    );
  }

  // Tombol
  Widget buildButton(String text, VoidCallback onPressed) {
    return ElevatedButton(
      style: ElevatedButton.styleFrom(
        backgroundColor: Colors.red,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20)),
        padding: EdgeInsets.symmetric(horizontal: 20, vertical: 10),
      ),
      onPressed: onPressed,
      child: Text(text, style: TextStyle(color: Colors.white)),
    );
  }

  // Hasil Perhitungan BMI
  Widget buildResult() {
    return _result.isNotEmpty
        ? Container(
            padding: EdgeInsets.all(16),
            decoration: BoxDecoration(
              color: _categoryColor.withOpacity(0.2),
              borderRadius: BorderRadius.circular(10),
            ),
            child: Column(
              children: [
                Text(
                  _category,
                  style: TextStyle(
                      fontSize: 22,
                      fontWeight: FontWeight.bold,
                      color: _categoryColor),
                ),
                SizedBox(height: 5),
                Text(_result,
                    textAlign: TextAlign.center,
                    style: TextStyle(
                        fontSize: 16,
                        fontWeight: FontWeight.w600,
                        color: Colors.black)),
              ],
            ),
          )
        : Container();
  }
}
