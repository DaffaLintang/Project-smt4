import 'package:flutter/material.dart';
import 'package:sign/controllers/signup_controller.dart';
import 'package:get/get.dart';

class SignUpPage extends StatefulWidget {
  @override
  State<SignUpPage> createState() => _SignUpPageState();
}

class _SignUpPageState extends State<SignUpPage> {
  final SignupController controller = Get.put(SignupController());
  bool _obscurePassword = true;
  bool _obscurePasswordConfirm = true;

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
                  controller: SignupController.emailController,
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
                  controller: SignupController.passwordController,
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
                ),
              ),
              SizedBox(height: 15),

              // Input Konfirmasi Password
              SizedBox(
                width: 350,
                child: TextField(
                  controller: SignupController.passwordConfirmController,
                  obscureText: _obscurePasswordConfirm,
                  decoration: InputDecoration(
                    labelText: 'Confirmation Password',
                    border: UnderlineInputBorder(),
                    suffixIcon: IconButton(
                      icon: Icon(
                        _obscurePasswordConfirm
                            ? Icons.visibility_off
                            : Icons.visibility,
                      ),
                      onPressed: () {
                        setState(() {
                          _obscurePasswordConfirm = !_obscurePasswordConfirm;
                        });
                      },
                    ),
                  ),
                ),
              ),
              SizedBox(height: 30),

              // Tombol Sign Up
              ElevatedButton(
                onPressed: () {
                  controller.register();
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
              Center(
                  child: TextButton(
                      onPressed: () {
                        Navigator.pushNamed(context, '/');
                      },
                      child: Text(
                        'Back To Login Page',
                        style: TextStyle(color: Colors.blue),
                      ))),
            ],
          ),
        ),
      ),
    );
  }
}
