import 'package:flutter/material.dart';
import 'package:flutter_easyloading/flutter_easyloading.dart';
import 'package:get/get_navigation/src/root/get_material_app.dart';
import 'package:sign/screens/menu.dart';
import 'package:sp_util/sp_util.dart';
import 'screens/login_page.dart';
import 'screens/forgot_password.dart';
import 'screens/signup_page.dart';
import 'screens/bmi.dart';

void main() async {
  runApp(MyApp());
  await SpUtil.getInstance();
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return GetMaterialApp(
      debugShowCheckedModeBanner: false,
      initialRoute: '/',
      builder: EasyLoading.init(),
      routes: {
        '/': (context) => LoginPage(),
        '/forgot-password': (context) => ForgotPassword(),
        '/signup': (context) => SignUpPage(),
        '/bmi': (context) => BMICalculatorScreen(),
        '/menu': (context) => Menu(),
      },
    );
  }
}
