<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            font-size: 10px;
            scroll-behavior: smooth;
        }
        .menu-items a {
            font-size: 12px;
        }
        .btn-login, .btn-signup {
            transition: all 0.3s ease-in-out;
        }
        .btn-login:hover, .btn-signup:hover {
            background-color: black;
            color: white;
        }
        .sticky-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 15px 20px;
        }
        .page-content {
            padding-top: 80px;
        }
        .fitness-image {
            max-width: 100%;
            height: auto;
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .fitness-image.show {
            opacity: 1;
            transform: scale(1);
        }
        @media (min-width: 1024px) {
            img {
        transform: translateX(5%);
    }
}

    </style>
</head>
<script>
    
</script>
<body class="bg-white text-black">
    <nav class="sticky-nav flex items-center justify-between px-10 py-3">
        <a href="#" class="mr-auto">
            <img src="assets/img/logo.png" alt="Logo" class="h-10">
        </a>
        <div class="flex-1 flex justify-center">
            <ul class="menu-items flex font-semibold space-x-16">
                <li><a href="#home" id="nav-home" class="nav-link scroll-link px-4 py-2 rounded-full text-gray-500 hover:text-white">HOME</a></li>
                <li><a href="#about" id="nav-about" class="nav-link scroll-link px-4 py-2 rounded-full text-gray-500 hover:text-white">ABOUT</a></li>
                <li><a href="#feature" id="nav-feature" class="nav-link scroll-link px-4 py-2 rounded-full text-gray-500 hover:text-white">FEATURE</a></li>
                <li><a href="#download" id="nav-download" class="nav-link scroll-link px-4 py-2 rounded-full text-gray-500 hover:text-white">DOWNLOAD</a></li>
            </ul>
        </div>
        <div class="ml-auto space-x-4">
            <button class="btn-login border px-3 py-1 rounded-lg text-base">LOGIN</button>
            <button class="btn-signup border px-3 py-1 rounded-lg text-base">SIGN UP</button>
        </div>
    </nav>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navLinks = document.querySelectorAll(".nav-link");
            
            function updateActiveLink() {
                let scrollPosition = window.scrollY;
                navLinks.forEach(link => {
                    let section = document.querySelector(link.getAttribute("href"));
                    if (section) {
                        let sectionTop = section.offsetTop - 100;
                        let sectionHeight = section.offsetHeight;
                        if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                            navLinks.forEach(nav => nav.classList.remove("bg-black", "text-white"));
                            link.classList.add("bg-black", "text-white");
                        }
                    }
                });
            }
    
            window.addEventListener("scroll", updateActiveLink);
            updateActiveLink();
        });
    </script>
    
    <div class="page-content">
    
        <!-- SECTION HOME -->
        <section id="home" class="h-screen flex flex-col items-center justify-center bg-gray-50" style="margin-top: -40px;">
            <div class="w-full max-w-5xl">
                <img id="homeImage" src="assets/img/1.png" alt="Fitness Image" class="fitness-image">
            </div>
        </section>
        
        <!-- CSS: Efek Timbul -->
        <style>
            .fitness-image {
                transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            }
        
            .fitness-image.active {
                transform: scale(1.05);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }
        </style>
        
        <!-- JavaScript: Tambahkan Efek Saat Navbar "Home" Diklik -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const navHome = document.getElementById("navHome"); // Ambil link Home di navbar
                const homeImage = document.getElementById("homeImage"); // Ambil gambar di home section
        
                navHome.addEventListener("click", function () {
                    // Tambahkan efek timbul ke gambar
                    homeImage.classList.add("active");
        
                    // Hapus efek setelah 1 detik agar bisa diulang lagi
                    setTimeout(() => {
                        homeImage.classList.remove("active");
                    }, 1000);
                });
            });
        </script>

         <!-- SECTION ABOUT -->
         <section id="about" class="h-screen flex items-center justify-center bg-gradient-to-r from-white">
            <div class="container mx-auto flex flex-col md:flex-row items-center justify-between">
                <!-- KONTEN TEKS -->
                <div class="md:w-1/2 text-center md:text-left">
                    <h1 class="text-4xl font-bold mb-4 leading-tight">
                        Transformasi Diri Dimulai di Sini – <br>
                        Dapatkan Rekomendasi Workout yang Sesuai untukmu!
                    </h1>
                    <p class="text-gray-700 mb-4">
                        Dengan teknologi cerdas, kami membantu kamu menemukan pola latihan yang sesuai dengan kebutuhan dan tujuanmu.
                    </p>
                    <p class="text-gray-700 mb-6">
                        Mulai sekarang dan raih kebugaran optimal!
                    </p>
                    <button id="aboutLoginButton" class="bg-black text-white px-6 py-3 rounded-full hover:bg-gray-800 transition-all">
                        DAFTAR SEKARANG 
                    </button>
                </div>
        
                <!-- GAMBAR -->
                <div class="md:w-1/2 mt-8 md:mt-0 flex justify-center relative">
                    <img src="assets/img/OrangGym.png" alt="Fitness Model" 
                         class="w-full max-w-[750px] lg:max-w-[800px] xl:max-w-[500px] 
                                h-auto object-cover drop-shadow-lg transform translate-x-8 translate-y-11">
                </div>
                
                                                                             
            </div>
        </section>
        
        <!-- SECTION FEATURE -->
        <section id="feature" class="h-screen flex flex-col items-center justify-center bg-white">
            <h2 class="text-5xl font-bold italic mb-16 shadow-lg">WHY CHOOSE US</h2>
            <div class="flex gap-10">
                <!-- Card 1 -->
                <div class="feature-card bg-gray-400 text-white p-8 rounded-xl shadow-xl w-80 min-h-[300px] text-center cursor-pointer transition-all duration-300"
    onclick="toggleCard(this)">
    <div>
        <img src="assets/img/barbel.png" alt="Workout Icon" class="mx-auto w-20 h-20">
    </div>
    <h3 class="font-bold text-2xl mt-4">Rekomendasi Workout yang Dipersonalisasi</h3>
    <p class="text-lg mt-2">Dapatkan saran latihan berdasarkan BMI, tingkat aktivitas, dan tujuan kebugaranmu.</p>
