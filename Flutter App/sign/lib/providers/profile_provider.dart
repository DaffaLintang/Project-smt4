import 'package:get/get_connect/connect.dart';
import 'package:sign/apiVar.dart';

class ProfileProvider extends GetConnect {
  Future<Response> auth(var data) {
    return post(ProfileAPI, data);
  }
}
