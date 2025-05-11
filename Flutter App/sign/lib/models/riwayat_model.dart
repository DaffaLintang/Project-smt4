class Histori {
  final String id;
  final int durasi;
  final int repetisi;
  final String kesulitan;
  final String catatan;
  final ResultWrapper result;

  Histori({
    required this.id,
    required this.durasi,
    required this.repetisi,
    required this.kesulitan,
    required this.catatan,
    required this.result,
  });

  factory Histori.fromJson(Map<String, dynamic> json) {
    return Histori(
      id: json['id'],
      durasi: json['durasi'],
      repetisi: json['repetisi'],
      kesulitan: json['kesulitan'],
      catatan: json['catatan'],
      result: ResultWrapper.fromJson(json['result']),
    );
  }
}

class ResultWrapper {
  final String? success;
  final String? message;
  final ResultData data;

  ResultWrapper({
    this.success,
    this.message,
    required this.data,
  });

  factory ResultWrapper.fromJson(Map<String, dynamic> json) {
    return ResultWrapper(
      success: json['success'],
      message: json['message'],
      data: ResultData.fromJson(json['data']),
    );
  }
}

class ResultData {
  final String id;
  final String title;
  final String desc;
  final String type;
  final String bodyPart;
  final String equipment;
  final String level;
  final String userId;
  final DateTime createdAt;
  final DateTime updatedAt;

  ResultData({
    required this.id,
    required this.title,
    required this.desc,
    required this.type,
    required this.bodyPart,
    required this.equipment,
    required this.level,
    required this.userId,
    required this.createdAt,
    required this.updatedAt,
  });

  factory ResultData.fromJson(Map<String, dynamic> json) {
    return ResultData(
      id: json['id'],
      title: json['title'],
      desc: json['desc'],
      type: json['type'],
      bodyPart: json['bodyPart'],
      equipment: json['equipment'],
      level: json['level'],
      userId: json['user_id']['\$oid'],
      createdAt: DateTime.parse(json['created_at']),
      updatedAt: DateTime.parse(json['updated_at']),
    );
  }
}
