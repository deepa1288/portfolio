<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Portfolio - Rejish </title>
    <meta content="Professional Web Developer Portfolio" name="description">
    <meta content="web development, frontend, backend, full stack" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.jpeg" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/typed.js/typed.umd.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <script>
        document.querySelector('.header-toggle').addEventListener('click', () => {
            document.querySelector('#header').classList.toggle('active');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('#header') && !e.target.closest('.header-toggle')) {
                document.querySelector('#header').classList.remove('active');
            }
        });

        // Close mobile menu when clicking on a nav link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                document.querySelector('#header').classList.remove('active');
            });
        });
    </script>
</head>

<body>
    <header id="header" class="header">
        <i class="header-toggle d-lg-none bi bi-list"></i>
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="nav-link active"><i class="bi bi-house"></i><span>Home</span></a></li>
                <li><a href="#about" class="nav-link"><i class="bi bi-person"></i><span>About</span></a></li>
                <li><a href="#resume" class="nav-link"><i class="bi bi-file-earmark-text"></i><span>Resume</span></a></li>
                <li><a href="#portfolio" class="nav-link"><i class="bi bi-images"></i><span>Portfolio</span></a></li>
                <li><a href="#services" class="nav-link"><i class="bi bi-hdd-stack"></i><span>Services</span></a></li>
                <li><a href="#contact" class="nav-link"><i class="bi bi-envelope"></i><span>Contact</span></a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Starter Page</li>
                    </ol>
                </nav>
                <h1>Starter Page</h1>
            </div>
        </div>

        <!-- Starter Section Section -->
        <section id="starter-section" class="starter-section section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Starter Section</h2>
                <p>Welcome to my portfolio website</p>
            </div>

            <div class="container" data-aos="fade-up">
                <p>Use this page as a starter for your own custom pages.</p>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                once: true,
                mirror: false,
                disable: 'mobile'
            });
        });
    </script>
</body>
</html>