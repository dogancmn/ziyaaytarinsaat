<?php
$pageTitle = "404 - Sayfa Bulunamadı";
$pageDescription = "Aradığınız sayfa bulunamadı. Ana sayfaya dönebilir veya arama yapabilirsiniz.";
include "includes/header.php";
?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-1 text-white animated slideInDown">404 Hata</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Ana Sayfa</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Sayfalar</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">404 Hata</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- 404 Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                    <h1 class="display-1">404</h1>
                    <h1 class="mb-4">Sayfa Bulunamadı</h1>
                    <p class="mb-4">Üzgünüz, aradığınız sayfa sitemizde bulunmuyor! Ana sayfaya dönebilir veya arama yapabilirsiniz.</p>
                    <a class="btn btn-primary py-3 px-5" href="index.php">Ana Sayfaya Dön</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 404 End -->

<?php include "includes/footer.php"; ?>

