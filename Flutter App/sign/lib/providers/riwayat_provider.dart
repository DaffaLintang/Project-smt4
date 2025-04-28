import 'package:get/get_connect/connect.dart';
import 'package:sign/apiVar.dart';
import 'package:sp_util/sp_util.dart';

class RiwayatProvider extends GetConnect {
  Future<Response> histori(Map<String, dynamic> data) async {
    final token = await SpUtil.getString('token');
    return await post(
      HistoriAPI,
      data,
      headers: {
        'Authorization': 'Bearer $token',
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
    );
  }
}
