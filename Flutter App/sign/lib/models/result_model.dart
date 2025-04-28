class Result {
  final String id;
  final String title;
  final String desc;
  final String type;
  final String bodyPart;
  final String equipment;
  final String level;
  final String userId;

  Result({
    required this.id,
    required this.title,
    required this.desc,
    required this.type,
    required this.bodyPart,
    required this.equipment,
    required this.level,
    required this.userId,
  });

  factory Result.fromJson(Map<String, dynamic> json) {
    return Result(
      id: json['id'],
      title: json['title'],
      desc: json['desc'],
      type: json['type'],
      bodyPart: json['bodyPart'],
      equipment: json['equipment'],
      level: json['level'],
      userId: json['user_id']['\$oid'], // ambil $oid dari user_id
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'title': title,
      'desc': desc,
      'type': type,
      'bodyPart': bodyPart,
      'equipment': equipment,
      'level': level,
      'user_id': {
        '\$oid': userId,
      },
    };
  }
}
