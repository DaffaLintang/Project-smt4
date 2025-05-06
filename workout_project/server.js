const express = require('express');
const mongoose = require('mongoose');

const app = express();

// Koneksi ke MongoDB
mongoose.connect('mongodb://localhost:27017/workout_db', {
  useNewUrlParser: true,
  useUnifiedTopology: true
});

// Skema dan Model
const Histori = mongoose.model('historis', new mongoose.Schema({
  kesulitan: String
}));

// Route untuk data chart
app.get('/workout-distribution', async (req, res) => {
  try {
    const counts = await Histori.aggregate([
      { $group: { _id: "$kesulitan", total: { $sum: 1 } } }
    ]);

    const result = { Beginner: 0, Intermediate: 0, Expert: 0 };
    counts.forEach(item => {
      result[item._id] = item.total;
    });

    res.json(result);
  } catch (err) {
    res.status(500).send(err.message);
  }
});

const PORT = 3000;
app.listen(PORT, () => {
  console.log(`Server running at http://localhost:${PORT}`);
});
