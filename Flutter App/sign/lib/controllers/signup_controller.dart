import 'package:flutter/material.dart';
import 'package:flutter_easyloading/flutter_easyloading.dart';
import 'package:get/get.dart';
import 'package:sign/screens/login_page.dart';
import 'package:sp_util/sp_util.dart';

import '../providers/signup_provider.dart';

class SignupController extends GetxController {
  static TextEditingController emailController = TextEditingController();
  static TextEditingController passwordController = TextEditingController();
  static TextEditingController passwordConfirmController =
      TextEditingController(); // Tambah ini

  void register() {
    String email = emailController.text.trim();
    String password = passwordController.text.trim();
    String passwordConfirm =
        passwordConfirmController.text.trim(); // ambil benar
    try {
      if (email.isEmpty || password.isEmpty || passwordConfirm.isEmpty) {
        Get.snackbar('Error', 'Email atau Password Tidak Boleh Kosong',
            backgroundColor: Colors.red, colorText: Colors.white);
      } else if (!email.endsWith('@gmail.com')) {
        Get.snackbar('Error', 'Format Email Salah',
            backgroundColor: Colors.red, colorText: Colors.white);
      } else if (password != passwordConfirm) {
        Get.snackbar('Error', 'Password dan Konfirmasi Password tidak sama',
            backgroundColor: Colors.red, colorText: Colors.white);
      } else {
        EasyLoading.show();
        var data = {
          "name": "user",
          "email": email,
          "password": password,
          "role": "user"
        };
        RegProvider().register(data).then((value) {
          print("Status code : ${value.statusCode}");
          print("Status code : ${value.body}");
          if (value.statusCode == 201) {
            emailController.clear();
            passwordController.clear();
            passwordConfirmController.clear();

            final responseData = value.body;
            Get.offAll(() => LoginPage());
            Get.snackbar('Success', 'Register Berhasil',
                backgroundColor: Color.fromARGB(255, 75, 212, 146),
                colorText: Colors.white);
          } else {
            Get.snackbar('Error', 'Register Gagal',
                backgroundColor: Colors.red, colorText: Colors.white);
          }
          EasyLoading.dismiss();
        });
      }
    } catch (e, stackTrace) {
      print('Exception occurred: $e\n$stackTrace');
      EasyLoading.dismiss();
    }
  }
}
