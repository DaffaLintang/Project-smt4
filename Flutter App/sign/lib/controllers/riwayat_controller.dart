import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_easyloading/flutter_easyloading.dart';
import 'package:get/get.dart';
import 'package:get/get_state_manager/get_state_manager.dart';
import 'package:http/http.dart' as http;
import 'package:sign/apiVar.dart';
import 'package:sign/models/riwayat_model.dart';
import 'package:sign/providers/riwayat_provider.dart';
import 'package:sign/screens/latihan_page.dart';
import 'package:sign/screens/menu.dart';
import 'package:sp_util/sp_util.dart';

class RiwayatController extends GetxController {
  final isLoading = false.obs;
  String? userId = SpUtil.getString('user_id');
  String? token = SpUtil.getString('token');

  TextEditingController levelController = TextEditingController();
  TextEditingController repetisiController = TextEditingController();
  TextEditingController catatanController = TextEditingController();
  TextEditingController durasiController = TextEditingController();

  TextEditingController levelControllerHistori = TextEditingController();
  TextEditingController repetisiControllerHistori = TextEditingController();
  TextEditingController catatanControllerHistori = TextEditingController();
  TextEditingController durasiControllerHistori = TextEditingController();

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

  Future<List<Histori>?> getDetailRiwayat() async {
    try {
      isLoading.value = true;
      final uri = Uri.parse("$HistoriAPI/$userId");
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
        return dataList.map((item) => Histori.fromJson(item)).toList();
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

  void riwayatUpdate(
    idRiwayat,
    idResult,
    durasi,
    repetisi,
    kesulitan,
    catatan,
  ) async {
    final endpoint = Uri.parse('$HistoriAPI/$idRiwayat');
    try {
      if (durasi.isEmpty ||
          repetisi.isEmpty ||
          kesulitan.isEmpty ||
          catatan.isEmpty) {
        Get.snackbar('Error', 'Data Tidak Boleh Kosong',
            backgroundColor: Colors.red, colorText: Colors.white);
        return;
      }

      EasyLoading.show();

      var request = http.MultipartRequest("POST", endpoint);
      request.headers['Authorization'] = 'Bearer $token';
      request.headers['Accept'] = 'application/json';

      request.fields['id_user'] = '$userId';
      request.fields['id_result'] = '$idResult';
      request.fields['durasi'] = durasi;
      request.fields['repetisi'] = repetisi;
      request.fields['kesulitan'] = kesulitan;
      request.fields['catatan'] = catatan;
      request.fields['_method'] = "PUT";

      var response = await request.send();
      var responseData = await http.Response.fromStream(response);

      EasyLoading.dismiss();

      if (response.statusCode == 200) {
        Get.offAll(() => RiwayatLatihan());
        Get.snackbar('Success', 'Data Berhasil Diperbarui',
            backgroundColor: Colors.green, colorText: Colors.white);
      } else {
        Get.snackbar('Error', 'Gagal Mengupdate Data',
            backgroundColor: Colors.red, colorText: Colors.white);
        print('Error: ${responseData.body}');
      }
    } catch (e) {
      EasyLoading.dismiss();
      Get.snackbar('Error', 'Terjadi Kesalahan: $e',
          backgroundColor: Colors.red, colorText: Colors.white);
      print('Exception: $e');
    }
  }
}
