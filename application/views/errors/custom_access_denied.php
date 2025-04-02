<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="<?= base_url('uploads/page_icon/access_denied.jpg') ?>">

</head>

<body class="relative flex items-center justify-center min-h-screen bg-gray-900 text-white overflow-hidden">
    <!-- 🌊 Animated Background -->
    <div class="absolute inset-0">
        <div class="absolute w-full h-full bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 opacity-90"></div>
        <div class="absolute w-full h-full bg-transparent bg-cover"
            style="background-image: url('https://www.transparenttextures.com/patterns/dark-matter.png');"></div>
    </div>

    <!-- 🌌 Floating Particles -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-10 left-1/4 w-2 h-2 bg-blue-400 rounded-full animate-float-glow"></div>
        <div class="absolute top-1/3 right-1/4 w-3 h-3 bg-red-400 rounded-full animate-float-glow"></div>
        <div class="absolute bottom-10 left-1/3 w-4 h-4 bg-yellow-400 rounded-full animate-float-glow"></div>
    </div>

    <!-- 🚀 Access Denied Card -->
    <div
        class="relative z-10 bg-gray-800/80 shadow-2xl rounded-lg p-10 max-w-md text-center border border-gray-700 animate-fade-in backdrop-blur-lg">
        <!-- 🚨 Animated Error Icon -->
        <div class="text-red-500 mb-4">
            <svg class="w-16 h-16 mx-auto animate-shake-glow" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v4m0 4h.01M4.293 17.293a1 1 0 001.414 0L12 10.414l6.293 6.293a1 1 0 001.414-1.414l-7-7a1 1 0 00-1.414 0l-7 7a1 1 0 000 1.414z">
                </path>
            </svg>
        </div>

        <!-- 🔴 Title -->
        <h1 class="text-4xl font-extrabold text-red-500 mb-4 uppercase tracking-widest">Access Denied</h1>
        <p class="text-gray-300 ">You are not logged in or your session has expired.</p>
        <p class="text-red-300 mb-6">Logout other localhost server account!</p>


        <!-- 🔄 Animated Neon Glassmorphism Button -->
        <a href="<?php echo base_url('auth'); ?>"
            class="relative inline-block px-8 py-3 rounded-md font-semibold text-lg shadow-lg transition duration-300 transform group border border-blue-500/50 bg-gradient-to-r from-blue-500/20 to-blue-500/40 backdrop-blur-md hover:scale-105 hover:from-blue-500 hover:to-blue-700">
            <span class="absolute inset-0 bg-blue-500/30 blur-md opacity-70 group-hover:opacity-100"></span>
            <span class="relative text-blue-200 uppercase text-sm tracking-wide">🔐 Go to Login</span>
        </a>
    </div>

    <!-- ✅ CSS Animations -->
    <style>
        /* 🌊 Smooth Fade-In */
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }

        /* 🚨 Shake and Glow Animation */
        @keyframes shake-glow {

            0%,
            100% {
                transform: translateX(0);
                text-shadow: 0 0 8px rgba(255, 0, 0, 0.7);
            }

            25% {
                transform: translateX(-4px);
                text-shadow: 0 0 12px rgba(255, 0, 0, 0.8);
            }

            50% {
                transform: translateX(4px);
                text-shadow: 0 0 15px rgba(255, 0, 0, 1);
            }

            75% {
                transform: translateX(-2px);
                text-shadow: 0 0 12px rgba(255, 0, 0, 0.8);
            }
        }

        .animate-shake-glow {
            animation: shake-glow 0.6s ease-in-out infinite alternate;
        }

        /* 🌌 Floating Particles with Glow */
        @keyframes float-glow {
            0% {
                transform: translateY(0);
                opacity: 0.7;
                box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            }

            50% {
                transform: translateY(-10px);
                opacity: 1;
                box-shadow: 0 0 12px rgba(255, 255, 255, 0.9);
            }

            100% {
                transform: translateY(0);
                opacity: 0.7;
                box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            }
        }

        .animate-float-glow {
            animation: float-glow 3s infinite ease-in-out alternate;
        }
    </style>
</body>

</html>