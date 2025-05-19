import express from 'express';
import mongoose from 'mongoose';
import bodyParser from 'body-parser';
import cors from 'cors';

const app = express();
const PORT = 5000;

// Middleware
app.use(cors());
app.use(bodyParser.json());

// Koneksi MongoDB
mongoose.connect('mongodb://localhost:27017/workout_db', {
  useNewUrlParser: true,
  useUnifiedTopology: true
});
const db = mongoose.connection;
db.on('error', console.error.bind(console, 'Connection error:'));
db.once('open', () => console.log('Connected to MongoDB'));

// --- MODEL ---

// Model untuk Histori Workout
const Histori = mongoose.model('historis', new mongoose.Schema({
  kesulitan: String
}));

// Model untuk User
const userSchema = new mongoose.Schema({
  name: String,
  email: String,
  password: String,
});
const User = mongoose.model('User', userSchema);

// --- ROUTES ---

// Route untuk Sign Up
app.post('/signup', async (req, res) => {
  const { name, email, password } = req.body;

  try {
    const existingUser = await User.findOne({ email });
    if (existingUser) return res.status(400).json({ message: 'Email already registered' });

    const newUser = new User({ name, email, password });
    await newUser.save();
    res.status(201).json({ message: 'User registered successfully' });
  } catch (error) {
  console.error('Signup error:', error);
  res.status(500).json({ message: 'Server error' });
}
});

// Route untuk data chart workout
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

// --- RUN SERVER ---
app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
