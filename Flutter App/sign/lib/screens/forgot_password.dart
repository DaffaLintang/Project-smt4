import 'package:flutter/material.dart';

class ForgotPassword extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        child: Padding(
          padding: EdgeInsets.symmetric(horizontal: 30.0, vertical: 50), // Menambahkan padding atas
          child: Column(
            mainAxisAlignment: MainAxisAlignment.start, // Menggeser ke atas
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              // Logo tetap di tengah
              Image.asset(
                'assets/image/logo.png',
                height: 180, // Ukuran sedikit dikurangi agar lebih ke atas
              ),
              SizedBox(height: 20), // Kurangi jarak antara elemen

              // Judul "Forgot Password"
              Text(
                'Forgot Password',
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.w900, // Extra bold
                ),
              ),
              SizedBox(height: 10),

              // Deskripsi
              Text(
                'Enter your registered email. We will send you a token to recover your account.',
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontSize: 14,
                  color: Colors.black54,
                ),
              ),
              SizedBox(height: 25), // Kurangi jarak

              // Input Email
              SizedBox(
                width: 350,
                child: TextField(
                  decoration: InputDecoration(
                    labelText: 'Email',
                    border: UnderlineInputBorder(),
                  ),
                ),
              ),
              SizedBox(height: 15), // Kurangi jarak

              // Input Token Verification
              SizedBox(
                width: 350,
                child: TextField(
                  decoration: InputDecoration(
                    labelText: 'Token Verification',
                    border: UnderlineInputBorder(),
                  ),
                ),
              ),
              SizedBox(height: 30), // Kurangi jarak

              // Tombol Send Token
              ElevatedButton(
                onPressed: () {
                  // Aksi ketika tombol ditekan
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.red[900],
                  minimumSize: Size(300, 50),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(30),
                  ),
                ),
                child: Text(
                  'SEND TOKEN',
                  style: TextStyle(color: Colors.white),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
