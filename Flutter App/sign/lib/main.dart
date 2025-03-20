import 'package:flutter/material.dart';
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
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      initialRoute: '/', // Halaman awal saat aplikasi dibuka
      routes: {
        '/': (context) => LoginPage(),
        '/forgot-password': (context) => ForgotPassword(),
        '/signup': (context) => SignUpPage(),
        '/bmi': (context) => BMICalculatorApp(),
     },
);
}
}