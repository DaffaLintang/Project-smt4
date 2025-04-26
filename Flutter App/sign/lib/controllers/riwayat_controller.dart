import 'package:flutter/material.dart';
import 'package:flutter_easyloading/flutter_easyloading.dart';
import 'package:get/get.dart';
import 'package:get/get_state_manager/get_state_manager.dart';
import 'package:sign/providers/riwayat_provider.dart';
import 'package:sign/screens/menu.dart';
import 'package:sp_util/sp_util.dart';

class RiwayatController extends GetxController {
  final isLoading = false.obs;
  String? userId = SpUtil.getString('user_id');

  TextEditingController levelController = TextEditingController();
  TextEditingController repetisiController = TextEditingController();
  TextEditingController catatanController = TextEditingController();
  TextEditingController durasiController = TextEditingController();

  void historiPost(idResult, durasi, repetisi, kesulitan, catatan) {
    int repetisiInt = int.parse(repetisi);
    int durasiInt = int.parse(durasi);
    try {
      if (idResult == null ||
          durasi == null ||
          repetisi == null ||
          kesulitan == null) {
        Get.snackbar('Error', 'Data Tidak Boleh Kosong',
            backgroundColor: Colors.red, colorText: Colors.white);
      } else {
        EasyLoading.show();
        if (catatan.isEmpty) {
          catatan = "-";
        }

        var data = {
          "id_user": userId,
          "id_result": idResult,
          "durasi": durasiInt,
          "repetisi": repetisiInt,
          "kesulitan": kesulitan,
          "catatan": catatan
        };

        RiwayatProvider().histori(data).then((value) {
          if (value.statusCode == 201) {
            Get.snackbar('Success', 'Berhasil Simpan Data Histori',
                backgroundColor: Color.fromARGB(255, 75, 212, 146),
                colorText: Colors.white);
            Get.off(() => Menu());
          }
          EasyLoading.dismiss();
        });
      }
    } catch (e, stackTrace) {
      print('Exception occurred: $e\n$stackTrace');
      EasyLoading.dismiss();
    }
  }
}
