import 'package:flutter/material.dart';
import 'package:flutter_easyloading/flutter_easyloading.dart';
import 'package:get/get.dart';
import 'package:sign/screens/menu.dart';
import 'package:sp_util/sp_util.dart';

import '../providers/login_provider.dart';

class LoginController extends GetxController {
  static TextEditingController emailController = TextEditingController();
  static TextEditingController passwordController = TextEditingController();

  void auth() {
    String email = emailController.text;
    String password = passwordController.text;

    try {
      if (email.isEmpty || password.isEmpty) {
        Get.snackbar('Error', 'Email atau Password Tidak Boleh Kosong',
            backgroundColor: Colors.red, colorText: Colors.white);
      } else {
        EasyLoading.show();
        var data = {"email": email, "password": password};
        LoginProvider().auth(data).then((value) {
          print(value.body);
          if (value.statusCode == 200) {
            email = '';
            password = '';
            final responseData = value.body; // Pastikan ini berupa Map

            SpUtil.putInt('user_id', responseData["user_id"]);
            SpUtil.putString('token', responseData["token"]);

            print(SpUtil.getString('token'));
            print(SpUtil.getInt('user_id'));

            Get.offAll(() => Menu());
            Get.snackbar('Success', 'Login Berhasil',
                backgroundColor: Color.fromARGB(255, 75, 212, 146),
                colorText: Colors.white);
          } else {
            Get.snackbar('Error', 'Login Gagal',
                backgroundColor: Colors.red, colorText: Colors.white);
          }
          EasyLoading.dismiss();
        });
      }
    } catch (e, stackTrace) {
      print('Exception occurred: $e\n$stackTrace');
    }
  }
}
