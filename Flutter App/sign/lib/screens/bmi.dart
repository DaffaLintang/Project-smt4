import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:sign/apiVar.dart';
import 'package:sp_util/sp_util.dart';

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
  String? profileImage = SpUtil.getString('profileImage');
  final TextEditingController _weightController = TextEditingController();
  final TextEditingController _heightController = TextEditingController();
  final TextEditingController _ageController = TextEditingController();

  String? _gender;
  String _result = "";
  String _category = "";
  Color _categoryColor = Colors.black;
  String _bmiRange = "";

  void _calculateBMI() {
    if (_weightController.text.isEmpty ||
        _heightController.text.isEmpty ||
        _ageController.text.isEmpty ||
        _gender == null) {
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
      appBar: AppBar(
        leading: IconButton(
          icon: Icon(Icons.arrow_back, color: Colors.white),
          onPressed: () {
            Get.back(); // Menggunakan GetX untuk kembali
          },
        ),
        automaticallyImplyLeading: true,
        actions: [
          Padding(
              padding: const EdgeInsets.only(right: 20),
              child: profileImage!.isEmpty
                  ? Container(
                      height: 40,
                      width: 40,
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(50),
                      ),
                      child: Icon(Icons.person),
                    )
                  : Container(
                      height: 40,
                      width: 40,
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(50),
                        image: DecorationImage(
                          fit: BoxFit.cover,
                          image: NetworkImage('$MainUrl/$profileImage'),
                        ),
                      ),
                    ))
        ],
        iconTheme: IconThemeData(color: Colors.white),
        backgroundColor: Color.fromRGBO(159, 0, 0, 1),
      ),
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Padding(
              padding: const EdgeInsets.only(left: 20.0, top: 10, bottom: 10),
              child: Text(
                "BMI",
                style: TextStyle(fontSize: 26, fontWeight: FontWeight.bold),
              ),
            ),
            Container(
              height: 1,
              width: double.infinity,
              color: const Color.fromRGBO(196, 196, 196, 0.7),
            ),
            SizedBox(height: 20),
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 30.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    "Hitung BMI mu Sekarang",
                    style: TextStyle(
                        fontSize: 18,
                        fontWeight: FontWeight.bold,
                        color: Colors.black),
                  ),
                  SizedBox(height: 35),
                  Row(
                    children: [
                      Expanded(
                          child:
                              buildTextField("Tinggi (cm)", _heightController)),
                      SizedBox(width: 25),
                      Expanded(
                          child:
                              buildTextField("Berat (kg)", _weightController)),
                    ],
                  ),
                  SizedBox(height: 40),
                  Row(
                    children: [
                      Expanded(child: buildTextField("Usia", _ageController)),
                      SizedBox(width: 25),
                      Expanded(child: buildDropdown()),
                    ],
                  ),
                  SizedBox(height: 40),
                  Row(
                    children: [
                      Expanded(child: buildButton("CALCULATE", _calculateBMI)),
                      SizedBox(width: 25),
                      Expanded(
                          child: buildButton("RESET", () {
                        setState(() {
                          _weightController.clear();
                          _heightController.clear();
                          _ageController.clear();
                          _gender = null;
                          _result = "";
                          _category = "";
                          _categoryColor = Colors.black;
                        });
                      })),
                    ],
                  ),
                  SizedBox(height: 30),
                  Center(child: buildResult()),
                ],
              ),
            )
          ],
        ),
      ),
    );
  }

  Widget buildTextField(String label, TextEditingController controller) {
    return TextField(
      controller: controller,
      keyboardType: TextInputType.number,
      decoration: InputDecoration(
        labelText: label,
        contentPadding: EdgeInsets.symmetric(
            vertical: 7, horizontal: 12), // Mengurangi tinggi
        focusedBorder: OutlineInputBorder(
          borderSide: BorderSide(color: const Color(0xFF9F0000)),
          borderRadius: BorderRadius.circular(25),
        ),
        enabledBorder: OutlineInputBorder(
          borderSide: BorderSide(color: const Color(0xFF9F0000)),
          borderRadius: BorderRadius.circular(25),
        ),
      ),
    );
  }

  Widget buildDropdown() {
    return DropdownButtonFormField<String>(
      value: _gender,
      isExpanded: true,
      decoration: InputDecoration(
        contentPadding: EdgeInsets.symmetric(
            vertical: 7, horizontal: 12), // Mengurangi tinggi input
        border: OutlineInputBorder(
          borderSide: BorderSide(color: const Color(0xFF9F0000)),
          borderRadius: BorderRadius.circular(25),
        ),
      ),
      hint: Text("Pilih Gender"),
      items: ["Male", "Female"].map((String value) {
        return DropdownMenuItem<String>(
          value: value,
          child: Text(value, style: TextStyle(color: Colors.black)),
        );
      }).toList(),
      onChanged: (newValue) {
        setState(() {
          _gender = newValue;
        });
      },
    );
  }

  Widget buildButton(String text, VoidCallback onPressed) {
    return ElevatedButton(
      style: ElevatedButton.styleFrom(
        backgroundColor: const Color(0xFF9F0000),
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(25)),
        padding: EdgeInsets.symmetric(vertical: 7), // Mengurangi tinggi padding
        minimumSize:
            Size(double.infinity, 36), // Menetapkan tinggi minimum tombol
      ),
      onPressed: onPressed,
      child: Text(text, style: TextStyle(color: Colors.white, fontSize: 15)),
    );
  }

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
