import 'dart:convert';
import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter_easyloading/flutter_easyloading.dart';
import 'package:get/get.dart';
import 'package:get/get_state_manager/get_state_manager.dart';
import 'package:sign/apiVar.dart';
import 'package:sign/models/profile_model.dart';
import 'package:http/http.dart' as http;
import 'package:sp_util/sp_util.dart';

class ProfileController extends GetxController {
  final isLoading = false.obs;
  String? token = SpUtil.getString('token');
  int? userId = SpUtil.getInt('user_id');

  static TextEditingController fullNameController = TextEditingController();
  static TextEditingController emailController = TextEditingController();
  static TextEditingController mobilePhoneController = TextEditingController();
  static TextEditingController dateController = TextEditingController();
  static TextEditingController weightController = TextEditingController();
  static TextEditingController heightController = TextEditingController();

  Future<User?> getProfile() async {
    try {
      isLoading.value = true;
      final uri = Uri.parse("$ProfileAPI/$userId");
      final response = await http.get(
        uri,
        headers: {
          'Authorization': 'Bearer $token',
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
      );

      if (response.statusCode == 200) {
        final jsonResponse = jsonDecode(response.body);
        final Map<String, dynamic> userData = jsonResponse['data'];
        isLoading.value = false;
        return User.fromJson(userData);
      } else {
        print('Error: Unexpected response format');
        throw Exception('Failed to load data: ${response.statusCode}');
      }
    } catch (e) {
      isLoading.value = false;
      print('Error: ${e.toString()}');
      return null;
    }
  }

  void profileStore(
      fullname, email, phone, birth, weight, height, File? image) async {
    final endpoint = Uri.parse('$ProfileAPI/$userId');

    try {
      if (fullname.isEmpty ||
          email.isEmpty ||
          phone.isEmpty ||
          birth.isEmpty ||
          weight.isEmpty ||
          height.isEmpty) {
        Get.snackbar('Error', 'Data Tidak Boleh Kosong',
            backgroundColor: Colors.red, colorText: Colors.white);
        return;
      }

      print(phone);

      EasyLoading.show();

      var request = http.MultipartRequest("POST", endpoint);
      request.headers['Authorization'] = 'Bearer $token';
      request.headers['Accept'] = 'application/json';

      request.fields['full_name'] = fullname;
      request.fields['email'] = email;
      request.fields['phone'] = phone;
      request.fields['birth'] = birth;
      request.fields['weight'] = weight;
      request.fields['height'] = height;
      request.fields['_method'] = "PUT";

      if (image != null) {
        request.files.add(
          await http.MultipartFile.fromPath(
            'image',
            image.path,
          ),
        );
      }

      var response = await request.send();
      var responseData = await http.Response.fromStream(response);

      EasyLoading.dismiss();

      if (response.statusCode == 200) {
        Get.snackbar('Success', 'Data Berhasil Diperbarui',
            backgroundColor: Colors.green, colorText: Colors.white);
      } else {
        Get.snackbar('Error', 'Gagal Mengupdate Data',
            backgroundColor: Colors.red, colorText: Colors.white);
        print('Error: ${responseData.body}');
      }
    } catch (e) {
      EasyLoading.dismiss();
      Get.snackbar('Error', 'Terjadi Kesalahan: $e',
          backgroundColor: Colors.red, colorText: Colors.white);
      print('Exception: $e');
    }
  }
}
