import 'package:flutter/material.dart';
import 'package:flutter_easyloading/flutter_easyloading.dart';
import 'package:get/get_navigation/src/root/get_material_app.dart';
import 'package:sign/screens/menu.dart';
import 'package:sp_util/sp_util.dart';
import 'screens/login_page.dart';
import 'screens/forgot_password.dart';
import 'screens/signup_page.dart';
import 'screens/bmi.dart';
import 'screens/splash_screen.dart'; // Tambahkan import splash

void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await SpUtil.getInstance();
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return GetMaterialApp(
      debugShowCheckedModeBanner: false,
      initialRoute: '/splash', // Ganti ke splash screen
      builder: EasyLoading.init(),
      routes: {
        '/splash': (context) => SplashScreen(),
        '/': (context) => LoginPage(),
        '/forgot-password': (context) => ForgotPassword(),
        '/signup': (context) => SignUpPage(),
        '/bmi': (context) => BMICalculatorScreen(),
        '/menu': (context) => Menu(),
      },
    );
  }
}
