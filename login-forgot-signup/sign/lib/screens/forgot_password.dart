import 'package:flutter/material.dart';

class ForgotPassword extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: Padding(
          padding: EdgeInsets.symmetric(horizontal: 30.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center, // Semua elemen tetap di tengah
            children: [
              // Logo tetap di tengah
              Image.asset(
                'assets/image/logo.png',
                height: 200,
              ),
              SizedBox(height: 30),

              // Judul "Forgot Password" di tengah
              Text(
                'Forgot Password',
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.w900, // Extra bold
                ),
              ),
              SizedBox(height: 10),

              // Deskripsi tetap di tengah
              Text(
                'Enter your registered email. We will send you a token to recover your account.',
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontSize: 14,
                  color: Colors.black54,
                ),
              ),
              SizedBox(height: 30),

              // Input Email berada di tengah
              SizedBox(
                width: 350, // Lebih pendek
                child: TextField(
                  textAlign: TextAlign.center, // Teks di tengah
                  decoration: InputDecoration(
                    labelText: 'Email',
                    border: UnderlineInputBorder(),
                  ),
                ),
              ),
              SizedBox(height: 20),

              // Input Token Verification berada di tengah
              SizedBox(
                width: 350, // Lebih pendek
                child: TextField(
                  textAlign: TextAlign.center, // Teks di tengah
                  decoration: InputDecoration(
                    labelText: 'Token Verification',
                    border: UnderlineInputBorder(),
                  ),
                ),
              ),
              SizedBox(height: 40),

              // Tombol Send Token tetap di tengah
              ElevatedButton(
                onPressed: () {
                  // Aksi ketika tombol ditekan
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.red[900],
                  minimumSize: Size(300, 50), // Disesuaikan dengan input
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(30),
                  ),
                ),
                child: Text(
                  'SEND TOKEN',
                  style: TextStyle(color: Colors.white),
                ),
              ),

              SizedBox(height: 20),

              // Tombol kembali ke halaman Login tetap di tengah
              TextButton(
                onPressed: () {
                  Navigator.pop(context); // Kembali ke halaman sebelumnya
                },
                child: Text(
                  'Back to Login',
                  style: TextStyle(color: Colors.blue),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
