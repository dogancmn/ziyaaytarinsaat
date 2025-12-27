<?php
$pageTitle = "Randevu - Ziya Aytar Yapı İnşaat";
$pageDescription = "Ziya Aytar Yapı İnşaat ile randevu alın. Hayalinizdeki projeyi başlatmak için bizimle iletişime geçin.";
include "includes/header.php";
?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-1 text-white animated slideInDown">Randevu</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Ana Sayfa</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Sayfalar</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Randevu</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Appointment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h4 class="section-title">Randevu</h4>
                    <h1 class="display-5 mb-4">Hayalinizdeki Projeyi Başlatmak İçin Randevu Alın</h1>
                    <p class="mb-4">Projeleriniz için detaylı görüşme yapmak ve size en uygun çözümü sunmak için randevu alabilirsiniz. Uzman ekibimiz sizinle birlikte hayalinizdeki projeyi planlayacak.</p>
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="d-flex">
                                <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-light" style="width: 65px; height: 65px;">
                                    <i class="fa fa-2x fa-phone-alt text-primary"></i>
                                </div>
                                <div class="ms-4">
                                    <p class="mb-2">Bizi Arayın</p>
                                    <h3 class="mb-0">+90 532 670 19 47</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex">
                                <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-light" style="width: 65px; height: 65px;">
                                    <i class="fa fa-2x fa-envelope-open text-primary"></i>
                                </div>
                                <div class="ms-4">
                                    <p class="mb-2">E-posta Gönderin</p>
                                    <h3 class="mb-0">info@ziyaaytarinsaat.com</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <form id="appointmentForm">
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control" id="apptName" placeholder="Adınız" style="height: 55px;" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" class="form-control" id="apptEmail" placeholder="E-posta Adresiniz" style="height: 55px;" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control" id="apptMobile" placeholder="Telefon Numaranız" style="height: 55px;" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <select class="form-select" id="apptService" style="height: 55px;" required>
                                    <option value="" selected>Hizmet Seçiniz</option>
                                    <option value="Mimari Tasarım">Mimari Tasarım</option>
                                    <option value="3D Görselleştirme">3D Görselleştirme</option>
                                    <option value="Konut Planlama">Konut Planlama</option>
                                    <option value="İç Mimari">İç Mimari</option>
                                    <option value="Tadilat">Tadilat</option>
                                    <option value="İnşaat">İnşaat</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="date" id="date" data-target-input="nearest">
                                    <input type="text"
                                        class="form-control datetimepicker-input"
                                        id="apptDate"
                                        placeholder="Tarih Seçiniz" data-target="#date" data-toggle="datetimepicker" style="height: 55px;" required>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="time" id="time" data-target-input="nearest">
                                    <input type="text"
                                        class="form-control datetimepicker-input"
                                        id="apptTime"
                                        placeholder="Saat Seçiniz" data-target="#time" data-toggle="datetimepicker" style="height: 55px;" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" id="apptMessage" rows="5" placeholder="Mesajınız (Opsiyonel)"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Randevu Al</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->

<?php include "includes/footer.php"; ?>
<script src="js/form-handler.js"></script>

