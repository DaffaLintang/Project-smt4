// file: routes/chartData.js
const express = require('express');
const router = express.Router();
const mongoose = require('mongoose');

const Histori = mongoose.model('historis', new mongoose.Schema({
  kesulitan: String
}));

router.get('/workout-distribution', async (req, res) => {
  try {
    const counts = await Histori.aggregate([
      { $group: { _id: "$kesulitan", total: { $sum: 1 } } }
    ]);

    // Ubah hasil agar cocok untuk Chart.js
    const result = { Beginner: 0, Intermediate: 0, Expert: 0 };
    counts.forEach(item => {
      result[item._id] = item.total;
    });

    res.json(result);
  } catch (err) {
    res.status(500).send(err.message);
  }
});

module.exports = router;
