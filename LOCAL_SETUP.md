# Localhost Kurulum Rehberi

Bu projeyi localhost'ta çalıştırmak için adım adım talimatlar.

## 📋 Gereksinimler

- PHP 7.4 veya üzeri
- MySQL/MariaDB
- Web tarayıcısı

## 🛠️ Kurulum Adımları

### 1. PHP Kontrolü

Terminal'de şu komutu çalıştırın:
```bash
php -v
```

PHP 7.4+ görünmeli. Yoksa:
- **macOS:** `brew install php`
- **Windows:** XAMPP veya WAMP kurun
- **Linux:** `sudo apt install php php-mysql` (Ubuntu/Debian)

### 2. MySQL/MariaDB Kurulumu

**macOS (Homebrew):**
```bash
brew install mysql
brew services start mysql
```

**Windows:**
- XAMPP kurun (PHP + MySQL birlikte gelir)

**Linux:**
```bash
sudo apt install mysql-server
sudo systemctl start mysql
```

### 3. Veritabanını Oluşturun

Terminal'de proje klasörüne gidin ve şu komutu çalıştırın:

```bash
mysql -u root -p < database.sql
```

Şifre sorarsa, MySQL root şifrenizi girin (genelde boş bırakılır veya "root").

**Alternatif (Manuel):**

1. MySQL'e bağlanın:
```bash
mysql -u root -p
```

2. SQL komutlarını çalıştırın:
```sql
CREATE DATABASE ziyaaytarinsaat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ziyaaytarinsaat;
```

3. `database.sql` dosyasındaki CREATE TABLE komutlarını çalıştırın.

### 4. Config Dosyasını Kontrol Edin

`config.php` dosyasını açın ve veritabanı bilgilerini kontrol edin:

```php
$db_host = 'localhost';
$db_name = 'ziyaaytarinsaat';
$db_user = 'root';
$db_pass = ''; // Şifreniz varsa buraya yazın
```

**XAMPP kullanıyorsanız:**
- `$db_user = 'root'`
- `$db_pass = ''` (genelde boş)

**MAMP kullanıyorsanız:**
- `$db_user = 'root'`
- `$db_pass = 'root'` (veya MAMP ayarlarınızdaki şifre)

### 5. Server'ı Başlatın

**Yöntem 1: Script ile (Önerilen)**
```bash
./start-local.sh
```

**Yöntem 2: Manuel**
```bash
php -S localhost:8000
```

### 6. Tarayıcıda Açın

Server başladıktan sonra tarayıcınızda şu adresi açın:
```
http://localhost:8000
```

## ✅ Test

1. Ana sayfa açılmalı: `http://localhost:8000`
2. İletişim formu: `http://localhost:8000/contact.php`
3. Randevu formu: `http://localhost:8000/appointment.php`

## 🔧 Sorun Giderme

### "Veritabanı bağlantısı başarısız" hatası

1. MySQL'in çalıştığından emin olun:
```bash
# macOS
brew services list

# Linux
sudo systemctl status mysql
```

2. Veritabanının oluşturulduğunu kontrol edin:
```bash
mysql -u root -p -e "SHOW DATABASES;"
```

3. `config.php` dosyasındaki bilgileri kontrol edin.

### "Port 8000 already in use" hatası

Farklı bir port kullanın:
```bash
php -S localhost:8080
```

### PHP hataları görünmüyor

`config.php` dosyasında hata mesajlarını görmek için:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## 📁 Proje Yapısı

```
├── index.php              # Ana sayfa
├── contact.php            # İletişim sayfası
├── appointment.php        # Randevu sayfası
├── config.php             # Veritabanı yapılandırması
├── database.sql           # Veritabanı şeması
├── api/                   # API endpoints
│   ├── contact.php
│   └── appointment.php
├── includes/              # PHP includes
│   ├── header.php
│   └── footer.php
└── start-local.sh         # Server başlatma scripti
```

## 🎯 Sonraki Adımlar

1. ✅ Veritabanı oluşturuldu
2. ✅ Config dosyası ayarlandı
3. ✅ Server başlatıldı
4. ✅ Tarayıcıda test edildi

Artık localhost'ta geliştirmeye devam edebilirsiniz!

## 💡 İpuçları

- **XAMPP kullanıyorsanız:** `http://localhost/ziyaaytarinsaat` şeklinde erişebilirsiniz
- **MAMP kullanıyorsanız:** `http://localhost:8888/ziyaaytarinsaat` şeklinde erişebilirsiniz
- **VS Code:** PHP Intelephense extension'ını kurun
- **Debugging:** Xdebug kurarak hata ayıklama yapabilirsiniz

