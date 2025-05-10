import 'package:flutter/material.dart';

class SignUpPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        child: Padding(
          padding: EdgeInsets.symmetric(
              horizontal: 30.0, vertical: 50), // Menggeser tampilan ke atas
          child: Column(
            mainAxisAlignment:
                MainAxisAlignment.start, // Mengatur agar elemen lebih ke atas
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              // Logo
              Image.asset(
                'assets/image/logo.png',
                height: 180, // Ukuran sedikit dikurangi
              ),
              SizedBox(height: 20), // Kurangi jarak agar lebih ke atas

              // "Create Account"
              Text(
                'Create Account',
                style: TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.w900, // Extra bold
                ),
              ),
              SizedBox(height: 15),

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
              SizedBox(height: 15),

              // Input Password
              SizedBox(
                width: 350,
                child: TextField(
                  obscureText: true,
                  decoration: InputDecoration(
                    labelText: 'Password',
                    border: UnderlineInputBorder(),
                  ),
                ),
              ),
              SizedBox(height: 15),

              // Input Konfirmasi Password
              SizedBox(
                width: 350,
                child: TextField(
                  obscureText: true,
                  decoration: InputDecoration(
                    labelText: 'Confirmation Password',
                    border: UnderlineInputBorder(),
                  ),
                ),
              ),
              SizedBox(height: 30),

              // Tombol Sign Up
              ElevatedButton(
                onPressed: () {
                  // Tambahkan logika registrasi di sini
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.red[900],
                  minimumSize: Size(300, 50),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(30),
                  ),
                ),
                child: Text(
                  'SIGN UP',
                  style: TextStyle(color: Colors.white),
                ),
              ),
              SizedBox(height: 10),

              // Forgot Password tetap di tengah
              Center(
                child: TextButton(
                  onPressed: () {
                    Navigator.pushNamed(context, '/');
                  },
                  child: Text(
                    'Back To Login Page',
                    style: TextStyle(color: Colors.blue),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
