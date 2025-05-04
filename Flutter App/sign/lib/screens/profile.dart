import 'dart:io' as io;

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:image_picker/image_picker.dart';
import 'package:sign/apiVar.dart';
import 'package:sign/controllers/profile_controller.dart';
import 'package:sign/models/profile_model.dart';
import 'package:intl/intl.dart';

class ProfilePage extends StatefulWidget {
  const ProfilePage({super.key});

  @override
  State<ProfilePage> createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
  final ProfileController profileController = Get.put(ProfileController());
  User? user;
  io.File? _image1;
  int? age;

  @override
  void initState() {
    super.initState();
    fetchProfile();
  }

  void fetchProfile() async {
    user = await profileController.getProfile();
    age = calculateAge(user?.birth.toString() ?? DateTime.now().toString());
    if (user?.fullName != null && user!.fullName!.isNotEmpty) {
      ProfileController.fullNameController.text = user!.fullName!;
    }
    if (user?.email != null && user!.email.isNotEmpty) {
      ProfileController.emailController.text = user!.email;
    }
    if (user?.phone != null) {
      ProfileController.mobilePhoneController.text = user!.phone.toString();
    }
    if (user?.birth != null) {
      ProfileController.dateController.text = user!.birth.toString();
    }
    if (user?.weight != null) {
      ProfileController.weightController.text = user!.weight.toString();
    }
    if (user?.weight != null) {
      ProfileController.heightController.text = user!.height.toString();
    }
    setState(() {});
  }

  Future<void> _pickImage1(ImageSource source) async {
    try {
      final ImagePicker picker = ImagePicker();
      final XFile? pickedFile = await picker.pickImage(source: source);

      if (pickedFile != null) {
        setState(() {
          _image1 = io.File(pickedFile.path);
        });
      }
    } catch (e) {
      print("Error picking image: $e");
    }
  }

  int calculateAge(String? birthDateString) {
    // Mengubah tanggal lahir dari String ke DateTime
    DateTime birthDate = (birthDateString != null)
        ? DateTime.tryParse(birthDateString) ?? DateTime.now()
        : DateTime.now();

    // Mengambil tanggal saat ini
    DateTime currentDate = DateTime.now();

    // Menghitung selisih tahun
    int age = currentDate.year - birthDate.year;

    // Jika tanggal lahir belum lewat tahun ini, kurangi umur 1 tahun
    if (currentDate.month < birthDate.month ||
        (currentDate.month == birthDate.month &&
            currentDate.day < birthDate.day)) {
      age--;
    }

    return age;
  }

