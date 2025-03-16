import 'package:flutter/material.dart';

class ProfilePage extends StatefulWidget {
  const ProfilePage({super.key});

  @override
  State<ProfilePage> createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
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
      body: SingleChildScrollView(
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
                decoration:
                    BoxDecoration(shape: BoxShape.circle, color: Colors.white),
              ),
            ),
            Padding(
              padding: const EdgeInsets.only(top: 100.0),
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
                        "Name",
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
                        "asd@gmail.com",
                        style: TextStyle(
                            color: Color.fromRGBO(159, 0, 0, 1), fontSize: 15),
                      ),
                    ),
                    SizedBox(
                      height: 20,
                    ),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        Column(
                          children: [Text("45Kg"), Text("WEIGHT")],
                        ),
                        Container(
                          height: 50,
                          width: 1,
                          color: Colors.black,
                        ),
                        Column(
                          children: [Text("45"), Text("YEARS OLD")],
                        ),
                        Container(
                          height: 50,
                          width: 1,
                          color: Colors.black,
                        ),
                        Column(
                          children: [Text("158Cm"), Text("HEIGHT")],
                        ),
                      ],
                    ),
                    SizedBox(
                      height: 20,
                    ),
                    Text("Full Name",
                        style: TextStyle(
                            color: Color.fromRGBO(159, 0, 0, 1), fontSize: 15)),
                    TextField(
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
                            color: Color.fromRGBO(159, 0, 0, 1), fontSize: 15)),
                    TextField(
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
                            color: Color.fromRGBO(159, 0, 0, 1), fontSize: 15)),
                    TextField(
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
                            color: Color.fromRGBO(159, 0, 0, 1), fontSize: 15)),
                    TextField(
                      decoration: InputDecoration(
                        labelText: 'Date of Birth',
                        border: UnderlineInputBorder(),
                      ),
                    ),
                    SizedBox(
                      height: 25,
                    ),
                    Text("Weight",
                        style: TextStyle(
                            color: Color.fromRGBO(159, 0, 0, 1), fontSize: 15)),
                    TextField(
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
                            color: Color.fromRGBO(159, 0, 0, 1), fontSize: 15)),
                    TextField(
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
                        onPressed: () {},
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
                          style: TextStyle(fontSize: 15, color: Colors.white),
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
              child: Container(
                height: 100,
                width: 100,
                decoration: BoxDecoration(
                    image: DecorationImage(
                        image: AssetImage('assets/image/profil.png'),
                        fit: BoxFit.cover)),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
