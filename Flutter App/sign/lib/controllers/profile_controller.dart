import 'dart:convert';
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

  Future<List<User>?> getProfile() async {
    try {
      isLoading.value = true;
      final uri = Uri.parse("$ProfileAPI/$userId");
      print(uri);
      print(userId);
      print(token);
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
        final List<dynamic> userData = jsonResponse['data'];
        isLoading.value = false;
        return userData.map((data) => User.fromJson(data)).toList();
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
}
