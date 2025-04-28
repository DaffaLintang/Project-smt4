import 'package:dropdown_button2/dropdown_button2.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:sign/controllers/riwayat_controller.dart';
import 'package:sign/controllers/workout_controller.dart';
import 'package:sign/models/result_model.dart';

class RiwayatWorkout extends StatefulWidget {
  const RiwayatWorkout({super.key});

  @override
  State<RiwayatWorkout> createState() => _RiwayatWorkoutState();
}

class _RiwayatWorkoutState extends State<RiwayatWorkout> {
  final riwayatController = Get.put(RiwayatController());
  List<Result>? result;
  String? selectedResultId;

  void initState() {
    super.initState();
    fetchResult();
  }

  void fetchResult() async {
    result = await RekomendasiController().getResults();
    setState(() {});
  }

  String? selectedValue;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        actions: [
          Padding(
            padding: const EdgeInsets.only(right: 20),
            child: Container(
              height: 40,
              width: 40,
              decoration: BoxDecoration(
                  image: DecorationImage(
                      image: AssetImage('assets/image/profil.png'))),
            ),
          )
        ],
        iconTheme: IconThemeData(color: Colors.white),
        backgroundColor: Color.fromRGBO(159, 0, 0, 1),
      ),
      body: SingleChildScrollView(
          child: Column(
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
          Padding(
            padding: EdgeInsets.symmetric(horizontal: 30),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Padding(
                  padding: const EdgeInsets.only(left: 15.0),
                  child: Text(
                    "Workout yang dijalani",
                    style: TextStyle(fontWeight: FontWeight.w800, fontSize: 15),
                  ),
                ),
                SizedBox(
                  height: 10,
                ),
                DropdownButtonFormField2<String>(
                  isExpanded: true,
                  decoration: InputDecoration(
                    enabledBorder: OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color.fromRGBO(137, 10, 10, 1), width: 2),
                      borderRadius: BorderRadius.circular(50),
                    ),
                    focusedBorder: OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color.fromRGBO(137, 10, 10, 1), width: 2),
                      borderRadius: BorderRadius.circular(50),
                    ),
                    contentPadding: const EdgeInsets.symmetric(vertical: 7),
                  ),
                  hint: const Text(
                    'Select Workout',
                    style: TextStyle(fontSize: 14),
                  ),
                  value: selectedResultId,
                  items: result != null
                      ? result!
                          .map((item) => DropdownMenuItem<String>(
                                value: item.id
                                    .toString(), // simpan ID sebagai value
                                child: Text(
                                  item.title,
                                  style: const TextStyle(fontSize: 14),
                                ),
                              ))
                          .toList()
                      : [],
                  validator: (value) {
                    if (value == null) {
                      return 'Please select workout.';
                    }
                    return null;
                  },
                  onChanged: (value) {
                    setState(() {
                      selectedResultId = value;
                      final selected =
                          result!.firstWhere((r) => r.id.toString() == value);
                      riwayatController.levelController.text = selected.level;
                    });
                  },
                  onSaved: (value) {
                    selectedResultId = value;
                  },
                  buttonStyleData: const ButtonStyleData(
                    padding: EdgeInsets.only(right: 8),
                  ),
                  iconStyleData: const IconStyleData(
                    icon: Icon(
                      Icons.arrow_drop_down,
                      color: Color.fromRGBO(137, 10, 10, 1),
                    ),
                    iconSize: 24,
                  ),
                  dropdownStyleData: DropdownStyleData(
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(15),
                    ),
                  ),
                  menuItemStyleData: const MenuItemStyleData(
                    padding: EdgeInsets.symmetric(horizontal: 16),
                  ),
                ),
                SizedBox(
                  height: 20,
                ),
                Padding(
                  padding: const EdgeInsets.only(left: 15.0),
                  child: Text(
                    "Kesulitan",
                    style: TextStyle(fontWeight: FontWeight.w800, fontSize: 15),
                  ),
                ),
                SizedBox(
                  height: 10,
                ),
                TextField(
                  controller: riwayatController.levelController,
                  readOnly: true,
                  decoration: InputDecoration(
                    enabledBorder: OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color.fromRGBO(137, 10, 10, 1), width: 2),
                      borderRadius: BorderRadius.circular(50),
                    ),
                    focusedBorder: OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color.fromRGBO(137, 10, 10, 1), width: 2),
                      borderRadius: BorderRadius.circular(50),
                    ),
                    hintText: "Kesulitan",
                    contentPadding:
                        const EdgeInsets.symmetric(vertical: 7, horizontal: 20),
                  ),
                ),
                SizedBox(
                  height: 20,
                ),
                Padding(
                  padding: const EdgeInsets.only(left: 15.0),
                  child: Text(
                    "Repetisi (Reps)",
                    style: TextStyle(fontWeight: FontWeight.w800, fontSize: 15),
                  ),
                ),
                SizedBox(
                  height: 10,
                ),
                TextField(
                  controller: riwayatController.repetisiController,
                  keyboardType: TextInputType.number,
                  decoration: InputDecoration(
                    enabledBorder: OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color.fromRGBO(137, 10, 10, 1), width: 2),
                      borderRadius: BorderRadius.circular(50),
                    ),
                    focusedBorder: OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color.fromRGBO(137, 10, 10, 1), width: 2),
                      borderRadius: BorderRadius.circular(50),
                    ),
                    hintText: "Masukkan repetisi",
                    contentPadding:
                        const EdgeInsets.symmetric(vertical: 7, horizontal: 20),
                  ),
                ),
                SizedBox(
                  height: 20,
                ),
                Padding(
                  padding: const EdgeInsets.only(left: 15.0),
                  child: Text(
                    "Durasi",
                    style: TextStyle(fontWeight: FontWeight.w800, fontSize: 15),
                  ),
                ),
                SizedBox(
                  height: 10,
                ),
                TextField(
                  controller: riwayatController.durasiController,
                  keyboardType: TextInputType.number,
                  decoration: InputDecoration(
                    enabledBorder: OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color.fromRGBO(137, 10, 10, 1), width: 2),
                      borderRadius: BorderRadius.circular(50),
                    ),
                    focusedBorder: OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color.fromRGBO(137, 10, 10, 1), width: 2),
                      borderRadius: BorderRadius.circular(50),
                    ),
                    hintText: "Masukkan Durasi",
                    contentPadding:
                        const EdgeInsets.symmetric(vertical: 7, horizontal: 20),
                  ),
                ),
                SizedBox(
                  height: 20,
                ),
                Padding(
                  padding: const EdgeInsets.only(left: 15.0),
                  child: Text(
                    "Catatan (Opsional)",
                    style: TextStyle(fontWeight: FontWeight.w800, fontSize: 15),
                  ),
                ),
                SizedBox(
                  height: 10,
                ),
                TextField(
                  controller: riwayatController.catatanController,
                  decoration: InputDecoration(
                    enabledBorder: OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color.fromRGBO(137, 10, 10, 1), width: 2),
                      borderRadius: BorderRadius.circular(50),
                    ),
                    focusedBorder: OutlineInputBorder(
                      borderSide: BorderSide(
                          color: Color.fromRGBO(137, 10, 10, 1), width: 2),
                      borderRadius: BorderRadius.circular(50),
                    ),
                    hintText: "Tulis Catatan (Opsional)",
                    contentPadding:
                        const EdgeInsets.symmetric(vertical: 7, horizontal: 20),
                  ),
                ),
                SizedBox(
                  height: 20,
                ),
                Center(
                  child: ElevatedButton(
                    onPressed: () {
                      RiwayatController().historiPost(
                          selectedResultId,
                          riwayatController.durasiController.text,
                          riwayatController.repetisiController.text,
                          riwayatController.levelController.text,
                          riwayatController.catatanController.text);
                    },
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Color.fromRGBO(159, 0, 0, 1),
                      padding:
                          EdgeInsets.symmetric(horizontal: 40, vertical: 10),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(50),
                      ),
                      elevation: 5,
                    ),
                    child: Text(
                      "SUBMIT",
                      style: TextStyle(fontSize: 15, color: Colors.white),
                    ),
                  ),
                ),
              ],
            ),
          )
        ],
      )),
    );
  }
}
