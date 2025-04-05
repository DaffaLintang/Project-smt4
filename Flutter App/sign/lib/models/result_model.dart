class User {
  final int id;
  final String name;
  final String email;
  final String role;
  final String? emailVerifiedAt;
  final String image;
  final String fullName;
  final String phone;
  final String birth;
  final int weight;
  final int height;
  final String createdAt;
  final String updatedAt;

  User({
    required this.id,
    required this.name,
    required this.email,
    required this.role,
    this.emailVerifiedAt,
    required this.image,
    required this.fullName,
    required this.phone,
    required this.birth,
    required this.weight,
    required this.height,
    required this.createdAt,
    required this.updatedAt,
  });

  factory User.fromJson(Map<String, dynamic> json) => User(
        id: json['id'],
        name: json['name'],
        email: json['email'],
        role: json['role'],
        emailVerifiedAt: json['email_verified_at'],
        image: json['image'],
        fullName: json['full_name'],
        phone: json['phone'],
        birth: json['birth'],
        weight: json['weight'],
        height: json['height'],
        createdAt: json['created_at'],
        updatedAt: json['updated_at'],
      );

  Map<String, dynamic> toJson() => {
        'id': id,
        'name': name,
        'email': email,
        'role': role,
        'email_verified_at': emailVerifiedAt,
        'image': image,
        'full_name': fullName,
        'phone': phone,
        'birth': birth,
        'weight': weight,
        'height': height,
        'created_at': createdAt,
        'updated_at': updatedAt,
      };
}

class Result {
  final int id;
  final String title;
  final String desc;
  final String type;
  final String bodyPart;
  final String equipment;
  final String level;
  final int idUser;
  final String createdAt;
  final String updatedAt;
  final User user;

  Result({
    required this.id,
    required this.title,
    required this.desc,
    required this.type,
    required this.bodyPart,
    required this.equipment,
    required this.level,
    required this.idUser,
    required this.createdAt,
    required this.updatedAt,
    required this.user,
  });

  factory Result.fromJson(Map<String, dynamic> json) => Result(
        id: json['id'],
        title: json['title'],
        desc: json['desc'],
        type: json['type'],
        bodyPart: json['bodyPart'],
        equipment: json['equipment'],
        level: json['level'],
        idUser: json['id_user'],
        createdAt: json['created_at'],
        updatedAt: json['updated_at'],
        user: User.fromJson(json['user']),
      );

  Map<String, dynamic> toJson() => {
        'id': id,
        'title': title,
        'desc': desc,
        'type': type,
        'bodyPart': bodyPart,
        'equipment': equipment,
        'level': level,
        'id_user': idUser,
        'created_at': createdAt,
        'updated_at': updatedAt,
        'user': user.toJson(),
      };
}
