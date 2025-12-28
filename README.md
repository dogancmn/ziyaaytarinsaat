# Ziya Aytar Yapı İnşaat - Website

Antalya'da kaliteli inşaat ve yapı hizmetleri sunan firmanın resmi web sitesi.

## 🚀 Özellikler

- Modern ve responsive tasarım
- PHP + MySQL backend
- İletişim formu
- Randevu sistemi
- Türkçe dil desteği

## 📋 Gereksinimler

- PHP 7.4 veya üzeri
- MySQL 5.7 veya üzeri
- Apache/Nginx web sunucusu

## 🛠️ Kurulum

### Yerel Geliştirme

1. Repository'yi klonlayın:
```bash
git clone https://github.com/dogancmn/ziyaaytarinsaat.git
cd ziyaaytarinsaat
```

2. `config.php` dosyasını oluşturun:
```bash
cp config.example.php config.php
```

3. `config.php` dosyasını düzenleyip veritabanı bilgilerinizi girin.

4. Veritabanını oluşturun:
```bash
mysql -u root -p < database.sql
```

5. PHP built-in server ile çalıştırın:
```bash
php -S localhost:8000
```

### Production Deployment

Detaylı deployment talimatları için `DEPLOYMENT.md` dosyasına bakın.

**Önerilen Platformlar:**
- 🚂 [Railway](https://railway.app) - Ücretsiz tier, PHP + MySQL
- 🎨 [Render](https://render.com) - Ücretsiz tier
- 🌐 [000webhost](https://www.000webhost.com) - Tamamen ücretsiz

## 📁 Proje Yapısı

```
├── api/                 # API endpoints
│   ├── contact.php      # İletişim formu API
│   └── appointment.php  # Randevu formu API
├── includes/            # PHP include dosyaları
│   ├── header.php       # Header
│   └── footer.php      # Footer
├── css/                 # Stylesheet dosyaları
├── js/                  # JavaScript dosyaları
│   ├── main.js          # Ana JavaScript
│   └── form-handler.js  # Form handler
├── img/                 # Görseller
├── lib/                 # Kütüphaneler
├── config.php           # Veritabanı yapılandırması (gitignore'da)
├── database.sql         # Veritabanı şeması
└── *.php                # Sayfa dosyaları
```

## 🔧 Yapılandırma

### Environment Variables (Railway/Render)

- `DB_HOST` - Veritabanı host adresi
- `DB_NAME` - Veritabanı adı
- `DB_USER` - Veritabanı kullanıcı adı
- `DB_PASSWORD` - Veritabanı şifresi

## 📝 Notlar

- GitHub Pages PHP desteklemez, bu yüzden Railway/Render gibi platformlar kullanılmalıdır
- `config.php` dosyası `.gitignore`'da olduğu için GitHub'a yüklenmez
- Production'da environment variables kullanın

## 📄 Lisans

Bu proje özel bir projedir.

## 👤 İletişim

Ziya Aytar Yapı İnşaat
- 📍 Memurevleri, 07050 Muratpaşa/Antalya
- 📞 +90 532 670 19 47
- 📧 info@ziyaaytarinsaat.com

