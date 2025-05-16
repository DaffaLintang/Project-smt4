import 'package:get/get_connect/connect.dart';
import 'package:sign/apiVar.dart';

class BmiProvider extends GetConnect {
  Future<Response> bmi(var data) {
    return post(BmiAPI, data);
  }
}