  Future<void> _selectDate(BuildContext context) async {
    DateTime? pickedDate = await showDatePicker(
      context: context,
      initialDate: DateTime.now(), // Tanggal awal (sekarang)
      firstDate: DateTime(1900), // Tanggal pertama yang bisa dipilih
      lastDate: DateTime(2101), // Tanggal terakhir yang bisa dipilih
    );

    if (pickedDate != null) {
      // Format tanggal menjadi yyyy-MM-dd
      String formattedDate = DateFormat('yyyy-MM-dd').format(pickedDate);
      setState(() {
        ProfileController.dateController.text =
            formattedDate; // Set tanggal yang dipilih ke TextField
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    double getCircleDiameter(BuildContext context) =>
        MediaQuery.of(context).size.width * 4;
    return Scaffold(
      appBar: AppBar(
        title: Text(
          "Profile",
          style: TextStyle(color: Colors.white, fontSize: 25),
        ),
        centerTitle: true,
        iconTheme: IconThemeData(color: Colors.white),
        backgroundColor: Color.fromRGBO(159, 0, 0, 1),
      ),
      body: user == null
          ? Center(child: CircularProgressIndicator())
          : SingleChildScrollView(
              child: Stack(
                children: [
                  Container(
                    width: double.infinity,
                    height: 150,
                    color: Color.fromRGBO(159, 0, 0, 1),
                  ),
                  Positioned(
                    top: 50,
                    left: -605,
                    child: Container(
                      width: getCircleDiameter(context),
                      height: getCircleDiameter(context),
                      decoration: BoxDecoration(
                          shape: BoxShape.circle, color: Colors.white),
                    ),
                  ),
                  Padding(
                    padding: const EdgeInsets.only(top: 130.0),
                    child: Container(
                      padding: EdgeInsets.symmetric(horizontal: 40),
                      decoration: BoxDecoration(
                        color: Colors.white,
                      ),
                      width: double.infinity,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Center(
                            child: Text(
                              "${user!.fullName}",
                              style: TextStyle(
                                color: Color.fromRGBO(159, 0, 0, 1),
                                fontSize: 25,
                              ),
                            ),
                          ),
                          SizedBox(
                            height: 10,
                          ),
                          Center(
                            child: Text(
                              "${user!.email}",
                              style: TextStyle(
                                  color: Color.fromRGBO(159, 0, 0, 1),
                                  fontSize: 15),
                            ),
                          ),
                          SizedBox(
                            height: 20,
                          ),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            children: [
                              Column(
                                children: [
                                  Text("${user!.weight} Kg"),
                                  Text("WEIGHT")
                                ],
                              ),
                              Container(
                                height: 50,
                                width: 1,
                                color: Colors.black,
                              ),
                              Column(
                                children: [Text("${age}"), Text("YEARS OLD")],
                              ),
                              Container(
                                height: 50,
                                width: 1,
                                color: Colors.black,
                              ),
                              Column(
                                children: [
                                  Text("${user!.height} Cm"),
                                  Text("HEIGHT")
                                ],
                              ),
                            ],
                          ),
                          SizedBox(
                            height: 20,
                          ),
                          Text("Full Name",
                              style: TextStyle(
                                  color: Color.fromRGBO(159, 0, 0, 1),
                                  fontSize: 15)),
                          TextField(
                            controller: ProfileController.fullNameController,
                            decoration: InputDecoration(
                              labelText: 'Full Name',
                              border: UnderlineInputBorder(),
                            ),
                          ),
                          SizedBox(
                            height: 25,
                          ),
                          Text("Email",
                              style: TextStyle(
                                  color: Color.fromRGBO(159, 0, 0, 1),
                                  fontSize: 15)),
                          TextField(
                            controller: ProfileController.emailController,
                            decoration: InputDecoration(
                              labelText: 'Email',
                              border: UnderlineInputBorder(),
                            ),
                          ),
                          SizedBox(
                            height: 25,
                          ),
                          Text("Mobile Phone",
                              style: TextStyle(
                                  color: Color.fromRGBO(159, 0, 0, 1),
                                  fontSize: 15)),
                          TextField(
                            controller: ProfileController.mobilePhoneController,
                            decoration: InputDecoration(
                              labelText: 'Mobile Phone',
                              border: UnderlineInputBorder(),
                            ),
                          ),
                          SizedBox(
                            height: 25,
                          ),
                          Text("Date of Birth",
                              style: TextStyle(
                                  color: Color.fromRGBO(159, 0, 0, 1),
                                  fontSize: 15)),
                          TextField(
                            controller: ProfileController.dateController,
                            decoration: InputDecoration(
                              labelText: 'Date of Birth',
                              border: UnderlineInputBorder(),
                            ),
                            readOnly: true,
                            onTap: () {
                              _selectDate(context);
                            },
                          ),
                          SizedBox(
                            height: 25,
                          ),
                          Text("Weight",
                              style: TextStyle(
                                  color: Color.fromRGBO(159, 0, 0, 1),
                                  fontSize: 15)),
                          TextField(
                            controller: ProfileController.weightController,
                            decoration: InputDecoration(
                              suffixIcon: Text("Kg"),
                              labelText: 'Weight',
                              border: UnderlineInputBorder(),
                            ),
                          ),
                          SizedBox(
                            height: 25,
                          ),
                          Text("Height",
                              style: TextStyle(
                                  color: Color.fromRGBO(159, 0, 0, 1),
                                  fontSize: 15)),
                          TextField(
                            controller: ProfileController.heightController,
                            decoration: InputDecoration(
                              suffixIcon: Text("Cm"),
                              labelText: 'Height',
                              border: UnderlineInputBorder(),
                            ),
                          ),
                          SizedBox(
                            height: 30,
                          ),
                          Center(
                            child: ElevatedButton(
                              onPressed: () {
                                profileController.profileStore(
                                    ProfileController.fullNameController.text,
                                    ProfileController.emailController.text,
                                    ProfileController
                                        .mobilePhoneController.text,
                                    ProfileController.dateController.text,
                                    ProfileController.weightController.text,
                                    ProfileController.heightController.text,
                                    _image1);
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
                                "UPDATE PROFILE",
                                style: TextStyle(
                                    fontSize: 15, color: Colors.white),
                              ),
                            ),
                          ),
                          SizedBox(
                            height: 30,
                          ),
                        ],
                      ),
                    ),
                  ),
                  Center(
                    child: user!.image == null
                        ? GestureDetector(
                            onTap: () {
                              _pickImage1(ImageSource.gallery);
                            },
                            child: Container(
                              decoration: BoxDecoration(
                                  borderRadius: BorderRadius.circular(100),
                                  border: Border.all(color: Color(0xff9E0507)),
                                  color: Colors.white),
                              height: 100,
                              width: 100,
                              child: Center(
                                  child: Text(
                                "No Image",
                                textAlign: TextAlign.center,
                              )),
                            ),
                          )
                        : GestureDetector(
                            onTap: () {
                              _pickImage1(ImageSource.gallery);
                            },
                            child: Container(
                              height: 100,
                              width: 100,
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(100),
                                border: Border.all(color: Color(0xff9E0507)),
                              ),
                              child: ClipRRect(
                                  borderRadius: BorderRadius.circular(100),
                                  child: _image1 != null
                                      ? Center(
                                          child: Icon(Icons.person, size: 50),
                                        )
                                      : Image.network(
                                          '${MainUrl}/${user!.image}',
                                          fit: BoxFit.cover,
                                          width: 100,
                                          height: 100,
                                        )),
                            ),
                          ),
                  ),
                ],
              ),
            ),
    );
  }
}
