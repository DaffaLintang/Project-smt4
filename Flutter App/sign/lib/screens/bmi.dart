import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:sign/apiVar.dart';
import 'package:sp_util/sp_util.dart';
import '../controllers/bmi_controller.dart';

class BMICalculatorScreen extends StatelessWidget {
  final BmiController controller = Get.put(BmiController());
  final String? profileImage = SpUtil.getString('profileImage');

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        leading: IconButton(
          icon: Icon(Icons.arrow_back, color: Colors.white),
          onPressed: () => Get.back(),
        ),
        actions: [
          Padding(
            padding: const EdgeInsets.only(right: 20),
            child: profileImage == null || profileImage!.isEmpty
                ? Icon(Icons.person, color: Colors.white)
                : CircleAvatar(
                    backgroundImage: NetworkImage('$MainUrl/$profileImage'),
                  ),
          )
        ],
        backgroundColor: Color.fromRGBO(159, 0, 0, 1),
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 30.0),
          child: Obx(() => Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  SizedBox(height: 20),
                  Text("Hitung BMI mu Sekarang",
                      style:
                          TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
                  SizedBox(height: 35),
                  Row(
                    children: [
                      Expanded(
                          child: buildTextField(
                              "Tinggi (m)", controller.heightController)),
                      SizedBox(width: 25),
                      Expanded(
                          child: buildTextField(
                              "Berat (kg)", controller.weightController)),
                    ],
                  ),
                  SizedBox(height: 40),
                  Row(
                    children: [
                      Expanded(
                          child:
                              buildTextField("Usia", controller.ageController)),
                      SizedBox(width: 25),
                      Expanded(child: buildDropdown()),
                    ],
                  ),
                  SizedBox(height: 40),
                  Row(
                    children: [
                      Expanded(
                          child: buildButton(
                              "CALCULATE", controller.calculateAndSendBMI)),
                      SizedBox(width: 25),
                      Expanded(
                          child: buildButton("RESET", controller.resetFields)),
                    ],
                  ),
                  SizedBox(height: 30),
                  buildResult(controller),
                ],
              )),
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
        contentPadding: EdgeInsets.symmetric(vertical: 7, horizontal: 12),
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
    final controller = Get.find<BmiController>();
    return DropdownButtonFormField<String>(
      value: controller.gender.value.isEmpty ? null : controller.gender.value,
      decoration: InputDecoration(
        contentPadding: EdgeInsets.symmetric(vertical: 7, horizontal: 12),
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
        controller.gender.value = newValue!;
      },
    );
  }

  Widget buildButton(String text, VoidCallback onPressed) {
    return ElevatedButton(
      style: ElevatedButton.styleFrom(
        backgroundColor: const Color(0xFF9F0000),
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(25)),
        padding: EdgeInsets.symmetric(vertical: 7),
        minimumSize: Size(double.infinity, 36),
      ),
      onPressed: onPressed,
      child: Text(text, style: TextStyle(color: Colors.white, fontSize: 15)),
    );
  }

  Widget buildResult(BmiController controller) {
    return controller.result.value.isNotEmpty
        ? Center(
            child: Container(
              padding: EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: controller.categoryColor.value.withOpacity(0.2),
                borderRadius: BorderRadius.circular(10),
              ),
              child: Column(
                mainAxisSize: MainAxisSize.min,
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  Text(
                    controller.result.value,
                    textAlign: TextAlign.center,
                    style: TextStyle(
                        fontSize: 16,
                        fontWeight: FontWeight.w600,
                        color: Colors.black),
                  ),
                  SizedBox(height: 10),
                  if (controller.prediction.value.isNotEmpty) ...[
                    Divider(color: Colors.black),
                    SizedBox(height: 10),
                    Text(
                      "Prediction:",
                      style: TextStyle(
                          fontSize: 16,
                          fontWeight: FontWeight.bold,
                          color: Colors.purple),
                    ),
                    SizedBox(height: 5),
                    Text(
                      controller.prediction.value,
                      style: TextStyle(fontSize: 14, color: Colors.black87),
                      textAlign: TextAlign.center,
                    ),
                  ]
                ],
              ),
            ),
          )
        : Container();
  }
}
