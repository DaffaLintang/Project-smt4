import 'package:flutter/material.dart';
import 'package:get/get_navigation/src/root/get_material_app.dart';
import 'package:sign/screens/menu.dart';
import 'screens/login_page.dart';
import 'screens/forgot_password.dart';
import 'screens/signup_page.dart';
import 'screens/bmi.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return GetMaterialApp(
      debugShowCheckedModeBanner: false,
      initialRoute:
          '/menu', // Langsung menuju BMI Calculator saat aplikasi dibuka
      routes: {
        '/': (context) => LoginPage(),
        '/forgot-password': (context) => ForgotPassword(),
        '/signup': (context) => SignUpPage(),
        '/bmi': (context) => BMICalculatorApp(), // Route untuk BMI Calculator
        '/menu': (context) => Menu(),
      },
    );
  }
}
