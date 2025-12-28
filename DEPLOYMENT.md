# Deployment Guide - PHP + MySQL

Bu proje PHP ve MySQL kullanıyor. GitHub Pages PHP desteklemediği için aşağıdaki platformlardan birini kullanmanız gerekiyor.

## Seçenek 1: Railway (Önerilen - Ücretsiz)

### Adımlar:

1. **Railway hesabı oluşturun:**
   - https://railway.app adresine gidin
   - GitHub hesabınızla giriş yapın

2. **Yeni proje oluşturun:**
   - "New Project" butonuna tıklayın
   - "Deploy from GitHub repo" seçin
   - Bu repository'yi seçin

3. **MySQL veritabanı ekleyin:**
   - "New" butonuna tıklayın
   - "Database" > "Add MySQL" seçin
   - Veritabanı otomatik oluşturulacak

4. **Environment Variables ayarlayın:**
   - Proje ayarlarına gidin
   - "Variables" sekmesine tıklayın
   - MySQL servisinden şu değişkenleri ekleyin:
     - `DB_HOST` → MySQL servisinin host adresi
     - `DB_NAME` → Veritabanı adı (genelde `railway`)
     - `DB_USER` → Kullanıcı adı
     - `DB_PASSWORD` → Şifre

5. **Veritabanını hazırlayın:**
   - Railway'de MySQL servisine tıklayın
   - "Query" sekmesine gidin
   - `database.sql` dosyasındaki SQL komutlarını çalıştırın

6. **Deploy:**
   - Railway otomatik olarak deploy edecek
   - Domain adresiniz hazır olacak

## Seçenek 2: Render (Ücretsiz)

### Adımlar:

1. **Render hesabı oluşturun:**
   - https://render.com adresine gidin
   - GitHub hesabınızla giriş yapın

2. **Yeni Web Service oluşturun:**
   - "New +" > "Web Service" seçin
   - GitHub repository'nizi bağlayın
   - Ayarlar:
     - **Environment:** PHP
     - **Build Command:** (boş bırakın)
     - **Start Command:** `php -S 0.0.0.0:$PORT -t .`

3. **MySQL veritabanı ekleyin:**
   - "New +" > "PostgreSQL" veya "MySQL" seçin
   - (Not: Render'da MySQL ücretsiz değil, PostgreSQL ücretsiz)

4. **Environment Variables:**
   - Web Service ayarlarında "Environment" sekmesine gidin
   - Veritabanı bilgilerini ekleyin

5. **Deploy:**
   - Render otomatik deploy edecek

## Seçenek 3: 000webhost (Tamamen Ücretsiz)

1. https://www.000webhost.com adresine gidin
2. Ücretsiz hesap oluşturun
3. PHP ve MySQL otomatik olarak hazır
4. Dosyaları FTP ile yükleyin veya File Manager kullanın
5. `config.php` dosyasını düzenleyin

## Yerel Geliştirme

Yerel olarak test etmek için:

```bash
# PHP built-in server kullanarak
php -S localhost:8000

# Veya XAMPP/MAMP kullanın
```

## Önemli Notlar

- `config.php` dosyası `.gitignore`'da olduğu için GitHub'a yüklenmez
- Production'da environment variables kullanın
- Veritabanı şifrelerini asla kod içine yazmayın
- Railway ve Render otomatik HTTPS sağlar

## Sorun Giderme

- **Database connection hatası:** Environment variables'ları kontrol edin
- **404 hatası:** `.htaccess` dosyası gerekebilir (Apache için)
- **PHP hatası:** PHP versiyonunu kontrol edin (7.4+ gerekli)

