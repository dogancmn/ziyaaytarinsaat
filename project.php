<?php
$pageTitle = "Projelerimiz - Ziya Aytar Yapı İnşaat";
$pageDescription = "Ziya Aytar Yapı İnşaat'ın tamamladığı projeleri keşfedin. Modern mimari ve kaliteli işçilikle gerçekleştirdiğimiz başarılı projelerimiz.";
include "includes/header.php";
?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-1 text-white animated slideInDown">Projelerimiz</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Ana Sayfa</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Sayfalar</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Projelerimiz</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Project Start -->
    <div class="container-xxl project py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="section-title">Projelerimiz</h4>
                <h1 class="display-5 mb-4">Son Projelerimizi ve Yenilikçi Çalışmalarımızı Keşfedin</h1>
            </div>
            <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-4">
                    <div class="nav nav-pills d-flex justify-content-between w-100 h-100 me-4">
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 active" data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                            <h3 class="m-0">01. Modern Kompleks</h3>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                            <h3 class="m-0">02. Lüks Villa</h3>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                            <h3 class="m-0">03. İş Merkezi</h3>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-0" data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                            <h3 class="m-0">04. Alışveriş Merkezi</h3>
                        </button>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content w-100">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="img/project-1.jpg" style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="mb-3">15 Yıllık İnşaat Sektörü Deneyimi</h1>
                                    <p class="mb-4">Modern kompleks projemizde kaliteli malzeme ve uzman ekibimizle başarılı bir şekilde tamamladık. Müşteri memnuniyeti odaklı çalışma prensibimizle projeyi zamanında teslim ettik.</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Tasarım Yaklaşımı</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Yenilikçi Çözümler</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Proje Yönetimi</p>
                                    <a href="contact.php" class="btn btn-primary py-3 px-5 mt-3">Daha Fazla Bilgi</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="img/project-2.jpg" style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="mb-3">Lüks Villa Projesi</h1>
                                    <p class="mb-4">Antalya'da gerçekleştirdiğimiz lüks villa projesi, modern mimari ve şık iç mimari tasarımıyla dikkat çekiyor. Her detayı özenle planlanmış bu proje müşterilerimizin hayallerini gerçeğe dönüştürdü.</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Modern Tasarım</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Kaliteli İşçilik</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Zamanında Teslimat</p>
                                    <a href="contact.php" class="btn btn-primary py-3 px-5 mt-3">Daha Fazla Bilgi</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="img/project-3.jpg" style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="mb-3">İş Merkezi İnşaatı</h1>
                                    <p class="mb-4">Ticari alanda gerçekleştirdiğimiz iş merkezi projesi, fonksiyonel tasarımı ve modern altyapısıyla iş dünyasına hizmet veriyor. Profesyonel proje yönetimi ile başarıyla tamamlandı.</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Fonksiyonel Tasarım</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Modern Altyapı</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Profesyonel Yönetim</p>
                                    <a href="contact.php" class="btn btn-primary py-3 px-5 mt-3">Daha Fazla Bilgi</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-4">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="img/project-4.jpg" style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="mb-3">Alışveriş Merkezi</h1>
                                    <p class="mb-4">Büyük ölçekli alışveriş merkezi projemiz, modern mimari ve kullanıcı dostu tasarımıyla bölgenin önemli ticari merkezlerinden biri haline geldi. Kapsamlı planlama ve uygulama süreci başarıyla tamamlandı.</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Büyük Ölçekli Proje</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Modern Mimari</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Kapsamlı Planlama</p>
                                    <a href="contact.php" class="btn btn-primary py-3 px-5 mt-3">Daha Fazla Bilgi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Project End -->

<?php include "includes/footer.php"; ?>
