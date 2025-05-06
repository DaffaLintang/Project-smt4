import 'package:dropdown_button2/dropdown_button2.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:sign/controllers/workout_controller.dart';

class WorkoutRecomendation extends StatefulWidget {
  const WorkoutRecomendation({super.key});

  @override
  State<WorkoutRecomendation> createState() => _WorkoutRecomendationState();
}

class _WorkoutRecomendationState extends State<WorkoutRecomendation> {
  final RekomendasiController controller = Get.put(RekomendasiController());

  final List<String> bodyParts = [
    "Abdominals",
    "Abductors",
    "Adductors",
    "Biceps",
    "Calves",
    "Chest",
    "Forearms",
    "Glutes",
    "Hamstrings",
    "Lats",
    "Lower Back",
    "Middle Back",
    "Neck",
    "Quadriceps",
    "Shoulders",
    "Traps",
    "Triceps"
  ];

  final List<String> equipments = [
    "Bands",
    "Barbell",
    "Body Only",
    "Cable",
    "Dumbbell",
    "E-Z Curl Bar",
    "Exercise Ball",
    "Foam Roll",
    "Kettlebells",
    "Machine",
    "Medicine Ball",
    "Other",
    "Unknown"
  ];

  final List<String> types = [
    "Cardio",
    "Olympic Weightlifting",
    "Plyometrics",
    "Powerlifting",
    "Strength",
    "Stretching",
    "Strongman"
  ];

  final List<String> levels = ["Beginner", "Expert", "Intermediate"];

  int? bodyPart;
  int? type;
  int? level;
  int? equipment;

  String? bodyPartString;
  String? typeString;
  String? levelString;
  String? equipmentString;

