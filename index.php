<?php
require_once 'config.php';

$pageTitle = "Ziya Aytar Yapı İnşaat - Antalya İnşaat Firması";
$pageDescription = "Antalya'da kaliteli inşaat ve yapı hizmetleri. Modern mimari, güvenilir işçilik ve uzman ekibimizle hayalinizdeki projeyi gerçeğe dönüştürüyoruz.";
include "includes/header.php";

// Get projects by city
$cities = ['Antalya', 'İstanbul', 'Mersin'];
$projectsByCity = [];

foreach ($cities as $city) {
    try {
        $stmt = $conn->prepare("SELECT * FROM projects WHERE city = :city AND status = 'published' ORDER BY created_at DESC LIMIT 5");
        $stmt->bindParam(':city', $city);
        $stmt->execute();
        $projectsByCity[$city] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $projectsByCity[$city] = [];
    }
}

// Get project counts
$projectCounts = [];
foreach ($cities as $city) {
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM projects WHERE city = :city AND status = 'published'");
        $stmt->bindParam(':city', $city);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $projectCounts[$city] = $result['count'];
    } catch (PDOException $e) {
        $projectCounts[$city] = 0;
    }
}
?>

    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative" data-dot="<img src='img/carousel-1.jpg'>">
                <img class="img-fluid" src="img/carousel-1.jpg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-1 text-white animated slideInDown">Kaliteli İnşaat ve Yapı Hizmetleri</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-3">Antalya'da güvenilir inşaat çözümleri. Modern mimari, kaliteli malzeme ve uzman ekibimizle hayalinizdeki projeyi gerçeğe dönüştürüyoruz.</p>
                                <a href="about.html" class="btn btn-primary py-3 px-5 animated slideInLeft">Daha Fazla Bilgi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative" data-dot="<img src='img/carousel-2.jpg'>">
                <img class="img-fluid" src="img/carousel-2.jpg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-1 text-white animated slideInDown">Kaliteli İnşaat ve Yapı Hizmetleri</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-3">Antalya'da güvenilir inşaat çözümleri. Modern mimari, kaliteli malzeme ve uzman ekibimizle hayalinizdeki projeyi gerçeğe dönüştürüyoruz.</p>
                                <a href="about.html" class="btn btn-primary py-3 px-5 animated slideInLeft">Daha Fazla Bilgi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative" data-dot="<img src='img/carousel-3.jpg'>">
                <img class="img-fluid" src="img/carousel-3.jpg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-1 text-white animated slideInDown">Kaliteli İnşaat ve Yapı Hizmetleri</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-3">Antalya'da güvenilir inşaat çözümleri. Modern mimari, kaliteli malzeme ve uzman ekibimizle hayalinizdeki projeyi gerçeğe dönüştürüyoruz.</p>
                                <a href="about.html" class="btn btn-primary py-3 px-5 animated slideInLeft">Daha Fazla Bilgi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Facts Start -->
    <div class="container-xxl py-5">
        <div class="container pt-5">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="fact-item text-center bg-light h-100 p-5 pt-0">
                        <div class="fact-icon">
                            <img src="img/icons/icon-2.png" alt="Icon">
                        </div>
                        <h3 class="mb-3">Tasarım Yaklaşımı</h3>
                        <p class="mb-0">Modern ve fonksiyonel tasarımlarla hayalinizdeki yapıyı gerçeğe dönüştürüyoruz. Her projede özgün çözümler sunuyoruz.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="fact-item text-center bg-light h-100 p-5 pt-0">
                        <div class="fact-icon">
                            <img src="img/icons/icon-3.png" alt="Icon">
                        </div>
                        <h3 class="mb-3">Yenilikçi Çözümler</h3>
                        <p class="mb-0">Sektördeki son teknolojileri kullanarak en kaliteli ve dayanıklı yapıları inşa ediyoruz.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="fact-item text-center bg-light h-100 p-5 pt-0">
                        <div class="fact-icon">
                            <img src="img/icons/icon-4.png" alt="Icon">
                        </div>
                        <h3 class="mb-3">Proje Yönetimi</h3>
                        <p class="mb-0">Profesyonel proje yönetimi ekibimizle zamanında ve bütçe dahilinde teslimat garantisi veriyoruz.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img">
                        <img class="img-fluid" src="img/about-1.jpg" alt="">
                        <img class="img-fluid" src="img/about-2.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h4 class="section-title">Hakkımızda</h4>
                    <h1 class="display-5 mb-4">Hayalinizdeki Yapıyı Gerçeğe Dönüştüren Güvenilir İnşaat Firması</h1>
                    <p>Ziya Aytar Yapı İnşaat olarak Antalya'da kaliteli inşaat hizmetleri sunuyoruz. Modern mimari, dayanıklı malzemeler ve uzman ekibimizle projelerinizi zamanında ve bütçe dahilinde tamamlıyoruz.</p>
                    <p class="mb-4">Müşteri memnuniyetini ön planda tutarak, her projede en yüksek kalite standartlarını uyguluyoruz. İnşaat sektöründeki deneyimimiz ve güvenilirliğimizle fark yaratıyoruz.</p>
                    <div class="d-flex align-items-center mb-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center border border-5 border-primary" style="width: 120px; height: 120px;">
                            <h1 class="display-1 mb-n2" data-toggle="counter-up">15</h1>
                        </div>
                        <div class="ps-4">
                            <h3>Yıllık</h3>
                            <h3>Çalışma</h3>
                            <h3 class="mb-0">Deneyimi</h3>
                        </div>
                    </div>
                    <a class="btn btn-primary py-3 px-5" href="about.html">Daha Fazla Bilgi</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Projects by City Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="section-title">Projelerimiz</h4>
                <h1 class="display-5 mb-4">Şehirlere Göre Projelerimiz</h1>
                <p class="mb-0">Türkiye'nin farklı şehirlerinde gerçekleştirdiğimiz başarılı projelerimizi keşfedin</p>
            </div>

            <!-- Modern City Selector -->
            <div class="modern-city-selector mb-5">
                <div class="city-grid-container">
                    <!-- Antalya -->
                    <div class="city-item active" data-city="antalya" data-target="#antalya">
                        <div class="city-map-wrapper">
                            <div class="city-map-bg"></div>
                            <img src="maps/antalya.svg" alt="Antalya" class="city-map">
                            <div class="city-overlay"></div>
                        </div>
                        <div class="city-content">
                                    <div class="city-info-row">
                                        <div class="city-name-col">
                                            <h3 class="city-title">Antalya</h3>
                                        </div>
                                        <div class="city-projects-col">
                                            <span class="city-number"><?php echo $projectCounts['Antalya']; ?></span>
                                            <span class="city-label">Proje</span>
                                        </div>
                                    </div>
                        </div>
                        <div class="city-indicator"></div>
                    </div>

                    <!-- İstanbul -->
                    <div class="city-item" data-city="istanbul" data-target="#istanbul">
                        <div class="city-map-wrapper">
                            <div class="city-map-bg"></div>
                            <img src="maps/istanbul.svg" alt="İstanbul" class="city-map">
                            <div class="city-overlay"></div>
                        </div>
                        <div class="city-content">
                                    <div class="city-info-row">
                                        <div class="city-name-col">
                                            <h3 class="city-title">İstanbul</h3>
                                        </div>
                                        <div class="city-projects-col">
                                            <span class="city-number"><?php echo $projectCounts['İstanbul']; ?></span>
                                            <span class="city-label">Proje</span>
                                        </div>
                                    </div>
                        </div>
                        <div class="city-indicator"></div>
                    </div>

                    <!-- Mersin -->
                    <div class="city-item" data-city="mersin" data-target="#mersin">
                        <div class="city-map-wrapper">
                            <div class="city-map-bg"></div>
                            <img src="maps/mersin.svg" alt="Mersin" class="city-map">
                            <div class="city-overlay"></div>
                        </div>
                        <div class="city-content">
                                    <div class="city-info-row">
                                        <div class="city-name-col">
                                            <h3 class="city-title">Mersin</h3>
                                        </div>
                                        <div class="city-projects-col">
                                            <span class="city-number"><?php echo $projectCounts['Mersin']; ?></span>
                                            <span class="city-label">Proje</span>
                                        </div>
                                    </div>
                        </div>
                        <div class="city-indicator"></div>
                    </div>
                </div>
            </div>

            <!-- City Content Tabs -->
            <div class="tab-content" id="cityTabsContent">
                <!-- Antalya Projects -->
                <div class="tab-pane fade show active" id="antalya" role="tabpanel">
                    <div class="row g-4">
                        <?php if (empty($projectsByCity['Antalya'])): ?>
                            <div class="col-12">
                                <p class="text-center text-muted py-5">Henüz proje eklenmemiş.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($projectsByCity['Antalya'] as $index => $project): ?>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo ($index % 3 + 1) * 0.1; ?>s">
                                <div class="project-item position-relative overflow-hidden">
                                    <?php if ($project['image']): ?>
                                    <img class="img-fluid w-100" src="<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" style="height: 300px; object-fit: cover;">
                                    <?php else: ?>
                                    <div style="height: 300px; background: #e9ecef; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                    <?php endif; ?>
                                    <div class="project-overlay">
                                        <div class="project-content">
                                            <h4 class="text-white mb-2"><?php echo htmlspecialchars($project['title']); ?></h4>
                                            <p class="text-white mb-3"><?php echo htmlspecialchars($project['city']); ?></p>
                                            <a href="project-detail.php?slug=<?php echo htmlspecialchars($project['slug']); ?>" class="btn btn-primary btn-sm">Detayları Gör</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- İstanbul Projects -->
                <div class="tab-pane fade" id="istanbul" role="tabpanel">
                    <div class="row g-4">
                        <?php if (empty($projectsByCity['İstanbul'])): ?>
                            <div class="col-12">
                                <p class="text-center text-muted py-5">Henüz proje eklenmemiş.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($projectsByCity['İstanbul'] as $index => $project): ?>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo ($index % 3 + 1) * 0.1; ?>s">
                                <div class="project-item position-relative overflow-hidden">
                                    <?php if ($project['image']): ?>
                                    <img class="img-fluid w-100" src="<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" style="height: 300px; object-fit: cover;">
                                    <?php else: ?>
                                    <div style="height: 300px; background: #e9ecef; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                    <?php endif; ?>
                                    <div class="project-overlay">
                                        <div class="project-content">
                                            <h4 class="text-white mb-2"><?php echo htmlspecialchars($project['title']); ?></h4>
                                            <p class="text-white mb-3"><?php echo htmlspecialchars($project['city']); ?></p>
                                            <a href="project-detail.php?slug=<?php echo htmlspecialchars($project['slug']); ?>" class="btn btn-primary btn-sm">Detayları Gör</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Mersin Projects -->
                <div class="tab-pane fade" id="mersin" role="tabpanel">
                    <div class="row g-4">
                        <?php if (empty($projectsByCity['Mersin'])): ?>
                            <div class="col-12">
                                <p class="text-center text-muted py-5">Henüz proje eklenmemiş.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($projectsByCity['Mersin'] as $index => $project): ?>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo ($index % 3 + 1) * 0.1; ?>s">
                                <div class="project-item position-relative overflow-hidden">
                                    <?php if ($project['image']): ?>
                                    <img class="img-fluid w-100" src="<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" style="height: 300px; object-fit: cover;">
                                    <?php else: ?>
                                    <div style="height: 300px; background: #e9ecef; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                    <?php endif; ?>
                                    <div class="project-overlay">
                                        <div class="project-content">
                                            <h4 class="text-white mb-2"><?php echo htmlspecialchars($project['title']); ?></h4>
                                            <p class="text-white mb-3"><?php echo htmlspecialchars($project['city']); ?></p>
                                            <a href="project-detail.php?slug=<?php echo htmlspecialchars($project['slug']); ?>" class="btn btn-primary btn-sm">Detayları Gör</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Projects by City End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="section-title">Hizmetlerimiz</h4>
                <h1 class="display-5 mb-4">Modern İnşaat ve Yapı Hizmetleri</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item d-flex position-relative text-center h-100">
                        <img class="bg-img" src="img/service-1.jpg" alt="">
                        <div class="service-text p-5">
                            <img class="mb-4" src="img/icons/icon-5.png" alt="Icon">
                            <h3 class="mb-3">Mimari Tasarım</h3>
                            <p class="mb-4">Modern ve fonksiyonel mimari tasarımlarla hayalinizdeki yapıyı planlıyoruz.</p>
                            <a class="btn" href="service.html"><i class="fa fa-plus text-primary me-3"></i>Detaylar</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item d-flex position-relative text-center h-100">
                        <img class="bg-img" src="img/service-2.jpg" alt="">
                        <div class="service-text p-5">
                            <img class="mb-4" src="img/icons/icon-6.png" alt="Icon">
                            <h3 class="mb-3">3D Görselleştirme</h3>
                            <p class="mb-4">Projelerinizi 3D olarak görselleştirerek hayalinizdeki sonucu önceden görebilirsiniz.</p>
                            <a class="btn" href="service.html"><i class="fa fa-plus text-primary me-3"></i>Detaylar</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item d-flex position-relative text-center h-100">
                        <img class="bg-img" src="img/service-3.jpg" alt="">
                        <div class="service-text p-5">
                            <img class="mb-4" src="img/icons/icon-7.png" alt="Icon">
                            <h3 class="mb-3">Konut Planlama</h3>
                            <p class="mb-4">Villa, daire ve konut projeleriniz için detaylı planlama ve tasarım hizmeti.</p>
                            <a class="btn" href="service.html"><i class="fa fa-plus text-primary me-3"></i>Detaylar</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item d-flex position-relative text-center h-100">
                        <img class="bg-img" src="img/service-4.jpg" alt="">
                        <div class="service-text p-5">
                            <img class="mb-4" src="img/icons/icon-8.png" alt="Icon">
                            <h3 class="mb-3">İç Mimari</h3>
                            <p class="mb-4">Modern ve şık iç mekan tasarımlarıyla yaşam alanlarınızı güzelleştiriyoruz.</p>
                            <a class="btn" href="service.html"><i class="fa fa-plus text-primary me-3"></i>Detaylar</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item d-flex position-relative text-center h-100">
                        <img class="bg-img" src="img/service-5.jpg" alt="">
                        <div class="service-text p-5">
                            <img class="mb-4" src="img/icons/icon-9.png" alt="Icon">
                            <h3 class="mb-3">Tadilat</h3>
                            <p class="mb-4">Eski yapılarınızı modern standartlara uygun şekilde yeniliyoruz.</p>
                            <a class="btn" href="service.html"><i class="fa fa-plus text-primary me-3"></i>Detaylar</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item d-flex position-relative text-center h-100">
                        <img class="bg-img" src="img/service-6.jpg" alt="">
                        <div class="service-text p-5">
                            <img class="mb-4" src="img/icons/icon-10.png" alt="Icon">
                            <h3 class="mb-3">İnşaat</h3>
                            <p class="mb-4">Kaliteli malzeme ve uzman ekibimizle güvenilir inşaat hizmetleri sunuyoruz.</p>
                            <a class="btn" href="service.html"><i class="fa fa-plus text-primary me-3"></i>Detaylar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Feature Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h4 class="section-title">Neden Bizi Seçmelisiniz!</h4>
                    <h1 class="display-5 mb-4">Neden Bize Güvenmelisiniz? Hakkımızda Daha Fazla Bilgi Edinin!</h1>
                    <p class="mb-4">15 yıllık deneyimimiz, kaliteli işçiliğimiz ve müşteri memnuniyeti odaklı yaklaşımımızla Antalya'da güvenilir inşaat hizmetleri sunuyoruz. Her projede en yüksek kalite standartlarını uyguluyoruz.</p>
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="d-flex align-items-start">
                                <img class="flex-shrink-0" src="img/icons/icon-2.png" alt="Icon">
                                <div class="ms-4">
                                    <h3>Tasarım Yaklaşımı</h3>
                                    <p class="mb-0">Modern ve fonksiyonel tasarımlarla her projede özgün çözümler sunuyoruz.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-start">
                                <img class="flex-shrink-0" src="img/icons/icon-3.png" alt="Icon">
                                <div class="ms-4">
                                    <h3>Yenilikçi Çözümler</h3>
                                    <p class="mb-0">Sektördeki son teknolojileri kullanarak en kaliteli ve dayanıklı yapıları inşa ediyoruz.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-start">
                                <img class="flex-shrink-0" src="img/icons/icon-4.png" alt="Icon">
                                <div class="ms-4">
                                    <h3>Proje Yönetimi</h3>
                                    <p class="mb-0">Profesyonel proje yönetimi ekibimizle zamanında ve bütçe dahilinde teslimat garantisi veriyoruz.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="feature-img">
                        <img class="img-fluid" src="img/about-2.jpg" alt="">
                        <img class="img-fluid" src="img/about-1.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- Project Start -->
    <div class="container-xxl project py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="section-title">Projelerimiz</h4>
                <h1 class="display-5 mb-4">Son Projelerimizi ve Yenilikçi Çalışmalarımızı İnceleyin</h1>
            </div>
            <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-4">
                    <div class="nav nav-pills d-flex justify-content-between w-100 h-100 me-4">
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 active" data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                            <h3 class="m-0">01. Modern Konut Kompleksi</h3>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                            <h3 class="m-0">02. Villa Projesi</h3>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                            <h3 class="m-0">03. Ticari Bina</h3>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-0" data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                            <h3 class="m-0">04. Tadilat Projesi</h3>
                        </button>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content w-100">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="img/project-1.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="mb-3">İnşaat Sektöründe 15 Yıllık Deneyim</h1>
                                    <p class="mb-4">Antalya'da gerçekleştirdiğimiz başarılı projelerle sektörde öncü konumdayız. Modern teknoloji, kaliteli malzeme ve uzman ekibimizle her projede mükemmellik hedefliyoruz.</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Tasarım Yaklaşımı</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Yenilikçi Çözümler</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Proje Yönetimi</p>
                                    <a href="project.html" class="btn btn-primary py-3 px-5 mt-3">Daha Fazla Bilgi</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="img/project-2.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="mb-3">İnşaat Sektöründe 15 Yıllık Deneyim</h1>
                                    <p class="mb-4">Antalya'da gerçekleştirdiğimiz başarılı projelerle sektörde öncü konumdayız. Modern teknoloji, kaliteli malzeme ve uzman ekibimizle her projede mükemmellik hedefliyoruz.</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Tasarım Yaklaşımı</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Yenilikçi Çözümler</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Proje Yönetimi</p>
                                    <a href="project.html" class="btn btn-primary py-3 px-5 mt-3">Daha Fazla Bilgi</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="img/project-3.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="mb-3">İnşaat Sektöründe 15 Yıllık Deneyim</h1>
                                    <p class="mb-4">Antalya'da gerçekleştirdiğimiz başarılı projelerle sektörde öncü konumdayız. Modern teknoloji, kaliteli malzeme ve uzman ekibimizle her projede mükemmellik hedefliyoruz.</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Tasarım Yaklaşımı</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Yenilikçi Çözümler</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Proje Yönetimi</p>
                                    <a href="project.html" class="btn btn-primary py-3 px-5 mt-3">Daha Fazla Bilgi</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-4">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="img/project-4.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="mb-3">İnşaat Sektöründe 15 Yıllık Deneyim</h1>
                                    <p class="mb-4">Antalya'da gerçekleştirdiğimiz başarılı projelerle sektörde öncü konumdayız. Modern teknoloji, kaliteli malzeme ve uzman ekibimizle her projede mükemmellik hedefliyoruz.</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Tasarım Yaklaşımı</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Yenilikçi Çözümler</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Proje Yönetimi</p>
                                    <a href="project.html" class="btn btn-primary py-3 px-5 mt-3">Daha Fazla Bilgi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Project End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="section-title">Ekibimiz</h4>
                <h1 class="display-5 mb-4">Hayalinizdeki Yapı İçin Yaratıcı İnşaat Ekibimiz</h1>
            </div>
            <div class="row g-0 team-items">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/team-1.jpg" alt="">
                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2">Ekip Üyesi</h3>
                            <span class="text-primary">Pozisyon</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/team-2.jpg" alt="">
                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2">Ekip Üyesi</h3>
                            <span class="text-primary">Pozisyon</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/team-3.jpg" alt="">
                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2">Ekip Üyesi</h3>
                            <span class="text-primary">Pozisyon</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/team-4.jpg" alt="">
                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2">Ekip Üyesi</h3>
                            <span class="text-primary">Pozisyon</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Appointment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h4 class="section-title">Randevu</h4>
                    <h1 class="display-5 mb-4">Hayalinizdeki Projeyi Başlatmak İçin Randevu Alın</h1>
                    <p class="mb-4">Projeleriniz için ücretsiz keşif ve danışmanlık hizmeti sunuyoruz. Randevu alarak uzman ekibimizle tanışın ve hayalinizdeki yapıyı birlikte planlayalım.</p>
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
                                    <i class="fa fa-2x fa-map-marker-alt text-primary"></i>
                                </div>
                                <div class="ms-4">
                                    <p class="mb-2">Adresimiz</p>
                                    <h3 class="mb-0">Memurevleri, Muratpaşa/Antalya</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <input type="text" class="form-control" placeholder="Your Name" style="height: 55px;">
                        </div>
                        <div class="col-12 col-sm-6">
                            <input type="email" class="form-control" placeholder="Your Email" style="height: 55px;">
                        </div>
                        <div class="col-12 col-sm-6">
                            <input type="text" class="form-control" placeholder="Your Mobile" style="height: 55px;">
                        </div>
                        <div class="col-12 col-sm-6">
                            <select class="form-select" style="height: 55px;">
                                <option selected>Choose Service</option>
                                <option value="1">Service 1</option>
                                <option value="2">Service 2</option>
                                <option value="3">Service 3</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="date" id="date" data-target-input="nearest">
                                <input type="text"
                                    class="form-control datetimepicker-input"
                                    placeholder="Choose Date" data-target="#date" data-toggle="datetimepicker" style="height: 55px;">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="time" id="time" data-target-input="nearest">
                                <input type="text"
                                    class="form-control datetimepicker-input"
                                    placeholder="Choose Date" data-target="#time" data-toggle="datetimepicker" style="height: 55px;">
                            </div>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" rows="5" placeholder="Message"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Book Appointment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="section-title">Referanslar</h4>
                <h1 class="display-5 mb-4">Bize Güvenen ve Hizmetlerimizden Memnun Kalan Müşterilerimiz</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src='img/testimonial-1.jpg' alt=''>">
                    <p class="fs-5">Ziya Aytar Yapı İnşaat ile çalışmak harika bir deneyimdi. Profesyonel ekibi, kaliteli işçiliği ve zamanında teslimatı ile çok memnun kaldık. Kesinlikle tavsiye ederim.</p>
                    <h3>Müşteri Adı</h3>
                    <span class="text-primary">Meslek</span>
                </div>
                <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src='img/testimonial-2.jpg' alt=''>">
                    <p class="fs-5">Ziya Aytar Yapı İnşaat ile çalışmak harika bir deneyimdi. Profesyonel ekibi, kaliteli işçiliği ve zamanında teslimatı ile çok memnun kaldık. Kesinlikle tavsiye ederim.</p>
                    <h3>Müşteri Adı</h3>
                    <span class="text-primary">Meslek</span>
                </div>
                <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src='img/testimonial-3.jpg' alt=''>">
                    <p class="fs-5">Ziya Aytar Yapı İnşaat ile çalışmak harika bir deneyimdi. Profesyonel ekibi, kaliteli işçiliği ve zamanında teslimatı ile çok memnun kaldık. Kesinlikle tavsiye ederim.</p>
                    <h3>Müşteri Adı</h3>
                    <span class="text-primary">Meslek</span>
                </div>
            </div>      
        </div>
    </div>
    <!-- Testimonial End -->

<?php include "includes/footer.php"; ?>
