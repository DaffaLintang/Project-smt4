import 'package:get/get_connect/connect.dart';
import 'package:sign/apiVar.dart';

class RegProvider extends GetConnect {
  Future<Response> register(var data) {
    return post(ProfileAPI, data);
  }
}
