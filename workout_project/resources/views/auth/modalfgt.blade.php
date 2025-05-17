<!-- Tombol untuk membuka modal -->
<button id="openResetModal" class="px-4 py-2 bg-red-700 text-white rounded hover:bg-black">
  Buka Modal Reset Password
</button>

<!-- Reset Password Modal -->
<div id="resetPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 ">
    <div class="bg-white p-6 md:p-8 rounded-xl w-full max-w-xs md:max-w-md shadow-2xl relative mx-4">
        <button id="closeResetModal" class="absolute top-3 right-4 text-gray-500 hover:text-black text-2xl">&times;</button>
        <h2 class="text-xl md:text-2xl font-bold mb-3 md:mb-4 text-center">RESET PASSWORD</h2>

        <form id="resetPasswordForm" class="space-y-3 md:space-y-4">
            <div>
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email" name="email"
                    class="w-full p-3 border-2 border-red-400 rounded-full bg-blue-100 focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Masukkan email" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Password Baru</label>
                <input type="password" name="password"
                    class="w-full p-3 border-2 border-red-400 rounded-full bg-blue-100 focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Masukkan password baru" required>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full p-3 border-2 border-red-400 rounded-full bg-blue-100 focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Ulangi password" required>
            </div>

            <button type="submit"
                class="w-full bg-red-700 text-white py-3 rounded-full hover:bg-black transition-all">RESET PASSWORD</button>
        </form>
    </div>
</div>

<script>
  const openBtn = document.getElementById('openResetModal');
  const closeBtn = document.getElementById('closeResetModal');
  const modal = document.getElementById('resetPasswordModal');

  // Buka modal saat tombol ditekan
  openBtn.addEventListener('click', () => {
    modal.classList.remove('hidden');
  });

  // Tutup modal saat tombol "×" ditekan
  closeBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
  });

  // Tutup modal saat klik area background modal (tapi bukan isi modal)
  modal.addEventListener('click', (e) => {
    // Cek kalau klik di modal itu sendiri (background overlay), bukan di kotak modal isi
    if(e.target === modal) {
      modal.classList.add('hidden');
    }
  });
</script>