</div>

        
                <!-- Card 2 (Default aktif) -->
                <div class="feature-card bg-black text-white p-8 rounded-xl shadow-xl w-80 min-h-[300px] text-center cursor-pointer transition-all duration-300 active-card scale-105 shadow-2xl"
                    onclick="toggleCard(this)">
                    <div>
                        <img src="assets/img/BMI.png" alt="BMI Icon" class="mx-auto w-20 h-20">
                    </div>
                    <h3 class="font-bold text-2xl mt-4">Analisis BMI Akurat</h3>
                    <p class="text-lg mt-2">Hitung Body Mass Index (BMI) dengan cepat untuk mengetahui kategori berat badanmu.</p>
                </div>
        
                <!-- Card 3 -->
                <div class="feature-card bg-gray-400 text-white p-8 rounded-xl shadow-xl w-80 min-h-[300px] text-center cursor-pointer transition-all duration-300"
                    onclick="toggleCard(this)">
                    <div>
                        <img src="assets/img/fleks.png" alt="fleks Icon" class="mx-auto w-20 h-20">
                    </div>
                    <h3 class="font-bold text-2xl mt-4">Fleksibilitas & Akses 24/7</h3>
                    <p class="text-lg mt-2">Latihan kapan saja dan di mana saja dengan akses tanpa batas ke panduan workout terbaik.</p>
                </div>
            </div>
        </section>
        
        <script>
            function toggleCard(element) {
                let allCards = document.querySelectorAll(".feature-card");
        
                // Reset semua kartu ke warna default dan menghapus efek timbul
                allCards.forEach(card => {
                    card.classList.remove("bg-black", "active-card", "scale-105", "shadow-2xl");
                    card.classList.add("bg-gray-400", "shadow-xl");
                });
        
                // Jika kartu yang diklik belum aktif, ubah jadi hitam dan beri efek timbul
                if (!element.classList.contains("active-card")) {
                    element.classList.remove("bg-gray-400", "shadow-xl");
                    element.classList.add("bg-black", "active-card", "scale-105", "shadow-2xl");
                }
            }
        </script>
        
        <!-- SECTION DOWNLOAD -->
        <section id="download" class="relative h-screen flex flex-col justify-end bg-gray-200">
            <!-- Efek Gradient Background -->
            <div class="absolute top-0 left-0 w-full h-1/2 bg-gradient-to-b from-white to-gray-200"></div>
        
            <!-- Model -->
            <img src="assets/img/cewe.png" alt="Model" 
            class="absolute left-[10%] bottom-[18%] transform -translate-y-1/2 w-[250px] md:w-[350px] lg:w-[400px] max-w-full h-auto object-contain z-10">
               
            <!-- Teks "AVAILABLE ON" -->
            <h2 class="text-6xl font-bold italic text-gray-900 drop-shadow-lg absolute top-20 right-20">AVAILABLE ON</h2>
        
            <!-- Footer -->
            <footer class="w-full bg-red-900 text-white py-10 px-20 relative z-10">
                <div class="grid grid-cols-5 gap-8">
                    
                    <!-- Brand Info -->
                    <div class="relative">
                        <div class="flex items-center gap-2">
                            <img src="assets/img/logo.png" alt="Logo" class="w-12">
                            <h3 class="text-2xl font-bold">NAMA APLIKASI</h3>
                        </div>
                        <p class="text-sm mt-3 leading-relaxed">Nikmati pengalaman workout terbaik! Download sekarang dan mulai latihanmu!</p>
                    </div>
        
                    <!-- Navigation -->
                    <div>
                        <h3 class="font-bold text-lg">Navigation</h3>
                        <ul class="text-sm mt-3 space-y-1">
                            <li><a href="#" class="hover:underline">Home</a></li>
                            <li><a href="#" class="hover:underline">About</a></li>
                            <li><a href="#" class="hover:underline">Feature</a></li>
                            <li><a href="#" class="hover:underline">Download</a></li>
                        </ul>
                    </div>
        
                    <!-- Features -->
                    <div>
                        <h3 class="font-bold text-lg">Feature</h3>
                        <ul class="text-sm mt-3 space-y-1">
                            <li>BMI</li>
                            <li>Rekomendasi</li>
                            <li>24/7</li>
                            <li>Berbasis Data & AI</li>
                        </ul>
                    </div>
        
                    <!-- Support -->
                    <div>
                        <h3 class="font-bold text-lg">Support</h3>
                        <ul class="text-sm mt-3 space-y-1">
                            <li>My Account</li>
                            <li>Share On</li>
                        </ul>
                    </div>
        
                    <!-- Download Section -->
                    <div>
                        <h3 class="font-bold text-lg">Download App</h3>
                        <p class="text-sm mt-3">Available in any kind of ready version</p>
                       
                        <!-- Social Media Icons -->
                        <div class="flex space-x-5 mt-5">
                            <img src="assets/img/fb.png" alt="Facebook" class="w-12 h-12">
                            <img src="assets/img/twt.png" alt="Twitter" class="w-10 h-10">
                            <img src="assets/img/wa.png" alt="WhatsApp" class="w-12 h-12">
                        </div>                                            
                    </div>
                </div>
        
                <p class="text-center text-sm mt-10 opacity-80">Copyright ©2025 Team2GolonganC, All rights reserved.</p>
            </footer>
        
        </section>
        
    </div>

    <!-- MODAL LOGIN -->
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg w-96 shadow-lg relative">
            <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-black">&times;</button>
            <h2 class="text-xl font-bold mb-4 text-center">LOGIN</h2>
            <form>
                <label class="block mb-2">Enter email</label>
                <input type="email" class="w-full p-2 border rounded-lg mb-3" placeholder="Enter your email">
                <label class="block mb-2">Enter Password</label>
                <input type="password" class="w-full p-2 border rounded-lg mb-3" placeholder="Enter your password">
                <div class="text-right text-red-600 text-sm mb-3">
                    <a href="#" class="forgot-password-link hover:underline">Forgot Password?</a>
                </div>
                <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-black">LOGIN</button>
            </form>
            <div class="text-center mt-4">
                <p>Don't Have an Account?</p>
                <a href="#" class="signup-link text-red-600 hover:underline">SIGN UP</a>
            </div>
        </div>
    </div>
    <script>
       document.querySelectorAll('.scroll-link').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 60,
                behavior: 'smooth'
            });
        }
                if (targetId === "home") {
                    const homeImage = document.getElementById("homeImage");
                    homeImage.classList.remove("show");
                    setTimeout(() => homeImage.classList.add("show"), 300);
                }
            });
        });
    
        window.onload = function() {
            setTimeout(() => {
                document.getElementById("homeImage").classList.add("show");
            }, 300);
        };
    
        const loginButton = document.querySelector(".btn-login");
        const aboutLoginButton = document.getElementById("aboutLoginButton");
        const loginModal = document.getElementById("loginModal");
        const closeModal = document.getElementById("closeModal");
    
        loginButton.addEventListener("click", () => {
            loginModal.classList.remove("hidden");
        });

        aboutLoginButton.addEventListener("click", () => {
        loginModal.classList.remove("hidden");
    });
    
        closeModal.addEventListener("click", () => {
            loginModal.classList.add("hidden");
        });

        
    
        // Tombol navigasi aktif saat diklik
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.nav-link').forEach(nav => {
                    nav.classList.remove('bg-black', 'text-white');
                    nav.classList.add('text-gray-500');
                });
    
                this.classList.add('bg-black', 'text-white');
                this.classList.remove('text-gray-500');
            });
        });
    </script>
    

    <!-- MODAL FORGOT PASSWORD -->
