import 'package:flutter/material.dart';

class LoginPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: Padding(
          padding: EdgeInsets.all(20.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // Menampilkan Gambar dari Aset (Tetap di tengah)
              Center(
                child: Image.asset(
                  'assets/image/logo.png',
                  height: 200,
                ),
              ),
              SizedBox(height: 30),

              Center(
                child: Text(
                  'Hello, Welcome !',
                  style: TextStyle(
                    fontSize: 24,
                    fontWeight: FontWeight.w900,
                  ),
                ),
              ),
              SizedBox(height: 30),

              // Input Username lebih pendek
              Center(
                child: SizedBox(
                  width: 350, // Lebih pendek
                  child: TextField(
                    decoration: InputDecoration(
                      labelText: 'Username',
                      border: UnderlineInputBorder(),
                    ),
                  ),
                ),
              ),
              SizedBox(height: 10),

              // Input Password lebih pendek
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
              SizedBox(height: 20),

              // Tombol Login (Tetap di tengah)
              Center(
                child: ElevatedButton(
                  onPressed: () {
                    // Fungsi login bisa ditambahkan di sini
                    print("Login button pressed");
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red[900],
                    padding: EdgeInsets.symmetric(vertical: 20, horizontal: 120),
                  ),
                  child: Text(
                    'LOGIN',
                    style: TextStyle(color: Colors.white),
                  ),
                ),
              ),
              SizedBox(height: 10),

              // Forgot Password tetap di tengah
              Center(
                child: TextButton(
                  onPressed: () {
                    Navigator.pushNamed(context, '/forgot-password');
                  },
                  child: Text(
                    'Forgot Password?',
                    style: TextStyle(color: Colors.blue),
                  ),
                ),
              ),
              SizedBox(height: 120),

              // "Don't Have an Account?" tetap di tengah
              Center(child: Text("Don't Have an Account?")),
              SizedBox(height: 10),

              // Tombol Sign Up (Tetap di tengah)
              Center(
                child: ElevatedButton(
                  onPressed: () {
                    Navigator.pushNamed(context, '/signup'); // Navigasi ke Sign Up
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red[900],
                    padding: EdgeInsets.symmetric(vertical: 20, horizontal: 120),
                  ),
                  child: Text('SIGN UP', style: TextStyle(color: Colors.white)),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
