const express = require('express');
const app = express();

// Middleware untuk parsing JSON dan URL-encoded
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// (Opsional) Konfigurasi CORS jika frontend berada di domain berbeda
// app.use(require('cors')());

// Rute dan model akan didefinisikan di bawah
const User = require('./models/user');
const bcrypt = require('bcrypt');

app.post('/signup', async (req, res) => {
  try {
    const { name, email, password, confirmPassword } = req.body;
    // Validasi dasar
    if (!name || !email || !password || !confirmPassword) {
      return res.status(400).json({ message: 'Semua field wajib diisi' });
    }
    if (password !== confirmPassword) {
      return res.status(400).json({ message: 'Password dan konfirmasi tidak cocok' });
    }
    // Hash password sebelum disimpan
    const hashedPwd = await bcrypt.hash(password, 10);
    // Simpan user baru ke MongoDB
    const newUser = new users({ name, email, password: hashedPwd });
    await newUser.save();
    return res.status(201).json({ message: 'User berhasil dibuat' });
  } catch (err) {
    // Penanganan error (misalnya email sudah digunakan)
    console.error(err);
    return res.status(500).json({ message: 'Terjadi kesalahan server', error: err.message });
  }
});
const form = document.getElementById('signup-form');
form.addEventListener('submit', async (e) => {
  e.preventDefault();  // Mencegah reload halaman
  const name = form.name.value;
  const email = form.email.value;
  const password = form.password.value;
  const confirmPassword = form.confirmPassword.value;

  try {
    const response = await fetch('/signup', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name, email, password, confirmPassword })
    });
    const result = await response.json();
    console.log(result);
    // Tambahkan logika untuk menampilkan pesan sukses atau error ke pengguna
  } catch (error) {
    console.error('Fetch error:', error);
  }
});


const mongoose = require('mongoose');
mongoose.connect('mongodb://127.0.0.1:27017/workout_db', {
  useNewUrlParser: true,
  useUnifiedTopology: true
});
const db = mongoose.connection;
db.on('error', console.error.bind(console, 'Koneksi MongoDB error:'));
db.once('open', () => {
  console.log('Terhubung ke MongoDB');
});
