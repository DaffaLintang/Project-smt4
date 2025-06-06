import 'package:flutter/material.dart';
import 'package:sign/controllers/login_controller.dart';

class LoginPage extends StatefulWidget {
  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  bool _obscurePassword = true;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        child: Padding(
          padding: EdgeInsets.symmetric(
              horizontal: 30.0, vertical: 50), // Menggeser tampilan ke atas
          child: Column(
            crossAxisAlignment: CrossAxisAlignment
                .start, // Mengatur agar teks input tidak di tengah
            children: [
              // Gambar logo tetap di tengah
              Center(
                child: Image.asset(
                  'assets/image/logo.png',
                  height: 180, // Ukuran sedikit dikurangi
                ),
              ),
              SizedBox(height: 20), // Kurangi jarak agar lebih ke atas

              // "Hello, Welcome!"
              Center(
                child: Text(
                  'Hello, Welcome!',
                  style: TextStyle(
                    fontSize: 24,
                    fontWeight: FontWeight.w900,
                  ),
                ),
              ),
              SizedBox(height: 20),

              // Input Username (Tidak center)
              TextField(
                decoration: InputDecoration(
                  labelText: 'Email',
                  border: UnderlineInputBorder(),
                ),
                controller: LoginController.emailController,
              ),
              SizedBox(height: 15),

              // Input Password (Tidak center)
              TextField(
                obscureText: _obscurePassword,
                decoration: InputDecoration(
                  labelText: 'Password',
                  border: UnderlineInputBorder(),
                  suffixIcon: IconButton(
                    icon: Icon(
                      _obscurePassword
                          ? Icons.visibility_off
                          : Icons.visibility,
                    ),
                    onPressed: () {
                      setState(() {
                        _obscurePassword = !_obscurePassword;
                      });
                    },
                  ),
                ),
                controller: LoginController.passwordController,
              ),
              SizedBox(height: 20),

              // Tombol Login (Tetap di tengah)
              Center(
                child: ElevatedButton(
                  onPressed: () {
                    LoginController().auth();
                    LoginController.emailController.text = "";
                    LoginController.passwordController.text = "";
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red[900],
                    minimumSize: Size(300, 50),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(30),
                    ),
                  ),
                  child: Text(
                    'LOGIN',
                    style: TextStyle(color: Colors.white),
                  ),
                ),
              ),
              SizedBox(height: 10),

              // Forgot Password tetap di tengah
              // Center(
              //   child: TextButton(
              //     onPressed: () {
              //       Navigator.pushNamed(context, '/forgot-password');
              //     },
              //     child: Text(
              //       'Forgot Password?',
              //       style: TextStyle(color: Colors.blue),
              //     ),
              //   ),
              // ),
              SizedBox(height: 50), // Mengurangi tinggi agar lebih ke atas

              // "Don't Have an Account?" tetap di tengah
              Center(child: Text("Don't Have an Account?")),
              SizedBox(height: 10),

              // Tombol Sign Up (Tetap di tengah)
              Center(
                child: ElevatedButton(
                  onPressed: () {
                    Navigator.pushNamed(context, '/signup');
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red[900],
                    minimumSize: Size(300, 50),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(30),
                    ),
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
