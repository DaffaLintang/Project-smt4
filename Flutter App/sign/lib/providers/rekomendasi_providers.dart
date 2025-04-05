import 'package:get/get_connect/connect.dart';
import 'package:sign/apiVar.dart';
import 'package:sp_util/sp_util.dart';

class RekomendasiProviders extends GetConnect {
  Future<Response> result(Map<String, dynamic> data) async {
    final token = await SpUtil.getString('token');
    return await post(
      ResultApi,
      data,
      headers: {
        'Authorization': 'Bearer $token',
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
    );
  }

  Future<Response> rekomendasi(var data) {
    return post(RekomendasiApi, data);
  }
}
