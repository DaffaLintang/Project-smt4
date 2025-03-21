import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:sign/screens/bmi.dart';
import 'package:sign/screens/profile.dart';
import 'package:sign/screens/riwayat.dart';
import 'package:sign/screens/workout.dart';

class Menu extends StatefulWidget {
  const Menu({super.key});

  @override
  State<Menu> createState() => _MenuState();
}

class _MenuState extends State<Menu> {
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
            child: Container(
              height: 40,
              width: 40,
              decoration: BoxDecoration(
                  image: DecorationImage(
                      image: AssetImage('assets/image/profil.png'))),
            ),
          ),
        )
      ], automaticallyImplyLeading: false),
      body: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            padding: EdgeInsets.symmetric(horizontal: 30),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  "Hello, Nissa!",
                  style: TextStyle(fontWeight: FontWeight.w700, fontSize: 25),
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
                              color: Color.fromRGBO(137, 0, 0, 100), width: 1)),
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
                                      image:
                                          AssetImage('assets/image/bmi.png'))),
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
                                      image:
                                          AssetImage('assets/image/jam.png'))),
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
                  style: TextStyle(fontWeight: FontWeight.w700, fontSize: 18),
                )
              ],
            ),
          )
        ],
      ),
    );
  }
}
