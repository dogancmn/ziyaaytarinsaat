# Render.com Build Hatası Çözümü

## Sorun
```
Exited with status 1 while building your code
```

## Çözüm Adımları

### 1. Render Dashboard'da Ayarları Düzeltin

1. Render.com'da web service'inize gidin
2. "Settings" sekmesine tıklayın
3. **Build Command** alanını **TAMAMEN BOŞ BIRAKIN** (hiçbir şey yazmayın)
4. **Start Command** alanına şunu yazın: `php -S 0.0.0.0:$PORT -t .`
5. "Save Changes" butonuna tıklayın

### 2. Manuel Deploy

1. "Manual Deploy" sekmesine gidin
2. "Deploy latest commit" butonuna tıklayın

### 3. Environment Variables Kontrolü

"Environment" sekmesinde şu değişkenlerin olduğundan emin olun:

```
DB_HOST=your-database-host
DB_NAME=your-database-name
DB_USER=your-database-user
DB_PASSWORD=your-database-password
```

Eğer PostgreSQL kullanıyorsanız (Render'ın ücretsiz seçeneği):
```
DB_TYPE=postgresql
```

### 4. Önemli Notlar

- ✅ **Build Command:** BOŞ olmalı (PHP için build gerekmez)
- ✅ **Start Command:** `php -S 0.0.0.0:$PORT -t .` olmalı
- ✅ **Environment:** PHP seçili olmalı
- ✅ **Region:** En yakın bölgeyi seçin

### 5. Eğer Hala Hata Alıyorsanız

1. **Logs** sekmesine gidin ve hata mesajını kontrol edin
2. `config.php` dosyasının doğru olduğundan emin olun
3. Veritabanı servisinin çalıştığından emin olun
4. Environment variables'ların doğru olduğundan emin olun

## PostgreSQL Kullanıyorsanız

Render'ın ücretsiz tier'ında MySQL yok, PostgreSQL var. Eğer PostgreSQL kullanıyorsanız:

1. Environment variables'a ekleyin:
   ```
   DB_TYPE=postgresql
   ```

2. Veritabanını hazırlayın:
   - Render'da PostgreSQL servisinize gidin
   - "Connect" butonuna tıklayın
   - `database_postgresql.sql` dosyasındaki komutları çalıştırın

## Test

Deploy başarılı olduktan sonra:
- Ana sayfa: `https://your-app.onrender.com`
- İletişim formu: `https://your-app.onrender.com/contact.php`
- Randevu formu: `https://your-app.onrender.com/appointment.php`

