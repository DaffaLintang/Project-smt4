import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'login_page.dart'; // Atau halaman tujuan utama kamu

class SplashScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    Future.delayed(Duration(seconds: 1), () {
      Get.off(() => LoginPage()); // Pindah ke halaman utama
    });

    return Scaffold(
      backgroundColor: Colors.white,
      body: Center(
        child: Image.asset('assets/image/splash.png', width: 400), // Sesuaikan
      ),
    );
  }
}

