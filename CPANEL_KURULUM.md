# cPanel Kurulum Rehberi - PHP + MySQL

Bu rehber, projeyi cPanel'de nasıl kuracağınızı adım adım anlatır.

## 📋 Adım 1: Dosyaları cPanel'e Yükleme

1. cPanel'e giriş yapın
2. **File Manager** (Dosya Yöneticisi) açın
3. `public_html` klasörüne gidin (veya alt domain kullanıyorsanız ilgili klasöre)
4. Tüm proje dosyalarını buraya yükleyin (FTP veya File Manager üzerinden)

## 📋 Adım 2: Veritabanı Oluşturma

1. cPanel'de **MySQL Databases** (MySQL Veritabanları) bölümüne gidin
2. **Create New Database** (Yeni Veritabanı Oluştur) bölümünde:
   - Veritabanı adı girin (örn: `ziyaaytar_insaat`)
   - **Create Database** butonuna tıklayın
3. **MySQL Users** (MySQL Kullanıcıları) bölümünde:
   - Yeni kullanıcı adı ve şifre oluşturun
   - **Create User** butonuna tıklayın
4. **Add User To Database** (Kullanıcıyı Veritabanına Ekle) bölümünde:
   - Kullanıcıyı ve veritabanını seçin
   - **ALL PRIVILEGES** (Tüm İzinler) seçeneğini işaretleyin
   - **Make Changes** butonuna tıklayın

## 📋 Adım 3: SQL Tablolarını Oluşturma

1. cPanel'de **phpMyAdmin** açın
2. Sol taraftan oluşturduğunuz veritabanını seçin
3. Üst menüden **SQL** sekmesine tıklayın
4. `database.sql` dosyasının içeriğini kopyalayıp yapıştırın
5. **Go** (Git) butonuna tıklayın
6. Tablolar başarıyla oluşturulmalı (`contacts` ve `appointments`)

## 📋 Adım 4: Veritabanı Bağlantı Bilgilerini Güncelleme

1. `config.php` dosyasını açın
2. cPanel'den aldığınız bilgileri güncelleyin:

```php
define('DB_HOST', 'localhost'); // Genellikle localhost
define('DB_USER', 'cpanel_kullanici_adi_veritabani_kullanici'); // cPanel kullanıcı adı + veritabanı kullanıcı adı
define('DB_PASS', 'veritabani_sifresi'); // Oluşturduğunuz şifre
define('DB_NAME', 'cpanel_kullanici_adi_veritabani_adi'); // cPanel kullanıcı adı + veritabanı adı
```

**ÖNEMLİ:** cPanel'de veritabanı ve kullanıcı adları genellikle şu formatta olur:
- Veritabanı: `cpanel_kullanici_ziyaaytar_insaat`
- Kullanıcı: `cpanel_kullanici_db_user`

## 📋 Adım 5: Dosya İzinlerini Kontrol Etme

1. File Manager'da `api` klasörüne sağ tıklayın
2. **Change Permissions** (İzinleri Değiştir) seçin
3. Klasör izinlerini **755** yapın
4. PHP dosyalarının izinlerini **644** yapın

## 📋 Adım 6: Test Etme

1. Tarayıcıda sitenizi açın
2. **Contact** sayfasına gidin
3. Formu doldurup gönderin
4. phpMyAdmin'de `contacts` tablosunu kontrol edin - yeni kayıt görünmeli
5. **Appointment** sayfasında da aynı testi yapın

## 🔧 Sorun Giderme

### "Connection refused" veya "Access denied" hatası
- `config.php` dosyasındaki veritabanı bilgilerini kontrol edin
- cPanel'de kullanıcının veritabanına erişim izni olduğundan emin olun

### "Table doesn't exist" hatası
- phpMyAdmin'de SQL dosyasını tekrar çalıştırın
- Tablo isimlerinin doğru olduğundan emin olun

### Form gönderilmiyor
- Tarayıcı konsolunu açın (F12) ve hataları kontrol edin
- `api/contact.php` ve `api/appointment.php` dosyalarının doğru yerde olduğundan emin olun
- PHP versiyonunuzun 7.0 veya üzeri olduğundan emin olun

### Türkçe karakter sorunu
- Veritabanı charset'inin `utf8mb4` olduğundan emin olun
- `config.php` dosyasında `set_charset("utf8mb4")` satırının olduğunu kontrol edin

## 📧 E-posta Bildirimleri (İsteğe Bağlı)

Form gönderildiğinde e-posta bildirimi almak için `api/contact.php` ve `api/appointment.php` dosyalarına `mail()` fonksiyonu ekleyebilirsiniz.

## 🔐 Güvenlik Notları

- `config.php` dosyasını asla public erişime açmayın
- SQL injection koruması için prepared statements kullanılıyor (güvenli)
- Form validasyonu hem frontend hem backend'de yapılıyor
- cPanel'de güvenlik ayarlarını kontrol edin

## ✅ Kurulum Tamamlandı!

Artık siteniz çalışıyor ve formlar veritabanına kaydediliyor. phpMyAdmin üzerinden mesajları ve randevuları görüntüleyebilirsiniz.

