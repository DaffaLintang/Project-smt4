class User {
  final String id;
  // final String name;
  final String email;
  final String role;
  final String? emailVerifiedAt;
  final String? image;
  final String? fullName;
  final String? phone;
  final String? birth;
  final String? weight;
  final String? height;
  final DateTime createdAt;
  final DateTime updatedAt;

  User({
    required this.id,
    // required this.name,
    required this.email,
    required this.role,
    this.emailVerifiedAt,
    this.image,
    this.fullName,
    this.phone,
    this.birth,
    this.weight,
    this.height,
    required this.createdAt,
    required this.updatedAt,
  });

  factory User.fromJson(Map<String, dynamic> json) {
    return User(
      id: json['id'],
      // name: json['name'],
      email: json['email'],
      role: json['role'],
      emailVerifiedAt: json['email_verified_at'],
      image: json['image'],
      fullName: json['full_name'],
      phone: json['phone'],
      birth: json['birth'],
      weight: json['weight'],
      height: json['height'],
      createdAt: DateTime.parse(json['created_at']),
      updatedAt: DateTime.parse(json['updated_at']),
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      // 'name': name,
      'email': email,
      'role': role,
      'email_verified_at': emailVerifiedAt,
      'image': image,
      'full_name': fullName,
      'phone': phone,
      'birth': birth,
      'weight': weight,
      'height': height,
      'created_at': createdAt.toIso8601String(),
      'updated_at': updatedAt.toIso8601String(),
    };
  }
}
