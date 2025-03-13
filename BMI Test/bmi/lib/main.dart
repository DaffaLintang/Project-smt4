import 'package:flutter/material.dart';
import 'package:flutter/services.dart';

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
    String weightText = _weightController.text.trim();
    String heightText = _heightController.text.trim();
    String ageText = _ageController.text.trim();

    if (weightText.isEmpty || heightText.isEmpty || ageText.isEmpty) {
      setState(() {
        _result = "Please fill in all fields.";
      });
      return;
    }

    double weight = double.parse(weightText);
    double height = double.parse(heightText);
    int age = int.parse(ageText);

    if (weight <= 0 || height <= 0 || age <= 0) {
      setState(() {
        _result = "Please enter valid positive values.";
      });
      return;
    }

    if (_gender == "Select a Gender") {
      setState(() {
        _result = "Please select a gender.";
      });
      return;
    }

    double bmi = weight / ((height / 100) * (height / 100));
    String bmiFormatted = bmi.toStringAsFixed(2);

    if (bmi < 18.5) {
      _category = "Underweight";
      _categoryColor = Colors.blue;
      _bmiRange = "Less than 18.5";
    } else if (bmi < 24.9) {
      _category = "Normal weight";
      _categoryColor = Colors.green;
      _bmiRange = "18.5 - 24.9";
    } else if (bmi < 29.9) {
      _category = "Overweight";
      _categoryColor = Colors.orange;
      _bmiRange = "25 - 29.9";
    } else {
      _category = "Obesity";
      _categoryColor = Colors.red;
      _bmiRange = "30 and above";
    }

    setState(() {
      _result = "Your BMI: $bmiFormatted ($_category)\nHealthy BMI Range: $_bmiRange";
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text("BMI Calculator")),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text("Calculate Your BMI", style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold)),
            SizedBox(height: 10),
            Row(
              children: [
                Expanded(
                  child: TextField(
                    controller: _heightController,
                    keyboardType: TextInputType.number,
                    inputFormatters: [FilteringTextInputFormatter.digitsOnly],
                    decoration: InputDecoration(
                      labelText: "Height (cm)",
                      border: OutlineInputBorder(borderRadius: BorderRadius.circular(20)),
                    ),
                  ),
                ),
                SizedBox(width: 10),
                Expanded(
                  child: TextField(
                    controller: _ageController,
                    keyboardType: TextInputType.number,
                    inputFormatters: [FilteringTextInputFormatter.digitsOnly],
                    decoration: InputDecoration(
                      labelText: "Age",
                      border: OutlineInputBorder(borderRadius: BorderRadius.circular(20)),
                    ),
                  ),
                ),
              ],
            ),
            SizedBox(height: 10),
            Row(
              children: [
                Expanded(
                  child: TextField(
                    controller: _weightController,
                    keyboardType: TextInputType.number,
                    inputFormatters: [FilteringTextInputFormatter.digitsOnly],
                    decoration: InputDecoration(
                      labelText: "Weight (kg)",
                      border: OutlineInputBorder(borderRadius: BorderRadius.circular(20)),
                    ),
                  ),
                ),
                SizedBox(width: 10),
                Expanded(
                  child: DropdownButtonFormField<String>(
                    value: _gender,
                    decoration: InputDecoration(
                      border: OutlineInputBorder(borderRadius: BorderRadius.circular(20)),
                    ),
                    items: ["Select a Gender", "Male", "Female"].map((String value) {
                      return DropdownMenuItem<String>(
                        value: value,
                        child: Text(value),
                      );
                    }).toList(),
                    onChanged: (newValue) {
                      setState(() {
                        _gender = newValue!;
                      });
                    },
                  ),
                ),
              ],
            ),
            SizedBox(height: 20),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                ElevatedButton(
                  style: ElevatedButton.styleFrom(backgroundColor: Colors.red),
                  onPressed: _calculateBMI,
                  child: Text("CALCULATE BMI", style: TextStyle(color: Colors.white)),
                ),
                SizedBox(width: 10),
                ElevatedButton(
                  style: ElevatedButton.styleFrom(backgroundColor: Colors.red),
                  onPressed: () {
                    setState(() {
                      _weightController.clear();
                      _heightController.clear();
                      _ageController.clear();
                      _gender = "Select a Gender";
                      _result = "";
                    });
                  },
                  child: Text("RESET", style: TextStyle(color: Colors.white)),
                ),
              ],
            ),
            SizedBox(height: 20),
            Container(
              padding: EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: _categoryColor.withOpacity(0.2),
                borderRadius: BorderRadius.circular(10),
              ),
              child: Column(
                children: [
                  Text(_category, style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold, color: _categoryColor)),
                  SizedBox(height: 5),
                  Text(_result, textAlign: TextAlign.center, style: TextStyle(fontSize: 16, fontWeight: FontWeight.w600)),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}