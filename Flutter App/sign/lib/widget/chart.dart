import 'package:fl_chart/fl_chart.dart';
import 'package:flutter/material.dart';
import 'package:sign/models/riwayat_model.dart';

class ChartWorkout extends StatefulWidget {
  final List<Histori?> histori;

  const ChartWorkout({super.key, required this.histori});

  @override
  State<ChartWorkout> createState() => _ChartWorkoutState();
}

class _ChartWorkoutState extends State<ChartWorkout> {
  late List<DateTime> weekDates;

  @override
  void initState() {
    super.initState();
    // Inisialisasi minggu ini
    final now = DateTime.now();
    final monday = now.subtract(Duration(days: now.weekday - 1));
    weekDates = List.generate(7, (index) => monday.add(Duration(days: index)));

    // Jika minggu sudah diinisialisasi, panggil setState
    setState(() {});
  }

  Map<int, int> getWeeklyRepetitions(List<Histori?> historiList) {
    Map<int, int> result = {for (var i = 0; i < 7; i++) i: 0};

    for (var item in historiList) {
      if (item == null) continue;
      final date = item.result.data.createdAt;
      print(date);
      for (int i = 0; i < weekDates.length; i++) {
        if (date.year == weekDates[i].year &&
            date.month == weekDates[i].month &&
            date.day == weekDates[i].day) {
          result[i] = result[i]! + 1;
          break;
        }
      }
    }
    return result;
  }

  BarTouchData get barTouchData => BarTouchData(
        enabled: false,
        touchTooltipData: BarTouchTooltipData(
          getTooltipColor: (group) => Colors.transparent,
          tooltipPadding: EdgeInsets.zero,
          tooltipMargin: 8,
          getTooltipItem: (group, groupIndex, rod, rodIndex) {
            return BarTooltipItem(
              rod.toY.round().toString(),
              const TextStyle(
                color: Color.fromRGBO(137, 0, 0, 1),
                fontWeight: FontWeight.bold,
              ),
            );
          },
        ),
      );

  Widget getTitles(double value, TitleMeta meta) {
    final style = const TextStyle(
      fontWeight: FontWeight.bold,
      fontSize: 12,
    );
    String text = '';
    if (value.toInt() >= 0 && value.toInt() < weekDates.length) {
      final date = weekDates[value.toInt()];
      text = '${date.day}/${date.month}';
    }
    return SideTitleWidget(
      meta: meta,
      space: 4,
      child: Text(text, style: style),
    );
  }

  FlTitlesData get titlesData => FlTitlesData(
        show: true,
        bottomTitles: AxisTitles(
          sideTitles: SideTitles(
            showTitles: true,
            reservedSize: 30,
            getTitlesWidget: getTitles,
          ),
        ),
        leftTitles: const AxisTitles(
          sideTitles: SideTitles(showTitles: false),
        ),
        topTitles: const AxisTitles(
          sideTitles: SideTitles(showTitles: false),
        ),
        rightTitles: const AxisTitles(
          sideTitles: SideTitles(showTitles: false),
        ),
      );

  FlBorderData get borderData => FlBorderData(show: false);

  LinearGradient get _barsGradient => const LinearGradient(
        colors: [
          Color.fromRGBO(130, 0, 0, 1),
          Color.fromRGBO(255, 0, 0, 0.69),
        ],
        begin: Alignment.bottomCenter,
        end: Alignment.topCenter,
      );

  List<BarChartGroupData> get barGroups {
    final dataMap = getWeeklyRepetitions(widget.histori);
    return List.generate(7, (index) {
      final value = (dataMap[index] ?? 0).toDouble();
      return BarChartGroupData(
        x: index,
        barRods: [
          BarChartRodData(
            toY: value,
            gradient: _barsGradient,
          ),
        ],
        showingTooltipIndicators: [0],
      );
    });
  }

  @override
  Widget build(BuildContext context) {
    if (weekDates.isEmpty) {
      return const CircularProgressIndicator();
    }

    return BarChart(
      BarChartData(
        barTouchData: barTouchData,
        titlesData: titlesData,
        borderData: borderData,
        barGroups: barGroups,
        gridData: const FlGridData(show: false),
        alignment: BarChartAlignment.spaceAround,
        maxY: getMaxY(widget.histori),
      ),
    );
  }

  double getMaxY(List<Histori?> historiList) {
    final dataMap = getWeeklyRepetitions(historiList);
    final max =
        dataMap.values.fold<int>(0, (prev, curr) => curr > prev ? curr : prev);
    return (max + 10).toDouble(); // memberi ruang di atas bar tertinggi
  }
}