<div id="forgotPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg w-96 shadow-lg relative">
        <button id="closeForgotModal" class="absolute top-2 right-2 text-gray-500 hover:text-black">&times;</button>
        <h2 class="text-xl font-bold mb-4 text-center">FORGOT PASSWORD</h2>
        <p class="text-sm text-gray-600 text-center mb-4">
            Enter your registered email. We will send you a token to recover your account.
        </p>
        <form>
            <label class="block mb-2">Enter email</label>
            <input type="email" class="w-full p-2 border rounded-lg mb-3" placeholder="Enter your email">

            <label class="block mb-2">Token Verification</label>
            <input type="text" class="w-full p-2 border rounded-lg mb-3" placeholder="Enter verification token">

            <p class="text-red-600 text-sm mb-3 hidden" id="errorMessage">Incorrect verification token</p>

            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-black">SEND</button>
        </form>
    </div>
</div>

<script>
    // Ambil elemen tombol dan modal forgot password
    const forgotPasswordLink = document.querySelector(".forgot-password-link");
    const forgotPasswordModal = document.getElementById("forgotPasswordModal");
    const closeForgotModal = document.getElementById("closeForgotModal");

    // Jika "Forgot Password?" diklik, tutup modal login dan buka modal forgot password
    forgotPasswordLink.addEventListener("click", (e) => {
        e.preventDefault();
        loginModal.classList.add("hidden");
        forgotPasswordModal.classList.remove("hidden");
    });

    // Sembunyikan modal forgot password saat tombol close ditekan
    closeForgotModal.addEventListener("click", () => {
        forgotPasswordModal.classList.add("hidden");
    });
