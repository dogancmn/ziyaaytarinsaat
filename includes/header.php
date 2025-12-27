<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Ziya Aytar Yapı İnşaat - Antalya İnşaat Firması'; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Ziya Aytar Yapı İnşaat, Antalya inşaat firması, yapı, inşaat, tadilat, mimari tasarım" name="keywords">
    <meta content="<?php echo isset($pageDescription) ? $pageDescription : 'Antalya\'da kaliteli inşaat ve yapı hizmetleri. Modern mimari, güvenilir işçilik ve uzman ekibimizle hayalinizdeki projeyi gerçeğe dönüştürüyoruz.'; ?>" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Teko:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border position-relative text-primary" style="width: 6rem; height: 6rem;" role="status"></div>
        <svg class="position-absolute top-50 start-50 translate-middle" width="60" height="60" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" style="margin-top: -30px; margin-left: -30px;">
            <!-- Sol yan kanat - 3 trapezoid -->
            <polygon points="3,48 3,38 6,33 6,43" fill="#113940" stroke="#D0D0D0" stroke-width="0.3"/>
            <polygon points="6,43 6,33 9,28 9,38" fill="#113940" stroke="#D0D0D0" stroke-width="0.3"/>
            <polygon points="9,38 9,28 12,23 12,33" fill="#113940" stroke="#D0D0D0" stroke-width="0.3"/>
            
            <!-- Sağ yan kanat - 3 trapezoid -->
            <polygon points="47,48 47,38 44,33 44,43" fill="#113940" stroke="#D0D0D0" stroke-width="0.3"/>
            <polygon points="44,43 44,33 41,28 41,38" fill="#113940" stroke="#D0D0D0" stroke-width="0.3"/>
            <polygon points="41,38 41,28 38,23 38,33" fill="#113940" stroke="#D0D0D0" stroke-width="0.3"/>
            
            <!-- Merkezi sütun - üst açık gri üçgen -->
            <polygon points="22,3 28,3 25,12" fill="#E8E8E8" stroke="#CCCCCC" stroke-width="0.3"/>
            
            <!-- Merkezi sütun - siyah trapezoidler (3 adet) -->
            <polygon points="20,12 30,12 28,20 22,20" fill="#252525" stroke="#1a1a1a" stroke-width="0.3"/>
            <polygon points="21,20 29,20 27,28 23,28" fill="#252525" stroke="#1a1a1a" stroke-width="0.3"/>
            <polygon points="22,28 28,28 26,35 24,35" fill="#252525" stroke="#1a1a1a" stroke-width="0.3"/>
            
            <!-- Merkezi sütun - alt açık gri üçgen -->
            <polygon points="24,35 26,35 25,42" fill="#E8E8E8" stroke="#CCCCCC" stroke-width="0.3"/>
        </svg>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark p-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-3">
                    <a class="text-body px-2" href="tel:+905326701947"><i class="fa fa-phone-alt text-primary me-2"></i>+90 532 670 19 47</a>
                    <a class="text-body px-2" href=""><i class="fa fa-map-marker-alt text-primary me-2"></i>Memurevleri, 07050 Muratpaşa/Antalya</a>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-2">
                    <a class="text-body px-2" href="">Şartlar</a>
                    <a class="text-body px-2" href="">Gizlilik</a>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square btn-outline-body me-1" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square btn-outline-body me-1" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square btn-outline-body me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square btn-outline-body me-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="text-primary m-0 d-flex align-items-center">
                <svg class="me-3" width="50" height="50" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                    <!-- Sol yan kanat - 3 trapezoid -->
                    <polygon points="3,48 3,38 6,33 6,43" fill="#113940" stroke="#D0D0D0" stroke-width="0.3"/>
                    <polygon points="6,43 6,33 9,28 9,38" fill="#113940" stroke="#D0D0D0" stroke-width="0.3"/>
                    <polygon points="9,38 9,28 12,23 12,33" fill="#113940" stroke="#D0D0D0" stroke-width="0.3"/>
                    
                    <!-- Sağ yan kanat - 3 trapezoid -->
                    <polygon points="47,48 47,38 44,33 44,43" fill="#113940" stroke="#D0D0D0" stroke-width="0.3"/>
                    <polygon points="44,43 44,33 41,28 41,38" fill="#113940" stroke="#D0D0D0" stroke-width="0.3"/>
                    <polygon points="41,38 41,28 38,23 38,33" fill="#113940" stroke="#D0D0D0" stroke-width="0.3"/>
                    
                    <!-- Merkezi sütun - üst açık gri üçgen -->
                    <polygon points="22,3 28,3 25,12" fill="#E8E8E8" stroke="#CCCCCC" stroke-width="0.3"/>
                    
                    <!-- Merkezi sütun - siyah trapezoidler (3 adet) -->
                    <polygon points="20,12 30,12 28,20 22,20" fill="#252525" stroke="#1a1a1a" stroke-width="0.3"/>
                    <polygon points="21,20 29,20 27,28 23,28" fill="#252525" stroke="#1a1a1a" stroke-width="0.3"/>
                    <polygon points="22,28 28,28 26,35 24,35" fill="#252525" stroke="#1a1a1a" stroke-width="0.3"/>
                    
                    <!-- Merkezi sütun - alt açık gri üçgen -->
                    <polygon points="24,35 26,35 25,42" fill="#E8E8E8" stroke="#CCCCCC" stroke-width="0.3"/>
                </svg>
                <span class="text-uppercase">Ziya Aytar Yapı İnşaat</span>
            </h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">Ana Sayfa</a>
                <a href="about.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>">Hakkımızda</a>
                <a href="service.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'service.php') ? 'active' : ''; ?>">Hizmetlerimiz</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Sayfalar</a>
                    <div class="dropdown-menu border-0 m-0">
                        <a href="feature.php" class="dropdown-item">Özelliklerimiz</a>
                        <a href="project.php" class="dropdown-item">Projelerimiz</a>
                        <a href="team.php" class="dropdown-item">Ekibimiz</a>
                        <a href="appointment.php" class="dropdown-item">Randevu</a>
                        <a href="testimonial.php" class="dropdown-item">Referanslar</a>
                        <a href="404.php" class="dropdown-item">404 Sayfası</a>
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>">İletişim</a>
            </div>
            <a href="appointment.php" class="btn btn-primary py-2 px-4 d-none d-lg-block">Randevu Al</a>
        </div>
    </nav>
    <!-- Navbar End -->

