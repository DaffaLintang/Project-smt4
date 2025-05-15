import 'package:flutter/material.dart';
import 'package:flutter_easyloading/flutter_easyloading.dart';
import 'package:get/get.dart';
import '../providers/bmi_provider.dart';

class BmiController extends GetxController {
  final TextEditingController weightController = TextEditingController();
  final TextEditingController heightController = TextEditingController();
  final TextEditingController ageController = TextEditingController();
  final RxString gender = ''.obs;

  RxString result = ''.obs;
  RxString category = ''.obs;
  RxString bmiRange = ''.obs;
  Rx<Color> categoryColor = Colors.black.obs;
  RxString prediction = ''.obs; // Tambahan untuk hasil dari API Flask

  void calculateAndSendBMI() {
    try {
      if (weightController.text.isEmpty ||
          heightController.text.isEmpty ||
          ageController.text.isEmpty ||
          gender.value.isEmpty) {
        Get.snackbar('Error', 'Semua kolom harus diisi!',
            backgroundColor: Colors.red, colorText: Colors.white);
        return;
      }

      double weight = double.parse(weightController.text);
      double height = double.parse(heightController.text);
      if (weight < 30 || weight > 300) {
        EasyLoading.showError('Berat tidak wajar (30-300 kg)');
        return;
      }
      if (height < 1.0 || height > 2.5) {
        EasyLoading.showError('Tinggi tidak wajar (1.0-2.5 m)');
        return;
      }

      double bmi = weight / (height * height);

      // Tetap hitung kategori dan warna meskipun tidak ditampilkan di result.value
      if (bmi < 18.5) {
        category.value = "Berat Rendah";
        categoryColor.value = Colors.blue;
        bmiRange.value = "< 18.5";
      } else if (bmi < 24.9) {
        category.value = "Normal";
        categoryColor.value = Colors.green;
        bmiRange.value = "18.5 - 24.9";
      } else if (bmi < 29.9) {
        category.value = "Berat Berlebih";
        categoryColor.value = Colors.orange;
        bmiRange.value = "25 - 29.9";
      } else {
        category.value = "Obesitas";
        categoryColor.value = Colors.red;
        bmiRange.value = "≥ 30";
      }

      // Hanya tampilkan BMI dan range sehat, tanpa kategori
      result.value =
          "BMI Kamu: ${bmi.toStringAsFixed(1)}\nRange Sehat: ${bmiRange.value}";

      // Kirim ke server Flask
      EasyLoading.show(status: 'Mengirim data...');
      var data = {
        "Weight": weight,
        "Height": height,
        "Age": int.parse(ageController.text),
        "Gender": gender.value,
      };

      print(data); // Debugging
      BmiProvider().bmi(data).then((response) {
        EasyLoading.dismiss();
        print("Status code: ${response.statusCode}");

        if (response.statusCode == 200 || response.statusCode == 201) {
          final body = response.body;
          print('Response body: $body');

          // Tangkap hasil prediction jika tersedia
          if (body.containsKey('prediction')) {
            prediction.value = body['prediction'];
          } else {
            prediction.value = 'Tidak ada hasil prediksi';
          }

          Get.snackbar('Sukses', 'Data BMI berhasil dikirim',
              backgroundColor: Colors.green, colorText: Colors.white);
        } else {
          Get.snackbar('Gagal', 'Gagal mengirim data BMI',
              backgroundColor: Colors.red, colorText: Colors.white);
        }
      }).catchError((e) {
        EasyLoading.dismiss();
        Get.snackbar('Kesalahan', 'Gagal mengirim data ke server',
            backgroundColor: Colors.red, colorText: Colors.white);
        print('Catch error: $e');
      });
    } catch (e, s) {
      EasyLoading.dismiss();
      Get.snackbar('Exception', 'Terjadi kesalahan: $e',
          backgroundColor: Colors.red, colorText: Colors.white);
      print('Error: $e\n$s');
    }
  }

  void resetFields() {
    weightController.clear();
    heightController.clear();
    ageController.clear();
    gender.value = '';
    result.value = '';
    category.value = '';
    categoryColor.value = Colors.black;
    prediction.value = ''; // Reset prediction juga
  }
}