  String? selectedValue;
  @override
  Widget build(BuildContext context) {
    return Obx(() => Scaffold(
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
                  "Rekomendasi Workout",
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
                        "Body Part",
                        style: TextStyle(
                            fontWeight: FontWeight.w800, fontSize: 15),
                      ),
                    ),
                    SizedBox(
                      height: 10,
                    ),
                    DropdownButtonFormField2<int>(
                      isExpanded: true,
                      decoration: InputDecoration(
                        enabledBorder: OutlineInputBorder(
                          borderSide: BorderSide(
                            color: Color.fromRGBO(137, 10, 10, 1),
                            width: 2,
                          ),
                          borderRadius: BorderRadius.circular(50),
                        ),
                        focusedBorder: OutlineInputBorder(
                          borderSide: BorderSide(
                            color: Color.fromRGBO(137, 10, 10, 1),
                            width: 2,
                          ),
                          borderRadius: BorderRadius.circular(50),
                        ),
                        contentPadding: const EdgeInsets.symmetric(vertical: 7),
                      ),
                      hint: const Text(
                        'Select Body Part',
                        style: TextStyle(fontSize: 14),
                      ),
                      items: List.generate(bodyParts.length, (index) {
                        return DropdownMenuItem<int>(
                          value: index,
                          child: Text(
                            bodyParts[index],
                            style: const TextStyle(fontSize: 14),
                          ),
                        );
                      }),
                      validator: (value) {
                        if (value == null) {
                          return 'Please select body part.';
                        }
                        return null;
                      },
                      onChanged: (value) {
                        setState(() {
                          bodyPart = value;
                          bodyPartString = bodyParts[value!];
                        });
                      },
                      onSaved: (value) {
                        selectedValue = value
                            .toString(); // atau simpan langsung sebagai int
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
                        "Equipment",
                        style: TextStyle(
                            fontWeight: FontWeight.w800, fontSize: 15),
                      ),
                    ),
                    SizedBox(
                      height: 10,
                    ),
                    DropdownButtonFormField2<int>(
                      isExpanded: true,
                      decoration: InputDecoration(
                        enabledBorder: OutlineInputBorder(
                          borderSide: BorderSide(
                            color: Color.fromRGBO(137, 10, 10, 1),
                            width: 2,
                          ),
                          borderRadius: BorderRadius.circular(50),
                        ),
                        focusedBorder: OutlineInputBorder(
                          borderSide: BorderSide(
                            color: Color.fromRGBO(137, 10, 10, 1),
                            width: 2,
                          ),
                          borderRadius: BorderRadius.circular(50),
                        ),
                        contentPadding: const EdgeInsets.symmetric(vertical: 7),
                      ),
                      hint: const Text(
                        'Select Equipment',
                        style: TextStyle(fontSize: 14),
                      ),
                      items: List.generate(equipments.length, (index) {
                        return DropdownMenuItem<int>(
                          value: index,
                          child: Text(
                            equipments[index],
                            style: const TextStyle(fontSize: 14),
                          ),
                        );
                      }),
                      validator: (value) {
                        if (value == null) {
                          return 'Please select equipment.';
                        }
                        return null;
                      },
                      onChanged: (value) {
                        setState(() {
                          equipment = value;
                          equipmentString = equipments[value!];
                        });
                      },
                      onSaved: (value) {
                        selectedValue = value
                            .toString(); // atau simpan langsung sebagai int
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
                        "Define Your Workout Objective",
                        style: TextStyle(
                            fontWeight: FontWeight.w800, fontSize: 15),
                      ),
                    ),
                    SizedBox(
                      height: 10,
                    ),
                    DropdownButtonFormField2<int>(
                      isExpanded: true,
                      decoration: InputDecoration(
                        enabledBorder: OutlineInputBorder(
                          borderSide: BorderSide(
                            color: Color.fromRGBO(137, 10, 10, 1),
                            width: 2,
                          ),
                          borderRadius: BorderRadius.circular(50),
                        ),
                        focusedBorder: OutlineInputBorder(
                          borderSide: BorderSide(
                            color: Color.fromRGBO(137, 10, 10, 1),
                            width: 2,
                          ),
                          borderRadius: BorderRadius.circular(50),
                        ),
                        contentPadding: const EdgeInsets.symmetric(vertical: 7),
                      ),
                      hint: const Text(
                        'Select Objective',
                        style: TextStyle(fontSize: 14),
                      ),
                      items: List.generate(types.length, (index) {
                        return DropdownMenuItem<int>(
                          value: index,
                          child: Text(
                            types[index],
                            style: const TextStyle(fontSize: 14),
                          ),
                        );
                      }),
                      validator: (value) {
                        if (value == null) {
                          return 'Please select objective.';
                        }
                        return null;
                      },
                      onChanged: (value) {
                        setState(() {
                          type = value;
                          typeString = types[value!];
                        });
                      },
                      onSaved: (value) {
                        selectedValue = value
                            .toString(); // atau simpan langsung sebagai int
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
                        "Pick Your Training Level",
                        style: TextStyle(
                            fontWeight: FontWeight.w800, fontSize: 15),
                      ),
                    ),
                    SizedBox(
                      height: 10,
                    ),
                    DropdownButtonFormField2<int>(
                      isExpanded: true,
                      decoration: InputDecoration(
                        enabledBorder: OutlineInputBorder(
                          borderSide: BorderSide(
                            color: Color.fromRGBO(137, 10, 10, 1),
                            width: 2,
                          ),
                          borderRadius: BorderRadius.circular(50),
                        ),
                        focusedBorder: OutlineInputBorder(
                          borderSide: BorderSide(
                            color: Color.fromRGBO(137, 10, 10, 1),
                            width: 2,
                          ),
                          borderRadius: BorderRadius.circular(50),
                        ),
                        contentPadding: const EdgeInsets.symmetric(vertical: 7),
                      ),
                      hint: const Text(
                        'Select Level',
                        style: TextStyle(fontSize: 14),
                      ),
                      items: List.generate(levels.length, (index) {
                        return DropdownMenuItem<int>(
                          value: index,
                          child: Text(
                            levels[index],
                            style: const TextStyle(fontSize: 14),
                          ),
                        );
                      }),
                      validator: (value) {
                        if (value == null) {
                          return 'Please select level.';
                        }
                        return null;
                      },
                      onChanged: (value) {
                        setState(() {
                          level = value;
                          levelString = levels[value!];
                        });
                      },
                      onSaved: (value) {
                        selectedValue = value
                            .toString(); // atau simpan langsung sebagai int
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
                    Center(
                      child: ElevatedButton(
                        onPressed: () {
                          controller.rekomendasi(
                              type, bodyPart, equipment, level);
                        },
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Color.fromRGBO(159, 0, 0, 1),
                          padding: EdgeInsets.symmetric(
                              horizontal: 40, vertical: 10),
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
                    Text(
                      controller.title.value.isEmpty
                          ? ""
                          : "HASIL: Jika anda ingin membentuk tubuh bagian ${bodyPartString} dengan peralatan ${equipmentString} dengan tujuan latihan anda ${typeString} dan tingkat latihan ${levelString} anda perlu mencoba latihan ${controller.title.value}",
                      style: TextStyle(
                          fontSize: 20,
                          fontWeight: FontWeight.w500,
                          color: Color.fromRGBO(227, 32, 32, 1)),
                    ),
                  ],
                ),
              )
            ],
          )),
        ));
  }
}
