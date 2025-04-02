import 'package:get/get_connect/connect.dart';
import 'package:sign/apiVar.dart';

class LoginProvider extends GetConnect {
  Future<Response> auth(var data) {
    return post(LoginAPI, data);
  }
}
