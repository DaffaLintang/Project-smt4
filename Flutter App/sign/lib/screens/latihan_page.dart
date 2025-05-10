import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:sign/apiVar.dart';
import 'package:sign/controllers/riwayat_controller.dart';
import 'package:sign/models/riwayat_model.dart';
import 'package:sign/screens/menu.dart';
import 'package:sp_util/sp_util.dart';

class RiwayatLatihan extends StatefulWidget {
  const RiwayatLatihan({super.key});

  @override
  State<RiwayatLatihan> createState() => RiwayatLatihanState();
}

class RiwayatLatihanState extends State<RiwayatLatihan> {
  String? profileImage = SpUtil.getString('profileImage');
  final riwayatController = Get.put(RiwayatController());
  List<Histori>? histori;
  String? selectedResultId;

  void initState() {
    super.initState();
    fetchResult();
  }

  void fetchResult() async {
    histori = await riwayatController.getDetailRiwayat();
    setState(() {});
  }

  String? selectedValue;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        leading: GestureDetector(
            onTap: () {
              Get.offAll(() => Menu());
            },
            child: Icon(Icons.arrow_back)),
        actions: [
          Padding(
              padding: const EdgeInsets.only(right: 20),
              child: profileImage == null
                  ? Container(
                      height: 40,
                      width: 40,
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(50),
                      ),
                      child: Icon(Icons.person),
                    )
                  : Container(
                      height: 40,
                      width: 40,
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(50),
                        image: DecorationImage(
                          fit: BoxFit.cover,
                          image: NetworkImage('$MainUrl/$profileImage'),
                        ),
                      ),
                    ))
        ],
        iconTheme: IconThemeData(color: Colors.white),
        backgroundColor: Color.fromRGBO(159, 0, 0, 1),
      ),
      body: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Padding(
            padding: const EdgeInsets.only(left: 20.0, top: 10, bottom: 10),
            child: Text(
              "Riwayat Workout",
              style: TextStyle(fontSize: 25, fontWeight: FontWeight.w500),
            ),
          ),
          Container(
            height: 1,
            width: double.infinity,
            color: const Color.fromRGBO(196, 196, 196, 0.7),
          ),
          SizedBox(
            height: 20,
          ),
          Expanded(
              child: Padding(
            padding: EdgeInsets.symmetric(horizontal: 20),
            child: histori == null
                ? Center(child: CircularProgressIndicator())
                : ListView.builder(
                    itemCount: histori!.length,
                    itemBuilder: (context, index) {
                      return Container(
                        decoration: BoxDecoration(
                          border: Border.all(color: Colors.black),
                          borderRadius: BorderRadius.circular(15),
                          color: Colors.white,
                          boxShadow: [
                            BoxShadow(
                              color: Colors.black.withAlpha(100),
                              blurRadius: 7,
                              offset: Offset(0, 6),
                            ),
                          ],
                        ),
                        margin: EdgeInsets.only(bottom: 10),
                        child: ListTile(
                          title: Text(
                            histori![index].result.data.title,
                            style: TextStyle(fontWeight: FontWeight.w600),
                          ),
                          trailing: Icon(Icons.arrow_forward_ios_outlined),
                          onTap: () {
                            showDialog(
                              context: context,
                              builder: (context) {
                                final item = histori![index];
                                riwayatController.durasiControllerHistori.text =
                                    item.durasi.toString();
                                riwayatController.levelControllerHistori.text =
                                    item.kesulitan;
                                riwayatController.repetisiControllerHistori
                                    .text = item.repetisi.toString();
                                riwayatController.catatanControllerHistori
                                    .text = item.catatan;
                                return SingleChildScrollView(
                                  child: AlertDialog(
                                    shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.circular(20),
                                    ),
                                    titlePadding: EdgeInsets.zero,
                                    title: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.stretch,
                                      children: [
                                        Padding(
                                          padding: const EdgeInsets.symmetric(
                                              horizontal: 16, vertical: 12),
                                          child: Row(
                                            children: [
                                              GestureDetector(
                                                onTap: () =>
                                                    Navigator.of(context).pop(),
                                                child: Icon(Icons.close,
                                                    color: Colors.black),
                                              ),
                                              Spacer(),
                                              Text(
                                                item.result.data.title,
                                                style: TextStyle(
                                                    fontWeight: FontWeight.bold,
                                                    fontSize: 15),
                                              ),
                                              Spacer(flex: 2),
                                            ],
                                          ),
                                        ),
                                        Divider(
                                            color: Colors.grey.shade400,
                                            thickness: 2),
                                      ],
                                    ),
                                    content: Column(
                                      mainAxisSize: MainAxisSize.min,
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Text(
                                          "Durasi Latihan",
                                          style: TextStyle(
                                              fontWeight: FontWeight.w600,
                                              fontSize: 15),
                                        ),
                                        SizedBox(
                                          height: 10,
                                        ),
                                        TextField(
                                          keyboardType: TextInputType.number,
                                          controller: riwayatController
                                              .durasiControllerHistori,
                                          decoration: InputDecoration(
                                            enabledBorder: OutlineInputBorder(
                                              borderSide: BorderSide(
                                                  color: Colors.grey.shade400,
                                                  width: 2),
                                              borderRadius:
                                                  BorderRadius.circular(15),
                                            ),
                                            focusedBorder: OutlineInputBorder(
                                              borderSide: BorderSide(
                                                  color: Colors.grey.shade400,
                                                  width: 2),
                                              borderRadius:
                                                  BorderRadius.circular(15),
                                            ),
                                            hintText: "Durasi Latihan (Menit)",
                                            contentPadding:
                                                const EdgeInsets.symmetric(
                                                    vertical: 7,
                                                    horizontal: 20),
                                          ),
                                        ),
                                        SizedBox(
                                          height: 10,
                                        ),
                                        Text(
                                          "Kesulitan",
                                          style: TextStyle(
                                              fontWeight: FontWeight.w600,
                                              fontSize: 15),
                                        ),
                                        SizedBox(
                                          height: 10,
                                        ),
                                        TextField(
                                          readOnly: true,
                                          controller: riwayatController
                                              .levelControllerHistori,
                                          decoration: InputDecoration(
                                            enabledBorder: OutlineInputBorder(
                                              borderSide: BorderSide(
                                                  color: Colors.grey.shade400,
                                                  width: 2),
                                              borderRadius:
                                                  BorderRadius.circular(15),
                                            ),
                                            focusedBorder: OutlineInputBorder(
                                              borderSide: BorderSide(
                                                  color: Colors.grey.shade400,
                                                  width: 2),
                                              borderRadius:
                                                  BorderRadius.circular(15),
                                            ),
                                            hintText: "Kesulitan",
                                            contentPadding:
                                                const EdgeInsets.symmetric(
                                                    vertical: 7,
                                                    horizontal: 20),
                                          ),
                                        ),
                                        SizedBox(
                                          height: 10,
                                        ),
                                        Text(
                                          "Repetisi",
                                          style: TextStyle(
                                              fontWeight: FontWeight.w600,
                                              fontSize: 15),
                                        ),
                                        SizedBox(
                                          height: 10,
                                        ),
                                        TextField(
                                          keyboardType: TextInputType.number,
                                          controller: riwayatController
                                              .repetisiControllerHistori,
                                          decoration: InputDecoration(
                                            enabledBorder: OutlineInputBorder(
                                              borderSide: BorderSide(
                                                  color: Colors.grey.shade400,
                                                  width: 2),
                                              borderRadius:
                                                  BorderRadius.circular(15),
                                            ),
                                            focusedBorder: OutlineInputBorder(
                                              borderSide: BorderSide(
                                                  color: Colors.grey.shade400,
                                                  width: 2),
                                              borderRadius:
                                                  BorderRadius.circular(15),
                                            ),
                                            hintText: "Kesulitan",
                                            contentPadding:
                                                const EdgeInsets.symmetric(
                                                    vertical: 7,
                                                    horizontal: 20),
                                          ),
                                        ),
                                        SizedBox(
                                          height: 10,
                                        ),
                                        Text(
                                          "Catatan",
                                          style: TextStyle(
                                              fontWeight: FontWeight.w600,
                                              fontSize: 15),
                                        ),
                                        SizedBox(
                                          height: 10,
                                        ),
                                        TextField(
                                          controller: riwayatController
                                              .catatanControllerHistori,
                                          decoration: InputDecoration(
                                            enabledBorder: OutlineInputBorder(
                                              borderSide: BorderSide(
                                                  color: Colors.grey.shade400,
                                                  width: 2),
                                              borderRadius:
                                                  BorderRadius.circular(15),
                                            ),
                                            focusedBorder: OutlineInputBorder(
                                              borderSide: BorderSide(
                                                  color: Colors.grey.shade400,
                                                  width: 2),
                                              borderRadius:
                                                  BorderRadius.circular(15),
                                            ),
                                            hintText: "Catatan",
                                            contentPadding:
                                                const EdgeInsets.symmetric(
                                                    vertical: 7,
                                                    horizontal: 20),
                                          ),
                                        ),
                                        SizedBox(
                                          height: 10,
                                        ),
                                        Center(
                                          child: ElevatedButton(
                                            onPressed: () {
                                              RiwayatController().riwayatUpdate(
                                                  item.id,
                                                  item.result.data.id,
                                                  riwayatController
                                                      .durasiControllerHistori
                                                      .text,
                                                  riwayatController
                                                      .repetisiControllerHistori
                                                      .text,
                                                  riwayatController
                                                      .levelControllerHistori
                                                      .text,
                                                  riwayatController
                                                      .catatanControllerHistori
                                                      .text);
                                            },
                                            style: ElevatedButton.styleFrom(
                                              backgroundColor:
                                                  Color.fromRGBO(159, 0, 0, 1),
                                              padding: EdgeInsets.symmetric(
                                                  horizontal: 40, vertical: 10),
                                              shape: RoundedRectangleBorder(
                                                borderRadius:
                                                    BorderRadius.circular(50),
                                              ),
                                              elevation: 5,
                                            ),
                                            child: Text(
                                              "SIMPAN",
                                              style: TextStyle(
                                                  fontSize: 15,
                                                  color: Colors.white),
                                            ),
                                          ),
                                        ),
                                      ],
                                    ),
                                  ),
                                );
                              },
                            );
                          },
                        ),
                      );
                    },
                  ),
          ))
        ],
      ),
    );
  }
}