</script>

<!-- MODAL SIGN UP -->
<div id="signupModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg w-96 shadow-lg relative">
        <button id="closeSignupModal" class="absolute top-2 right-2 text-gray-500 hover:text-black">&times;</button>
        <h2 class="text-xl font-bold mb-4 text-center">SIGN UP</h2>
        <form>
            <label class="block mb-2">Enter email</label>
            <input type="email" class="w-full p-2 border rounded-lg mb-3" placeholder="Enter your email">

            <label class="block mb-2">Enter Password</label>
            <input type="password" class="w-full p-2 border rounded-lg mb-3" placeholder="Enter your password">

            <label class="block mb-2">Confirm Password</label>
            <input type="password" class="w-full p-2 border rounded-lg mb-3" placeholder="Confirm your password">

            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-black">SIGN UP</button>
        </form>
        <div class="text-center mt-4">
            <p>Already Have an Account?</p>
            <a href="#" class="login-link text-red-600 hover:underline">LOGIN</a>
        </div>
    </div>
</div>

<script>
    // Ambil elemen tombol dan modal Sign Up
    const signupLink = document.querySelector(".signup-link");
    const signupModal = document.getElementById("signupModal");
    const closeSignupModal = document.getElementById("closeSignupModal");

    // Jika "Sign Up" diklik di modal login, tutup modal login dan buka modal signup
    signupLink.addEventListener("click", (e) => {
        e.preventDefault();
        loginModal.classList.add("hidden");
        signupModal.classList.remove("hidden");
    });

    // Jika "Login" diklik di modal signup, tutup modal signup dan buka modal login
    document.querySelector(".login-link").addEventListener("click", (e) => {
        e.preventDefault();
        signupModal.classList.add("hidden");
        loginModal.classList.remove("hidden");
    });

    // Tombol close modal signup
    closeSignupModal.addEventListener("click", () => {
        signupModal.classList.add("hidden");
    });

    // Tombol Sign Up di navbar
    const signupButton = document.querySelector(".btn-signup");
    signupButton.addEventListener("click", () => {
        signupModal.classList.remove("hidden");
    });
</script>

</body>
</html>