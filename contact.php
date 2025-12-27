<?php
$pageTitle = "İletişim - Ziya Aytar Yapı İnşaat";
$pageDescription = "Ziya Aytar Yapı İnşaat ile iletişime geçin. Antalya'da inşaat ve yapı hizmetleri için bize ulaşın.";
include "includes/header.php";
?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-1 text-white animated slideInDown">İletişim</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Ana Sayfa</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Sayfalar</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">İletişim</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="section-title">İletişim</h4>
                <h1 class="display-5 mb-4">Herhangi Bir Sorunuz Varsa, Lütfen Bizimle İletişime Geçmekten Çekinmeyin</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <div class="bg-light d-flex align-items-center w-100 p-4 mb-4">
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-dark" style="width: 55px; height: 55px;">
                                <i class="fa fa-map-marker-alt text-primary"></i>
                            </div>
                            <div class="ms-4">
                                <p class="mb-2">Adres</p>
                                <h3 class="mb-0">Memurevleri, 07050 Muratpaşa/Antalya</h3>
                            </div>
                        </div>
                        <div class="bg-light d-flex align-items-center w-100 p-4 mb-4">
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-dark" style="width: 55px; height: 55px;">
                                <i class="fa fa-phone-alt text-primary"></i>
                            </div>
                            <div class="ms-4">
                                <p class="mb-2">Bizi Arayın</p>
                                <h3 class="mb-0">+90 532 670 19 47</h3>
                            </div>
                        </div>
                        <div class="bg-light d-flex align-items-center w-100 p-4">
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-dark" style="width: 55px; height: 55px;">
                                <i class="fa fa-envelope-open text-primary"></i>
                            </div>
                            <div class="ms-4">
                                <p class="mb-2">E-posta Gönderin</p>
                                <h3 class="mb-0">info@ziyaaytarinsaat.com</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <p class="mb-4">Bize ulaşmak için aşağıdaki formu doldurun. En kısa sürede size geri dönüş yapacağız.</p>
                    <form id="contactForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Adınız" required>
                                    <label for="name">Adınız</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="E-posta Adresiniz" required>
                                    <label for="email">E-posta Adresiniz</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Konu">
                                    <label for="subject">Konu</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Mesajınızı buraya yazın" id="message" style="height: 100px" required></textarea>
                                    <label for="message">Mesajınız</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Mesaj Gönder</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Google Map Start -->
    <div class="container-xxl pt-5 px-0 wow fadeIn" data-wow-delay="0.1s">
        <iframe class="w-100 mb-n2" style="height: 450px;"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12770.123456789!2d30.7123456!3d36.8765432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzYsIDMw!5e0!3m2!1str!2str!4v1234567890123!5m2!1str!2str"
            frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <!-- Google Map End -->

<?php include "includes/footer.php"; ?>
<script src="js/form-handler.js"></script>

