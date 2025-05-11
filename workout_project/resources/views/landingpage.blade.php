<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness App</title>
    <!-- Tailwind CSS and Flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {"50":"#fef2f2","100":"#fee2e2","200":"#fecaca","300":"#fca5a5","400":"#f87171","500":"#ef4444","600":"#dc2626","700":"#b91c1c","800":"#991b1b","900":"#7f1d1d","950":"#450a0a"}
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-black">
    <!-- Responsive Navbar -->
    <nav class="bg-white border-gray-200 sticky top-0 z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="assets/img/logo.png" class="h-10" alt="Fitness Logo" />
            </a>
            <div class="flex md:order-2 space-x-3">
                <button type="button" class="btn-login border border-gray-300 hover:bg-black hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all duration-300">LOGIN</button>
                <button type="button" class="btn-signup border border-gray-300 hover:bg-black hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all duration-300">SIGN UP</button>
                <button data-collapse-toggle="navbar-cta" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-cta" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="#home" id="nav-home" class="nav-link block py-2 px-3 md:px-4 md:py-2 rounded-lg text-gray-500 hover:bg-black hover:text-white transition-all duration-300">HOME</a>
                    </li>
                    <li>
                        <a href="#about" id="nav-about" class="nav-link block py-2 px-3 md:px-4 md:py-2 rounded-lg text-gray-500 hover:bg-black hover:text-white transition-all duration-300">ABOUT</a>
                    </li>
                    <li>
                        <a href="#feature" id="nav-feature" class="nav-link block py-2 px-3 md:px-4 md:py-2 rounded-lg text-gray-500 hover:bg-black hover:text-white transition-all duration-300">FEATURE</a>
                    </li>
                    <li>
                        <a href="#download" id="nav-download" class="nav-link block py-2 px-3 md:px-4 md:py-2 rounded-lg text-gray-500 hover:bg-black hover:text-white transition-all duration-300">DOWNLOAD</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-content">
        <!-- SECTION HOME -->
        <section id="home" class="min-h-screen flex flex-col items-center justify-center bg-gray-50 pt-16 md:pt-0">
            <div class="w-full max-w-5xl px-4 md:px-0">
                <img id="homeImage" src="assets/img/1.png" alt="Fitness Image" class="fitness-image w-full transition-all duration-300">
            </div>
        </section>

        <!-- CSS: Timbul Effect -->
        <style>
            .fitness-image {
                transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            }

            .fitness-image.active {
                transform: scale(1.05);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }
        </style>

        <!-- SECTION ABOUT -->
        <section id="about" class="min-h-screen flex items-center justify-center bg-gradient-to-r from-white py-16">
            <div class="container mx-auto px-4 md:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-10">
                    <!-- TEXT CONTENT -->
                    <div class="md:w-1/2 text-center md:text-left">
                        <h1 class="text-3xl md:text-4xl font-bold mb-4 leading-tight">
                            Transformasi Diri Dimulai di Sini – <br class="hidden md:block">
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
            
                    <!-- IMAGE -->
                    <div class="md:w-1/2 mt-8 md:mt-0 flex justify-center relative">
                        <div class="relative">
                            <!-- Red Gradient Background -->
                            <div class="absolute w-full md:w-[500px] h-[350px] md:h-[450px] bg-gradient-to-b from-red-700 via-red-600 to-white rounded-full blur-2xl opacity-80 z-0 transform translate-y-20 md:translate-y-40"></div>
            
                            <!-- Gym Person Image -->
                            <img src="assets/img/OrangGym.png" alt="Fitness Model"
                            class="relative w-full max-w-[250px] md:max-w-[300px] lg:max-w-[450px] h-auto 
                                object-cover drop-shadow-lg transform translate-y-8 z-10">                   
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- SECTION FEATURE -->
        <section id="feature" class="min-h-screen flex flex-col items-center justify-center bg-white py-16">
            <h2 class="text-4xl md:text-5xl font-bold italic mb-8 md:mb-16 shadow-lg px-4 text-center">WHY CHOOSE US</h2>
            <div class="flex flex-col md:flex-row gap-6 md:gap-10 px-4">
                <!-- Card 1 -->
                <div class="feature-card bg-gray-400 text-white p-6 md:p-8 rounded-xl shadow-xl w-full md:w-80 min-h-[250px] md:min-h-[300px] text-center cursor-pointer transition-all duration-300"
                onclick="toggleCard(this)">
                    <div>
                        <img src="assets/img/barbel.png" alt="Workout Icon" class="mx-auto w-16 h-16 md:w-20 md:h-20">
                    </div>
                    <h3 class="font-bold text-xl md:text-2xl mt-4">Rekomendasi Workout yang Dipersonalisasi</h3>
                    <p class="text-base md:text-lg mt-2">Dapatkan saran latihan berdasarkan BMI, tingkat aktivitas, dan tujuan kebugaranmu.</p>
                </div>

                <!-- Card 2 (Default active) -->
                <div class="feature-card bg-black text-white p-6 md:p-8 rounded-xl shadow-xl w-full md:w-80 min-h-[250px] md:min-h-[300px] text-center cursor-pointer transition-all duration-300 active-card scale-105 shadow-2xl"
                onclick="toggleCard(this)">
                    <div>
                        <img src="assets/img/BMI.png" alt="BMI Icon" class="mx-auto w-16 h-16 md:w-20 md:h-20">
                    </div>
                    <h3 class="font-bold text-xl md:text-2xl mt-4">Analisis BMI Akurat</h3>
                    <p class="text-base md:text-lg mt-2">Hitung Body Mass Index (BMI) dengan cepat untuk mengetahui kategori berat badanmu.</p>
                </div>

                <!-- Card 3 -->
                <div class="feature-card bg-gray-400 text-white p-6 md:p-8 rounded-xl shadow-xl w-full md:w-80 min-h-[250px] md:min-h-[300px] text-center cursor-pointer transition-all duration-300"
                onclick="toggleCard(this)">
                    <div>
                        <img src="assets/img/fleks.png" alt="fleks Icon" class="mx-auto w-16 h-16 md:w-20 md:h-20">
                    </div>
                    <h3 class="font-bold text-xl md:text-2xl mt-4">Fleksibilitas & Akses 24/7</h3>
                    <p class="text-base md:text-lg mt-2">Latihan kapan saja dan di mana saja dengan akses tanpa batas ke panduan workout terbaik.</p>
                </div>
            </div>
        </section>

        <!-- SECTION DOWNLOAD -->
        <section id="download" class="relative min-h-[70vh] flex flex-col justify-between bg-gray-200">
            <!-- Main content wrapper -->
            <div class="flex-grow flex flex-col items-center px-4 md:px-8 pt-10 md:pt-16">
                <!-- Image and Content Container -->
                <div class="relative w-full max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between">
                    <!-- Left side with image -->
                    <div class="relative w-full md:w-1/2 flex justify-center md:justify-start order-1 md:order-1">
                        <!-- Background red blur -->
                        <div class="absolute w-[200px] md:w-[300px] h-[300px] md:h-[400px] bg-gradient-to-b from-red-700 via-red-600 to-white rounded-full blur-2xl opacity-80 z-0 translate-y-40"></div>
                        
                        <!-- Girl image -->
                        <img src="assets/img/cewe.png" alt="Model" 
                             class="relative w-[220px] md:w-[300px] lg:w-[380px] max-w-full h-auto object-contain z-10 transform translate-y-20">
                    </div>

                    <!-- Right side content -->
                    <div class="w-full md:w-1/2 flex justify-center md:justify-end order-2 md:order-2 mt-32 md:mt-0">
                        <h2 class="text-4xl md:text-6xl font-bold italic text-gray-900 drop-shadow-lg md:transform md:translate-y-20">AVAILABLE ON</h2>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="w-full bg-red-900 text-white py-8 md:py-10 px-4 md:px-20 mt-8 relative z-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    <!-- Brand Info -->
                    <div class="relative">
                        <div class="flex items-center gap-2">
                            <img src="assets/img/logo.png" alt="Logo" class="w-8 md:w-12">
                            <h3 class="text-xl md:text-2xl font-bold">NAMA APLIKASI</h3>
                        </div>
                        <p class="text-sm mt-3 leading-relaxed">Nikmati pengalaman workout terbaik! Download sekarang dan mulai latihanmu!</p>
                    </div>

                    <!-- Navigation -->
                    <div>
                        <h3 class="font-bold text-lg">Navigation</h3>
                        <ul class="text-sm mt-3 space-y-1">
                            <li><a href="#home" class="hover:underline">Home</a></li>
                            <li><a href="#about" class="hover:underline">About</a></li>
                            <li><a href="#feature" class="hover:underline">Feature</a></li>
                            <li><a href="#download" class="hover:underline">Download</a></li>
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
                        <div class="flex space-x-4 mt-4">
                            <img src="assets/img/fb.png" alt="Facebook" class="w-8 h-8 md:w-12 md:h-12">
                            <img src="assets/img/twt.png" alt="Twitter" class="w-7 h-7 md:w-10 md:h-10 mt-1">
                            <img src="assets/img/wa.png" alt="WhatsApp" class="w-8 h-8 md:w-12 md:h-12">
                        </div>
                    </div>
                </div>

                <p class="text-center text-sm mt-8 md:mt-10 opacity-80">Copyright ©2025 Team2GolonganC, All rights reserved.</p>
            </footer>
        </section>
    </div>

    <!-- MODAL LOGIN -->
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-4 md:p-6 rounded-lg w-full max-w-xs md:max-w-md shadow-lg relative mx-4">
            <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">&times;</button>
            <h2 class="text-xl font-bold mb-4 md:mb-6 text-center">LOGIN</h2>

            <!-- Form Login Laravel Breeze -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label class="block mb-1 text-gray-700">Enter email</label>
                <input type="email" name="email" class="w-full p-2 border-2 border-red-600 rounded-full mb-4 focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Enter your email" required>

                <label class="block mb-1 text-gray-700">Enter Password</label>
                <div class="relative mb-4">
                    <input id="passwordInput" type="password" name="password" class="w-full p-2 border-2 border-red-600 rounded-full focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Enter your password" required>
                    <!-- Eye icon -->
                    <button type="button" id="togglePassword" class="absolute right-3 top-2.5 text-red-600 focus:outline-none">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                
                <!-- Forgot Password -->
                <div class="text-right mb-4">
                    <a href="#" class="text-red-600 text-sm hover:underline forgot-password-link">Forgot Password?</a>
                </div>

                <!-- Login Button -->
                <button type="submit" class="w-full bg-red-700 text-white py-2 rounded-full hover:bg-black transition-all">
                    LOGIN
                </button>
            </form>

            <!-- Link to Register -->
            <div class="text-center mt-6">
                <p class="text-gray-700 mb-2">Don't Have an Account?</p>
                <a href="#" class="signup-link text-red-600 hover:underline font-semibold">SIGN UP</a>
            </div>
        </div>
    </div>

    <!-- MODAL FORGOT PASSWORD -->
    <div id="forgotPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 md:p-8 rounded-xl w-full max-w-xs md:max-w-md shadow-2xl relative mx-4">
            <button id="closeForgotModal" class="absolute top-3 right-4 text-gray-500 hover:text-black text-2xl">&times;</button>
            <h2 class="text-xl md:text-2xl font-bold mb-3 md:mb-4 text-center">FORGOT PASSWORD</h2>
            <p class="text-xs md:text-sm text-gray-600 text-center mb-4 md:mb-6">
                Enter your registered email. We will send you a token to recover your account.
            </p>
            <form id="forgotPasswordForm" class="space-y-3 md:space-y-4">
                <div>
                    <label class="block text-gray-700 mb-1">Enter email</label>
                    <input type="email" id="forgotEmail" name="email" class="w-full p-2 md:p-3 border-2 border-red-400 rounded-full focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Enter your email" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-1">Token Verification</label>
                    <input type="text" id="tokenVerification" name="token" class="w-full p-2 md:p-3 border-2 border-red-400 rounded-full focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Enter your token" required>
                </div>

                <p id="forgotPasswordError" class="hidden text-red-600 text-xs md:text-sm text-center mt-2">incorrect verification token</p>
                <p id="forgotPasswordSuccess" class="hidden text-green-600 text-xs md:text-sm text-center mt-2"></p>

                <button type="submit" class="w-full bg-red-700 text-white py-2 md:py-3 rounded-full hover:bg-black transition-all">SEND</button>
            </form>
        </div>
    </div>

    <!-- MODAL SIGN UP -->
    <div id="signupModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-4 md:p-6 rounded-lg w-full max-w-xs md:max-w-md shadow-lg relative mx-4">
            <button id="closeSignupModal" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">&times;</button>
            <h2 class="text-xl font-bold mb-4 text-center">SIGN UP</h2>
            <form id="signupForm">
                <label class="block mb-1 text-gray-700">Enter Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border-2 border-red-600 rounded-full mb-3 focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Enter your name" required>

                <label class="block mb-1 text-gray-700">Enter Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border-2 border-red-600 rounded-full mb-3 focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Enter your email" required>

                <label class="block mb-1 text-gray-700">Enter Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 border-2 border-red-600 rounded-full mb-3 focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Enter your password" required>

                <label class="block mb-1 text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border-2 border-red-600 rounded-full mb-3 focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Confirm your password" required>

                <button type="submit" class="w-full bg-red-700 text-white py-2 rounded-full hover:bg-black transition-all">SIGN UP</button>
            </form>
            <div class="text-center mt-4">
                <p class="text-gray-700 mb-2">Already Have an Account?</p>
                <a href="#" class="login-link text-red-600 hover:underline font-semibold">LOGIN</a>
            </div>
        </div>
    </div>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        
        // Home image animation script
        document.addEventListener("DOMContentLoaded", function() {
            // Feature card toggle
            function toggleCard(element) {
                let allCards = document.querySelectorAll(".feature-card");

                // Reset all cards to default color and remove raised effect
                allCards.forEach(card => {
                    card.classList.remove("bg-black", "active-card", "scale-105", "shadow-2xl");
                    card.classList.add("bg-gray-400", "shadow-xl");
                });

                // If clicked card was not active, make it black and add raised effect
                if (!element.classList.contains("active-card")) {
                    element.classList.remove("bg-gray-400", "shadow-xl");
                    element.classList.add("bg-black", "active-card", "scale-105", "shadow-2xl");
                }
            }
            window.toggleCard = toggleCard;

            // Handle smooth scrolling
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

                    // Close mobile menu when link is clicked
                    const navbarMenu = document.getElementById('navbar-cta');
                    if (navbarMenu.classList.contains('block')) {
                        document.querySelector('[data-collapse-toggle="navbar-cta"]').click();
                    }

                    // Active nav state
                    document.querySelectorAll('.nav-link').forEach(nav => {
                        nav.classList.remove('bg-black', 'text-white');
                        nav.classList.add('text-gray-500');
                    });
                    this.classList.add('bg-black', 'text-white');
                    this.classList.remove('text-gray-500');

                    // Home image animation
                    if (targetId === "home") {
                        const homeImage = document.getElementById("homeImage");
                        homeImage.classList.add("active");
                        setTimeout(() => {
                            homeImage.classList.remove("active");
                        }, 1000);
                    }
                });
            });

            // Modal functions
            const loginButton = document.querySelector(".btn-login");
            const aboutLoginButton = document.getElementById("aboutLoginButton");
            const signupButton = document.querySelector(".btn-signup");
            const loginModal = document.getElementById("loginModal");
            const signupModal = document.getElementById("signupModal");
            const forgotPasswordModal = document.getElementById("forgotPasswordModal");
            const closeLoginModal = document.getElementById("closeModal");
            const closeSignupModal = document.getElementById("closeSignupModal");
            const closeForgotModal = document.getElementById("closeForgotModal");
            const loginLink = document.querySelector(".login-link");
            const signupLink = document.querySelector(".signup-link");
            const forgotPasswordLink = document.querySelector(".forgot-password-link");

            // Login modal
            loginButton.addEventListener("click", () => {
                loginModal.classList.remove("hidden");
            });

            aboutLoginButton.addEventListener("click", () => {
                loginModal.classList.remove("hidden");
            });

            closeLoginModal.addEventListener("click", () => {
                loginModal.classList.add("hidden");
            });

            // Sign up modal
            signupButton.addEventListener("click", () => {
                signupModal.classList.remove("hidden");
            });

            closeSignupModal.addEventListener("click", () => {
                signupModal.classList.add("hidden");
            });

            // Forgot password modal
            forgotPasswordLink.addEventListener("click", (e) => {
                e.preventDefault();
                loginModal.classList.add("hidden");
                forgotPasswordModal.classList.remove("hidden");
            });

            closeForgotModal.addEventListener("click", () => {
                forgotPasswordModal.classList.add("hidden");
            });

            // Toggle between login and signup
            loginLink.addEventListener("click", (e) => {
                e.preventDefault();
                signupModal.classList.add("hidden");
                loginModal.classList.remove("hidden");
            });

            signupLink.addEventListener("click", (e) => {
                e.preventDefault();
                loginModal.classList.add("hidden");
                signupModal.classList.remove("hidden");
            });

            // Password visibility toggle
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('passwordInput');
            
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
            });

            // Form submissions
            const signupForm = document.getElementById("signupForm");
            const forgotPasswordForm = document.getElementById("forgotPasswordForm");
            const forgotPasswordSuccess = document.getElementById("forgotPasswordSuccess");
            const forgotPasswordError = document.getElementById("forgotPasswordError");

            // Sign up form submission
            if (signupForm) {
                signupForm.addEventListener("submit", function (e) {
                    e.preventDefault();
                    
                    // Get form values
                    const name = document.getElementById("name").value;
                    const email = document.getElementById("email").value;
                    const password = document.getElementById("password").value;
                    const passwordConfirmation = document.getElementById("password_confirmation").value;
                    
                    // Basic validation
                    if (password !== passwordConfirmation) {
                        alert("Passwords do not match!");
                        return;
                    }
                    
                    // Here you would normally send data to server
                    // For now, just show a success message
                    alert("Sign Up Successful! You can now login with your credentials.");
                    signupModal.classList.add("hidden");
                    loginModal.classList.remove("hidden");
                });
            }

            // Forgot password form submission
            if (forgotPasswordForm) {
                forgotPasswordForm.addEventListener("submit", function (e) {
                    e.preventDefault();
                    
                    const email = document.getElementById("forgotEmail").value;
                    const token = document.getElementById("tokenVerification").value;
                    
                    // Simulate verification (replace with actual API call)
                    if (token === "123456") { // Example verification token
                        forgotPasswordSuccess.textContent = "Password reset link sent to your email!";
                        forgotPasswordSuccess.classList.remove("hidden");
                        forgotPasswordError.classList.add("hidden");
                        
                        // Close modal after success
                        setTimeout(() => {
                            forgotPasswordModal.classList.add("hidden");
                            loginModal.classList.remove("hidden");
                        }, 3000);
                    } else {
                        forgotPasswordError.textContent = "Incorrect verification token. Please try again.";
                        forgotPasswordError.classList.remove("hidden");
                        forgotPasswordSuccess.classList.add("hidden");
                    }
                });
            }

            // Active nav handler when scrolling
            function updateActiveNav() {
                const sections = document.querySelectorAll("section");
                const navLinks = document.querySelectorAll(".nav-link");
                
                let current = "";
                
                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (window.scrollY >= sectionTop - 100) {
                        current = section.getAttribute("id");
                    }
                });
                
                navLinks.forEach((link) => {
                    link.classList.remove("bg-black", "text-white");
                    link.classList.add("text-gray-500");
                    if (link.getAttribute("href") === "#" + current) {
                        link.classList.add("bg-black", "text-white");
                        link.classList.remove("text-gray-500");
                    }
                });
            }
            
            window.addEventListener("scroll", updateActiveNav);
            
            // Initialize active nav on page load
            updateActiveNav();
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menuItems = document.getElementById('menu-items');
            menuItems.classList.toggle('hidden');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const menuItems = document.getElementById('menu-items');
            const mobileButton = document.getElementById('mobile-menu-button');
            if (!menuItems.contains(event.target) && !mobileButton.contains(event.target) && !menuItems.classList.contains('hidden')) {
                menuItems.classList.add('hidden');
            }
        });
    </script>

    <!-- Add responsive styles -->
    <style>
        @media (max-width: 768px) {
            .menu-items {
                font-size: 14px;
            }
            .menu-items a {
                display: block;
                padding: 10px;
                text-align: center;
            }
            #menu-items {
                background: white;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                padding: 8px;
            }
        }
    </style>
</body>
</html>