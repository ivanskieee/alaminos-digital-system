<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Front Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="<?= base_url('assets/css/frontpage.css?v=' . filemtime('assets/css/frontpage.css')) ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image/png" href="<?= base_url('uploads/page_icon/RANKINGsystemicon.jpg') ?>">

    <style>

    </style>
</head>

<body class="scroll-smooth">

    <!-- Navbar -->
    <!-- Navbar -->
    <nav class="bg-teal-800 fixed w-full z-50 shadow-lg">
        <div class="container mx-auto flex items-center justify-between px-6 py-3">
            <!-- <a href="#">
                <img src="<?= base_url('/design/images/greenSPClogo.avif') ?>" alt="Logo" class="h-10">
            </a> -->

            <!-- Mobile Menu Button -->
            <button id="menu-toggle" class="md:hidden text-white text-2xl focus:outline-none">
                &#9776;
            </button>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-6">
                <a href="#features" class="text-white hover:text-yellow-400 nav-link">Features</a>
                <a href="#about" class="text-white hover:text-yellow-400 nav-link">About</a>
                <a href="#testimonials" class="text-white hover:text-yellow-400 nav-link">Testimonials</a>
            </div>

            <div class="hidden md:flex space-x-4">
                <a href="<?= base_url('auth/login') ?>" class="text-white hover:text-yellow-400">Login</a>
                <a href="<?= base_url('auth/viewregister') ?>" class="text-white hover:text-yellow-400">Register</a>
                <a href="<?= base_url('auth/contact') ?>" class="text-white hover:text-yellow-400">Schedule</a>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by Default) -->
        <div id="mobile-menu" class="hidden bg-teal-900 md:hidden">
            <a href="#features" class="block text-white py-2 px-6 hover:bg-teal-700">Features</a>
            <a href="#about" class="block text-white py-2 px-6 hover:bg-teal-700">About</a>
            <a href="#testimonials" class="block text-white py-2 px-6 hover:bg-teal-700">Testimonials</a>
            <hr class="border-teal-700">
            <a href="<?= base_url('auth/login') ?>" class="block text-white py-2 px-6 hover:bg-teal-700">Login</a>
            <a href="<?= base_url('auth/viewregister') ?>"
                class="block text-white py-2 px-6 hover:bg-teal-700">Register</a>
            <a href="<?= base_url('auth/contact') ?>" class="block text-white py-2 px-6 hover:bg-teal-700">Contact</a>
        </div>
    </nav>


    <!-- Hero Section -->
    <section
        class="hero min-h-screen flex items-center justify-center text-center bg-gradient-to-r from-teal-700 to-teal-900 text-white px-6 fade-in">
        <div>
            <h1 class="text-4xl md:text-5xl font-bold uppercase ">Welcome to <h1
                    class="text-4xl md:text-5xl font-bold uppercase custom-text-stroke text-transparent ">
                    Alaminos, Digital Transformation
                </h1>
            </h1>
            <p class="text-lg md:text-2xl my-4">Experience seamless and efficient management</p>
            <button id="get-features"
                class="bg-yellow-400 text-teal-900 font-bold py-3 px-6 rounded-full hover:bg-yellow-500 transition">
                Explore Features
            </button>
            <style>
                .custom-text-stroke {
                    -webkit-text-stroke: 2px white;
                }
            </style>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="min-h-screen bg-cover bg-white bg-center px-6 py-16 fade-in relative"
        style="background-image: <?= base_url('assets/login_image/login_background3.jpg') ?>">

        <!-- Dark overlay for readability -->
        <div class="absolute inset-0 bg-cover bg-opacity-60"
            style="background-image: url('<?= base_url('assets/login_image/loginBackground.jpg') ?>');"></div>

        <div class="relative container mx-auto text-center">
            <h2 class="text-4xl font-bold mb-10 text-teal-700 uppercase">LGU Core Services</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1: Business Tax Processing -->
                <div
                    class="bg-white bg-opacity-90 shadow-lg rounded-lg p-6 flex flex-col items-center text-gray-900 transform hover:scale-105 transition">
                    <img src="https://img.icons8.com/ios-filled/100/66cdaa/bank-card-front-side.png" alt="Tax"
                        class="w-16 mb-4">
                    <h3 class="text-xl font-semibold text-teal-700">Business Tax Processing</h3>
                    <p class="text-gray-700 mt-2 text-sm">
                        Apply, compute, and process business tax payments efficiently online.
                    </p>
                </div>

                <!-- Feature 2: Digital Permit & Licensing -->
                <div
                    class="bg-white bg-opacity-90 shadow-lg rounded-lg p-6 flex flex-col items-center text-gray-900 transform hover:scale-105 transition">
                    <img src="https://img.icons8.com/ios-filled/100/66cdaa/license.png" alt="Permit" class="w-16 mb-4">
                    <h3 class="text-xl font-semibold text-teal-700">Digital Permit & Licensing</h3>
                    <p class="text-gray-700 mt-2 text-sm">
                        Streamline the application and renewal of business permits and licenses.
                    </p>
                </div>

                <!-- Feature 3: Citizen Feedback System -->
                <div
                    class="bg-white bg-opacity-90 shadow-lg rounded-lg p-6 flex flex-col items-center text-gray-900 transform hover:scale-105 transition">
                    <img src="https://img.icons8.com/ios-filled/100/66cdaa/feedback.png" alt="Feedback"
                        class="w-16 mb-4">
                    <h3 class="text-xl font-semibold text-teal-700">Citizen Feedback</h3>
                    <p class="text-gray-700 mt-2 text-sm">
                        Submit feedback and suggestions to help improve local governance.
                    </p>
                </div>

                <!-- Feature 4: Real-Time Status Tracking -->
                <div
                    class="bg-white bg-opacity-90 shadow-lg rounded-lg p-6 flex flex-col items-center text-gray-900 transform hover:scale-105 transition">
                    <img src="https://img.icons8.com/ios-filled/100/66cdaa/time-machine.png" alt="Status"
                        class="w-16 mb-4">
                    <h3 class="text-xl font-semibold text-teal-700">Real-Time Status Tracking</h3>
                    <p class="text-gray-700 mt-2 text-sm">
                        Monitor the status of your applications, taxes, and permits in real-time.
                    </p>
                </div>

                <!-- Feature 5: Secure Account Management -->
                <div
                    class="bg-white bg-opacity-90 shadow-lg rounded-lg p-6 flex flex-col items-center text-gray-900 transform hover:scale-105 transition">
                    <img src="https://img.icons8.com/ios-filled/100/66cdaa/lock.png" alt="Security" class="w-16 mb-4">
                    <h3 class="text-xl font-semibold text-teal-700">Secure Access</h3>
                    <p class="text-gray-700 mt-2 text-sm">
                        Government-verified user access for secure and private transactions.
                    </p>
                </div>

                <!-- Feature 6: Transparent LGU Dashboard -->
                <div
                    class="bg-white bg-opacity-90 shadow-lg rounded-lg p-6 flex flex-col items-center text-gray-900 transform hover:scale-105 transition">
                    <img src="https://img.icons8.com/ios-filled/100/66cdaa/combo-chart.png" alt="Dashboard"
                        class="w-16 mb-4">
                    <h3 class="text-xl font-semibold text-teal-700">LGU Dashboard</h3>
                    <p class="text-gray-700 mt-2 text-sm">
                        Access data analytics and performance reports for transparency and accountability.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-16 min-h-screen bg-cover bg-center fade-in relative"
        style="background-image: url('<?= base_url('assets/login_image/login_background2.jpg') ?>');">

        <!-- Dark overlay for readability -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <div class="relative container mx-auto px-6 text-center text-white">
            <h2 class="text-4xl font-bold mb-6">About Us</h2>
            <p class="max-w-3xl mx-auto mb-10 text-lg">
                Our system provides a transparent and efficient ranking platform for educational institutions.
                We empower faculty members and academic professionals by offering data-driven insights
                that enhance performance and promote growth.
            </p>

            <div class="grid md:grid-cols-2 gap-12">
                <!-- About Card 1 -->
                <div class="bg-white bg-opacity-90 shadow-lg rounded-lg p-6 flex flex-col items-center text-gray-900">
                    <img src="<?= base_url('assets/login_image/login_background3.jpg') ?>" alt="Innovation"
                        class="w-full h-48 object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold text-teal-700">Connecting with Our System</h3>
                    <p class="text-gray-600 mt-2">
                        Our ranking system ensures accuracy and fairness by providing a detailed evaluation of faculty
                        performance, fostering a culture of academic excellence.
                    </p>
                </div>

                <!-- About Card 2 -->
                <div class="bg-white bg-opacity-90 shadow-lg rounded-lg p-6 flex flex-col items-center text-gray-900">
                    <img src="<?= base_url('assets/login_image/login_background3.jpg') ?>" alt="Values"
                        class="w-full h-48 object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold text-teal-700">Our Core Values</h3>
                    <p class="text-gray-600 mt-2">
                        We prioritize innovation, integrity, and excellence. Our goal is to create a
                        transparent and growth-driven platform that uplifts educators and institutions.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <!-- Testimonials Section -->
    <section id="testimonials"
        class="min-h-screen bg-gray-900 text-white flex flex-col items-center justify-center px-6 py-12 fade-in">
        <h2 class="text-4xl font-extrabold mb-8 text-teal-400">Recent Schedules</h2>

        <div class="w-11/12 md:w-2/3 text-center">
            <?php if (!empty($feedbacks)) {
                // Limit feedbacks to 5 recent ones
                $recent_feedbacks = array_slice($feedbacks, 0, 5);
                ?>

                <!-- ✅ Scrollable Feedback Section with Custom Scrollbar -->
                <div
                    class="flex overflow-x-auto space-x-6 p-4 scrollbar-thin scrollbar-thumb-teal-400 scrollbar-track-gray-700 scroll-smooth">
                    <?php foreach ($recent_feedbacks as $feedback) { ?>
                        <div
                            class="flex-none w-80 bg-white text-gray-900 p-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    <?= strtoupper(substr(htmlspecialchars($feedback['name']), 0, 1)); ?>
                                </div>
                                <span
                                    class="ml-3 text-lg font-bold text-teal-600"><?= htmlspecialchars($feedback['name']); ?></span>
                            </div>
                            <p
                                class="text-gray-700 text-sm italic overflow-hidden break-words whitespace-normal h-56 overflow-y-auto">
                                "<?= nl2br(htmlspecialchars($feedback['message'])); ?>"
                            </p>
                        </div>
                    <?php } ?>
                </div>

            <?php } else { ?>
                <p class="text-gray-500">No feedback messages yet.</p>
            <?php } ?>
        </div>
    </section>
    <!-- Font Awesome CDN (add in <head>) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Footer -->
    <footer class="bg-gray-900 text-white text-center py-4">
        <div class="flex justify-center space-x-6 mb-2">
            <!-- Replace # with your actual links later -->
            <a href="https://www.facebook.com/kevin.balocos.3" target="_blank"
                class="text-white hover:text-blue-500 transition">
                <i class="fab fa-facebook fa-lg"></i>
            </a>
            <a href="https://www.instagram.com/jeyduuuuuu/" target="_blank"
                class="text-white hover:text-pink-500 transition">
                <i class="fab fa-instagram fa-lg"></i>
            </a>
            <a href="https://github.com/kevinbalocos" target="_blank" class="text-white hover:text-gray-400 transition">
                <i class="fab fa-github fa-lg"></i>
            </a>
        </div>
        <p>&copy; 2025 DEVELOPED BY JADE KEVIN BALOCOS</p>
    </footer>


    <!-- JavaScript for Smooth Scroll & Animations -->
    <script>


        // Smooth scrolling effect
        document.querySelectorAll(".nav-link").forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                const targetId = this.getAttribute("href").substring(1);
                document.getElementById(targetId).scrollIntoView({ behavior: "smooth" });

                // Apply fade-in animation on scroll
                document.querySelectorAll(".fade-in").forEach(element => {
                    const rect = element.getBoundingClientRect();
                    if (rect.top < window.innerHeight) {
                        element.classList.add("visible");
                    }
                });
            });
        });

        // Apply fade-in effect on page load and scroll
        function fadeInOnScroll() {
            document.querySelectorAll(".fade-in").forEach(element => {
                const rect = element.getBoundingClientRect();
                if (rect.top < window.innerHeight - 50) {
                    element.classList.add("visible");
                }
            });
        }

        window.addEventListener("scroll", fadeInOnScroll);
        document.addEventListener("DOMContentLoaded", fadeInOnScroll);
        document.getElementById("get-features").addEventListener("click", function () {
            // Smooth scroll to features section
            document.getElementById("features").scrollIntoView({ behavior: "smooth" });

            // Apply animation class
            let featuresSection = document.getElementById("features");
            featuresSection.classList.add("scale-90", "opacity-0");

            // Add delay for animation
            setTimeout(() => {
                featuresSection.classList.remove("scale-90", "opacity-0");
                featuresSection.classList.add("scale-100", "opacity-100", "transition-all", "duration-1000");
            }, 500);
        });

    </script>
    <script>
        document.getElementById("menu-toggle").addEventListener("click", function () {
            let menu = document.getElementById("mobile-menu");
            menu.classList.toggle("hidden"); // Show/hide menu
            menu.classList.toggle("animate-slide-in"); // Apply animation
        });

        // Close menu when clicking a link (for mobile users)
        document.querySelectorAll("#mobile-menu a").forEach(link => {
            link.addEventListener("click", function () {
                let menu = document.getElementById("mobile-menu");
                menu.classList.add("hidden"); // Hide menu when clicking a link
            });
        });

    </script>

</body>

</html>