import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_easyloading/flutter_easyloading.dart';
import 'package:get/get.dart';
import 'package:sign/apiVar.dart';
import 'package:sign/models/result_model.dart';
import 'package:sign/providers/rekomendasi_providers.dart';
import 'package:sp_util/sp_util.dart';
import 'package:http/http.dart' as http;

class RekomendasiController extends GetxController {
  final isLoading = false.obs;
  var title = ''.obs;
  var RecomBodyPart = ''.obs;
  var RecomDesc = ''.obs;
  var RecomEquipment = ''.obs;
  var RecomLevel = ''.obs;
  var RecomType = ''.obs;

  String? userId = SpUtil.getString('user_id');
  String? token = SpUtil.getString('token');

  void rekomendasi(type, bodyPart, equipment, level) {
    try {
      if (bodyPart == null ||
          equipment == null ||
          type == null ||
          level == null) {
        Get.snackbar('Error', 'Data Tidak Boleh Kosong',
            backgroundColor: Colors.red, colorText: Colors.white);
      } else {
        EasyLoading.show();
        var data = {
          "Type": type,
          "BodyPart": bodyPart,
          "Equipment": equipment,
          "Level": level
        };
        RekomendasiProviders().rekomendasi(data).then((value) {
          print(value.body);
          if (value.statusCode == 200) {
            final responseData = value.body;
            title.value = responseData['recommendations'] != null &&
                    responseData['recommendations'].isNotEmpty &&
                    responseData['recommendations'][0]['Title'] != null
                ? responseData['recommendations'][0]['Title']
                : 'Rekomendasi tidak ditemukan';
            RecomBodyPart.value = responseData['recommendations'] != null &&
                    responseData['recommendations'].isNotEmpty &&
                    responseData['recommendations'][0]['BodyPart'] != null
                ? responseData['recommendations'][0]['BodyPart']
                : 'Rekomendasi tidak ditemukan';
            RecomEquipment.value = responseData['recommendations'] != null &&
                    responseData['recommendations'].isNotEmpty &&
                    responseData['recommendations'][0]['Equipment'] != null
                ? responseData['recommendations'][0]['Equipment']
                : 'Rekomendasi tidak ditemukan';
            RecomLevel.value = responseData['recommendations'] != null &&
                    responseData['recommendations'].isNotEmpty &&
                    responseData['recommendations'][0]['Level'] != null
                ? responseData['recommendations'][0]['Level']
                : 'Rekomendasi tidak ditemukan';
            RecomType.value = responseData['recommendations'] != null &&
                    responseData['recommendations'].isNotEmpty &&
                    responseData['recommendations'][0]['Type'] != null
                ? responseData['recommendations'][0]['Type']
                : 'Rekomendasi tidak ditemukan';
            RecomDesc.value = responseData['recommendations'] != null &&
                    responseData['recommendations'].isNotEmpty &&
                    responseData['recommendations'][0]['Desc'] != null
                ? responseData['recommendations'][0]['Desc']
                : '-';

            if (title.value != 'Rekomendasi tidak ditemukan') {
              resultPost(
                  RecomType.value,
                  RecomBodyPart.value,
                  RecomEquipment.value,
                  RecomLevel.value,
                  RecomDesc.value,
                  title.value,
                  userId);
            }

            if (title.value != 'Rekomendasi tidak ditemukan') {
              Get.snackbar('Success', 'Berhasil Memberi Rekomendasi',
                  backgroundColor: Color.fromARGB(255, 75, 212, 146),
                  colorText: Colors.white);
            } else {
              Get.snackbar('Error', 'Rekomendasi Tidak Ada',
                  backgroundColor: Colors.red, colorText: Colors.white);
            }
          } else {
            Get.snackbar('Error', 'Terjadi Error',
                backgroundColor: Colors.red, colorText: Colors.white);
          }
          EasyLoading.dismiss();
        });
      }
    } catch (e, stackTrace) {
      print('Exception occurred: $e\n$stackTrace');
    }
  }

  void resultPost(
      types, bodyParts, equipments, levels, descs, titles, userIds) {
    try {
      if (bodyParts == null ||
          equipments == null ||
          types == null ||
          levels == null ||
          titles == null ||
          userIds == null) {
        Get.snackbar('Error', 'Data Tidak Boleh Kosong',
            backgroundColor: Colors.red, colorText: Colors.white);
      } else {
        EasyLoading.show();
        if (descs.isEmpty) {
          descs = "-";
        }

        var data = {
          "bodyPart": bodyParts,
          "desc": descs,
          "equipment": equipments,
          "level": levels,
          "title": titles,
          "type": types,
          "id_user": userIds
        };

        RekomendasiProviders().result(data).then((value) {
          EasyLoading.dismiss();
        });
      }
    } catch (e, stackTrace) {
      print('Exception occurred: $e\n$stackTrace');
      EasyLoading.dismiss();
    }
  }

  Future<List<Result>?> getResults() async {
    try {
      isLoading.value = true;
      final uri = Uri.parse("$ResultApi/$userId");
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
        final List<dynamic> dataList = jsonResponse['data'];
        isLoading.value = false;
        return dataList.map((item) => Result.fromJson(item)).toList();
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
