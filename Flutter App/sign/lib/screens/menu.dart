import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:sign/apiVar.dart';
import 'package:sign/controllers/riwayat_controller.dart';
import 'package:sign/models/riwayat_model.dart';
import 'package:sign/screens/bmi.dart';
import 'package:sign/screens/latihan_page.dart';
import 'package:sign/screens/profile.dart';
import 'package:sign/screens/riwayat.dart';
import 'package:sign/screens/workout.dart';
import 'package:sign/widget/chart.dart';
import 'package:sp_util/sp_util.dart';

class Menu extends StatefulWidget {
  const Menu({super.key});

  @override
  State<Menu> createState() => _MenuState();
}

class _MenuState extends State<Menu> {
  String? profileImage = SpUtil.getString('profileImage');
  String? fullName = SpUtil.getString('fullName');
  late List<DateTime> weekDates;

  final riwayatController = Get.put(RiwayatController());
  List<Histori>? histori;

  @override
  void initState() {
    super.initState();
    final now = DateTime.now();
    final monday = now.subtract(Duration(days: now.weekday - 1)); // Senin
    weekDates = List.generate(7, (index) => monday.add(Duration(days: index)));
    fetchResult();
  }

  Future<void> fetchResult() async {
    histori = await riwayatController.getDetailRiwayat();
    print('Histori fetched: ${histori!.length}');
    setState(() {});
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(actions: [
        Padding(
          padding: const EdgeInsets.only(right: 20),
          child: GestureDetector(
              onTap: () {
                Get.to(ProfilePage());
              },
              child: profileImage!.isEmpty
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
                    )),
        )
      ], automaticallyImplyLeading: false),
      body: RefreshIndicator(
        onRefresh: () {
          return fetchResult();
        },
        child: SingleChildScrollView(
          physics: const AlwaysScrollableScrollPhysics(),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Container(
                padding: EdgeInsets.symmetric(horizontal: 30),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      "Hello, ${fullName}",
                      style:
                          TextStyle(fontWeight: FontWeight.w700, fontSize: 25),
                    ),
                    SizedBox(
                      height: 10,
                    ),
                    Text("Mulai sekarang dan raih kebugaran optimal!"),
                    SizedBox(
                      height: 50,
                    ),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceAround,
                      children: [
                        Container(
                          width: 75,
                          height: 75,
                          decoration: BoxDecoration(
                              borderRadius: BorderRadius.circular(20),
                              border: Border.all(
                                  color: Color.fromRGBO(137, 0, 0, 100),
                                  width: 1)),
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              GestureDetector(
                                onTap: () {
                                  Get.to(BMICalculatorApp());
                                },
                                child: Container(
                                  height: 50,
                                  width: 50,
                                  decoration: BoxDecoration(
                                      image: DecorationImage(
                                          image: AssetImage(
                                              'assets/image/bmi.png'))),
                                ),
                              ),
                              Text(
                                "BMI",
                                style: TextStyle(
                                    fontSize: 13,
                                    color: Color.fromRGBO(137, 0, 0, 100)),
                              )
                            ],
                          ),
                        ),
                        GestureDetector(
                          onTap: () {
                            Get.to(WorkoutRecomendation());
                          },
                          child: Container(
                            width: 75,
                            height: 75,
                            decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(20),
                                border: Border.all(
                                    color: Color.fromRGBO(137, 0, 0, 100),
                                    width: 1)),
                            child: Column(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: [
                                Container(
                                  height: 50,
                                  width: 50,
                                  decoration: BoxDecoration(
                                      image: DecorationImage(
                                          image: AssetImage(
                                              'assets/image/barbel.png'))),
                                ),
                                Text(
                                  "Workout",
                                  style: TextStyle(
                                      fontSize: 13,
                                      color: Color.fromRGBO(137, 0, 0, 100)),
                                )
                              ],
                            ),
                          ),
                        ),
                        GestureDetector(
                          onTap: () {
                            Get.to(RiwayatWorkout());
                          },
                          child: Container(
                            width: 75,
                            height: 75,
                            decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(20),
                                border: Border.all(
                                    color: Color.fromRGBO(137, 0, 0, 100),
                                    width: 1)),
                            child: Column(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: [
                                Container(
                                  height: 50,
                                  width: 50,
                                  decoration: BoxDecoration(
                                      image: DecorationImage(
                                          image: AssetImage(
                                              'assets/image/jam.png'))),
                                ),
                                Text(
                                  "Latihan",
                                  style: TextStyle(
                                      fontSize: 13,
                                      color: Color.fromRGBO(137, 0, 0, 100)),
                                )
                              ],
                            ),
                          ),
                        ),
                        GestureDetector(
                          onTap: () {
                            Get.to(RiwayatLatihan());
                          },
                          child: Container(
                            width: 75,
                            height: 75,
                            decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(20),
                                border: Border.all(
                                    color: Color.fromRGBO(137, 0, 0, 100),
                                    width: 1)),
                            child: Column(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: [
                                Container(
                                  height: 50,
                                  width: 50,
                                  decoration: BoxDecoration(
                                      image: DecorationImage(
                                          image: AssetImage(
                                              'assets/image/Desk_alt_light.png'))),
                                ),
                                Text(
                                  "Riwayat",
                                  style: TextStyle(
                                      fontSize: 13,
                                      color: Color.fromRGBO(137, 0, 0, 100)),
                                )
                              ],
                            ),
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
              ),
              SizedBox(
                height: 50,
              ),
              Container(
                height: 1,
                width: double.infinity,
                color: Colors.black,
              ),
              SizedBox(
                height: 30,
              ),
              Container(
                padding: EdgeInsets.symmetric(horizontal: 30),
                child: Column(
                  children: [
                    Text(
                      "Workout Progress",
                      style:
                          TextStyle(fontWeight: FontWeight.w700, fontSize: 18),
                    ),
                    AspectRatio(
                      aspectRatio: 1.6,
                      child: ChartWorkout(
                          histori: histori?.cast<Histori?>() ?? []),
                    )
                  ],
                ),
              )
            ],
          ),
        ),
      ),
    );
  }
}
