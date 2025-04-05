import 'package:flutter/material.dart';
import 'package:flutter_easyloading/flutter_easyloading.dart';
import 'package:get/get.dart';
import 'package:sign/providers/rekomendasi_providers.dart';
import 'package:sp_util/sp_util.dart';

class RekomendasiController extends GetxController {
  var title = ''.obs;
  var RecomBodyPart = ''.obs;
  var RecomDesc = ''.obs;
  var RecomEquipment = ''.obs;
  var RecomLevel = ''.obs;
  var RecomType = ''.obs;

  int? userId = SpUtil.getInt('user_id');

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

        print("Posting result data: $data");

        RekomendasiProviders().result(data).then((value) {
          print("API Response: ${value.body}");
          print("API Response: ${value.statusCode}");

          EasyLoading.dismiss();
        });
      }
    } catch (e, stackTrace) {
      print('Exception occurred: $e\n$stackTrace');
      EasyLoading.dismiss();
    }
  }
}
