# Admin Panel Kullanım Kılavuzu

## 🚀 Kurulum

### 1. Veritabanını Güncelleme

Önce veritabanı şemasını güncelleyin:

```bash
mysql -u root -p ziyaaytarinsaat < database.sql
```

Veya phpMyAdmin üzerinden `database.sql` dosyasını çalıştırın.

### 2. Varsayılan Admin Kullanıcısı

Veritabanı şeması ile birlikte varsayılan bir admin kullanıcısı oluşturulur:

- **Kullanıcı Adı:** `admin`
- **Şifre:** `admin123`
- **E-posta:** `admin@ziyaaytarinsaat.com`

⚠️ **ÖNEMLİ:** İlk girişten sonra mutlaka şifrenizi değiştirin!

### 3. Şifre Değiştirme

Admin panelinde şu anda şifre değiştirme özelliği yok, ancak veritabanından manuel olarak değiştirebilirsiniz:

```sql
UPDATE admin_users 
SET password = '$2y$10$YENI_SIFRE_HASH' 
WHERE username = 'admin';
```

PHP ile şifre hash'i oluşturmak için:
```php
echo password_hash('yeni_sifre', PASSWORD_DEFAULT);
```

## 📍 Admin Paneline Erişim

Admin paneline şu adresten erişebilirsiniz:

```
http://localhost:8000/admin/login.php
```

## 🎯 Özellikler

### 1. Dashboard
- Toplam proje sayısı
- İletişim mesajları istatistikleri
- Randevu istatistikleri
- Son mesajlar ve randevular

### 2. Projeler Yönetimi
- ✅ Proje listeleme
- ✅ Yeni proje ekleme
- ✅ Proje düzenleme
- ✅ Proje silme
- ✅ Proje görseli yükleme
- ✅ Proje durumu (Taslak/Yayında)
- ✅ Öne çıkan proje işaretleme
- ✅ Şehir bazlı filtreleme

**Kullanım:**
1. `admin/projects.php` sayfasına gidin
2. "Yeni Proje Ekle" butonuna tıklayın
3. Proje bilgilerini doldurun
4. Görsel yükleyin (opsiyonel)
5. Durumu "Yayında" olarak seçin
6. Kaydet

**Not:** Projeler slug (URL) ile erişilebilir. Örnek: `project-detail.php?slug=proje-adi`

### 3. İletişim Mesajları
- ✅ Tüm mesajları görüntüleme
- ✅ Mesaj detaylarını görüntüleme
- ✅ Mesaj silme
- ✅ E-posta ile yanıtlama (mailto linki)

### 4. Randevular
- ✅ Tüm randevuları görüntüleme
- ✅ Randevu detaylarını görüntüleme
- ✅ Randevu durumu güncelleme (Bekliyor/Onaylandı/İptal)
- ✅ Randevu silme
- ✅ E-posta ile iletişim

### 5. Site Ayarları (Sadece Admin)
- ✅ Site adı
- ✅ E-posta adresi
- ✅ Telefon numarası
- ✅ Adres
- ✅ Site açıklaması
- ✅ Ana renk
- ✅ Logo yolu

### 6. Kullanıcı Yönetimi (Sadece Admin)
- Henüz eklenmedi (gelecek güncellemede)

## 🔐 Güvenlik

- Tüm admin sayfaları login kontrolü yapar
- Session tabanlı kimlik doğrulama
- Şifreler bcrypt ile hash'lenir
- SQL injection koruması (PDO prepared statements)
- XSS koruması (htmlspecialchars)

## 📁 Dosya Yapısı

```
admin/
├── includes/
│   ├── auth.php          # Kimlik doğrulama fonksiyonları
│   ├── functions.php     # Yardımcı fonksiyonlar
│   ├── header.php        # Admin panel header
│   └── footer.php        # Admin panel footer
├── assets/
│   ├── css/
│   │   └── admin.css     # Admin panel stilleri
│   └── js/
│       └── admin.js      # Admin panel JavaScript
├── index.php              # Dashboard
├── login.php              # Giriş sayfası
├── logout.php             # Çıkış
├── projects.php           # Projeler yönetimi
├── contacts.php           # İletişim mesajları
├── appointments.php       # Randevular
└── settings.php           # Site ayarları
```

## 🎨 Tasarım Özellikleri

- Modern ve temiz arayüz
- Responsive tasarım (mobil uyumlu)
- Sidebar navigasyon
- Site logosu kullanımı
- Primary color: #113940
- DataTables ile gelişmiş tablolar
- Font Awesome ikonları

## 💡 İpuçları

1. **Proje Görselleri:** Görseller `img/projects/` klasörüne yüklenir
2. **Slug Oluşturma:** Başlıktan otomatik slug oluşturulur, manuel değiştirilebilir
3. **Proje Durumu:** Sadece "Yayında" olan projeler frontend'de görünür
4. **Öne Çıkan Projeler:** Featured olarak işaretlenen projeler özel gösterilebilir
5. **Şehir Filtreleme:** Projeler şehir bazında filtrelenir (Antalya, İstanbul, Mersin)

## 🐛 Sorun Giderme

### "Veritabanı bağlantısı başarısız" hatası
- `config.php` dosyasını kontrol edin
- Veritabanının oluşturulduğundan emin olun
- Kullanıcı adı ve şifrenin doğru olduğundan emin olun

### "Giriş yapamıyorum" hatası
- Varsayılan kullanıcı adı: `admin`
- Varsayılan şifre: `admin123`
- Veritabanında `admin_users` tablosunun oluşturulduğundan emin olun

### "Yetkisiz erişim" hatası
- Sadece admin rolündeki kullanıcılar ayarlar sayfasına erişebilir
- Editor rolündeki kullanıcılar sadece içerik yönetimi yapabilir

## 📝 Notlar

- Admin paneli tamamen Türkçe'dir
- Tüm tarihler Türkçe formatında gösterilir
- DataTables Türkçe dil desteği ile gelir
- Responsive tasarım sayesinde mobil cihazlardan da yönetim yapılabilir

## 🔄 Güncellemeler

Gelecek güncellemelerde eklenecek özellikler:
- Kullanıcı yönetimi (CRUD)
- Şifre değiştirme sayfası
- Proje galeri yönetimi
- Medya kütüphanesi
- Sayfa yönetimi
- Blog/Haber yönetimi

