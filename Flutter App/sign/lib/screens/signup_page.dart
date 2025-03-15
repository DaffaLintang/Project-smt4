import 'package:flutter/material.dart';

class SignUpPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: Padding(
          padding: EdgeInsets.symmetric(horizontal: 30.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center, // Semua elemen ke tengah
            children: [
              // Logo di atas
              Image.asset(
                'assets/image/logo.png', // Sesuaikan path gambar
                height: 200,
              ),
              SizedBox(height: 30),

              // "Create Account" (Judul di tengah)
              Text(
                'Create Account',
                style: TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.w900, // Extra bold
                ),
              ),
              SizedBox(height: 20),

              // Input Email
              Center(
                child: SizedBox(
                  width: 350, // Lebih pendek
                  child: TextField(
                    obscureText: true,
                    decoration: InputDecoration(
                      labelText: 'Email',
                      border: UnderlineInputBorder(),
                    ),
                  ),
                ),
              ),
              SizedBox(height: 10),

              // Input Password
              Center(
                child: SizedBox(
                  width: 350, // Lebih pendek
                  child: TextField(
                    obscureText: true,
                    decoration: InputDecoration(
                      labelText: 'Password',
                      border: UnderlineInputBorder(),
                    ),
                  ),
                ),
              ),
              SizedBox(height: 10),

              // Input Konfirmasi Password
              Center(
                child: SizedBox(
                  width: 350, // Lebih pendek
                  child: TextField(
                    obscureText: true,
                    decoration: InputDecoration(
                      labelText: 'Confirmation Password',
                      border: UnderlineInputBorder(),
                    ),
                  ),
                ),
              ),
              SizedBox(height: 30),

              // Tombol Sign Up
              ElevatedButton(
                onPressed: () {
                  // Nanti bisa ditambahkan logika registrasi
                  print("Sign Up button pressed");
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.red[900],
                  minimumSize: Size(300, 50), // Lebar tombol
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(30),
                  ),
                ),
                child: Text(
                  'SIGN UP',
                  style: TextStyle(color: Colors.white),
                ),
              ),
              SizedBox(height: 20),
            ],
          ),
        ),
      ),
    );
  }
}
