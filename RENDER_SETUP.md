# Render.com Deployment Rehberi

## Adım Adım Kurulum

### 1. Render.com'da Yeni Web Service Oluşturun

1. https://render.com adresine gidin ve giriş yapın
2. "New +" butonuna tıklayın
3. "Web Service" seçin
4. GitHub repository'nizi bağlayın

### 2. Ayarları Yapılandırın

**Temel Ayarlar:**
- **Name:** ziyaaytarinsaat (veya istediğiniz isim)
- **Environment:** `PHP`
- **Region:** En yakın bölgeyi seçin (Avrupa için `Frankfurt`)

**Build & Deploy Ayarları:**
- **Build Command:** (BOŞ BIRAKIN - hiçbir şey yazmayın)
- **Start Command:** `php -S 0.0.0.0:$PORT -t .`

**ÖNEMLİ:** Build Command'ı tamamen boş bırakın. Render PHP için otomatik build yapar.

### 3. Environment Variables Ekleyin

"Environment" sekmesine gidin ve şu değişkenleri ekleyin:

```
DB_HOST=your-db-host
DB_NAME=your-db-name
DB_USER=your-db-user
DB_PASSWORD=your-db-password
```

### 4. MySQL Veritabanı Oluşturun

1. Render dashboard'da "New +" > "PostgreSQL" veya "MySQL" seçin
2. (Not: Render'da MySQL ücretsiz değil, PostgreSQL ücretsiz)
3. Veritabanı bilgilerini not edin
4. Environment variables'ları web service'e ekleyin

### 5. Veritabanını Hazırlayın

1. Render'da veritabanı servisinize gidin
2. "Connect" butonuna tıklayın
3. "psql" veya MySQL client ile bağlanın
4. `database.sql` dosyasındaki komutları çalıştırın

**PostgreSQL için (Render'ın ücretsiz seçeneği):**

Eğer PostgreSQL kullanıyorsanız, `database.sql` dosyasını PostgreSQL syntax'ına çevirmeniz gerekir. Alternatif olarak, `database_postgresql.sql` dosyasını kullanabilirsiniz.

### 6. Deploy

1. "Create Web Service" butonuna tıklayın
2. Render otomatik olarak deploy edecek
3. Domain adresiniz hazır olacak (örn: `ziyaaytarinsaat.onrender.com`)

## Sorun Giderme

### Build Hatası (Status 1)

**Sorun:** Build komutu hata veriyor

**Çözüm:**
- Build Command'ı **tamamen boş** bırakın
- Start Command'ın doğru olduğundan emin olun: `php -S 0.0.0.0:$PORT -t .`

### Database Connection Hatası

**Sorun:** Veritabanına bağlanamıyor

**Çözüm:**
1. Environment variables'ları kontrol edin
2. Veritabanı servisinin çalıştığından emin olun
3. `config.php` dosyasının environment variables'ları okuduğundan emin olun

### 404 Hatası

**Sorun:** Sayfalar bulunamıyor

**Çözüm:**
- Start Command'ın doğru olduğundan emin olun
- `.htaccess` dosyasının mevcut olduğundan emin olun (Apache için)

### PHP Version Hatası

**Sorun:** PHP versiyonu uyumsuz

**Çözüm:**
- Render otomatik olarak PHP 8.x kullanır
- Kodunuzun PHP 7.4+ ile uyumlu olduğundan emin olun

## Önemli Notlar

1. **Build Command:** PHP için build komutu gerekmez, boş bırakın
2. **Start Command:** Mutlaka `php -S 0.0.0.0:$PORT -t .` olmalı
3. **Environment Variables:** Veritabanı bilgilerini environment variables olarak ekleyin
4. **Free Tier:** Render'ın ücretsiz tier'ı 15 dakika inaktiflikten sonra uyku moduna geçer
5. **PostgreSQL:** Render'da ücretsiz MySQL yok, PostgreSQL kullanmanız gerekebilir

## PostgreSQL için Database Schema

Eğer PostgreSQL kullanıyorsanız, `database.sql` yerine şunu kullanın:

```sql
CREATE TABLE IF NOT EXISTS contacts (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS appointments (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mobile VARCHAR(20),
    service VARCHAR(100),
    appointment_date TIMESTAMP,
    appointment_time TIME,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

Ve `config.php` dosyasını PostgreSQL için güncelleyin:

```php
$conn = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
```

