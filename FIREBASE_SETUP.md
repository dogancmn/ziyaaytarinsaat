# Firebase Kurulum Rehberi

Bu proje, form verilerini saklamak için Firebase Firestore kullanmaktadır.

## 📋 Adım 1: Firebase Projesi Oluşturma

1. [Firebase Console](https://console.firebase.google.com/) adresine gidin
2. **"Add project"** veya **"Proje Ekle"** butonuna tıklayın
3. Proje adını girin (örn: `ziya-aytar-insaat`)
4. Google Analytics'i isteğe bağlı olarak etkinleştirebilirsiniz
5. **"Create project"** butonuna tıklayın

## 📋 Adım 2: Web Uygulaması Ekleme

1. Firebase Console'da projenizi açın
2. Sol menüden **⚙️ Project Settings** (Proje Ayarları) seçin
3. Aşağı kaydırın ve **"Your apps"** bölümünde **Web** ikonuna (</>) tıklayın
4. App nickname girin (örn: `Ziya Aytar Website`)
5. **"Register app"** butonuna tıklayın
6. Config bilgilerinizi kopyalayın (apiKey, authDomain, vb.)

## 📋 Adım 3: Firestore Database Oluşturma

1. Firebase Console'da sol menüden **Firestore Database** seçin
2. **"Create database"** butonuna tıklayın
3. **"Start in test mode"** seçeneğini seçin (geliştirme için)
4. Location seçin (örn: `europe-west1` veya size en yakın bölge)
5. **"Enable"** butonuna tıklayın

### Güvenlik Kuralları (Production için)

Test modundan sonra, Firestore'da **Rules** sekmesine gidin ve şu kuralları ekleyin:

```javascript
rules_version = '2';
service cloud.firestore {
  match /databases/{database}/documents {
    // Contacts collection - sadece yazma izni
    match /contacts/{document=**} {
      allow read: if false; // Sadece admin panelden okunabilir
      allow create: if true; // Herkes form gönderebilir
    }
    
    // Appointments collection - sadece yazma izni
    match /appointments/{document=**} {
      allow read: if false; // Sadece admin panelden okunabilir
      allow create: if true; // Herkes randevu alabilir
    }
  }
}
```

## 📋 Adım 4: Config Dosyasını Doldurma

1. Projenizdeki `firebase-config.js` dosyasını açın
2. Firebase Console'dan kopyaladığınız config bilgilerini yapıştırın:

```javascript
const firebaseConfig = {
  apiKey: "AIzaSy...", // Firebase'den kopyaladığınız
  authDomain: "your-project.firebaseapp.com",
  projectId: "your-project-id",
  storageBucket: "your-project.appspot.com",
  messagingSenderId: "123456789",
  appId: "1:123456789:web:abc123"
};
```

## 📋 Adım 5: Test Etme

1. `contact.html` sayfasını açın
2. Formu doldurup gönderin
3. Firebase Console → Firestore Database → Data sekmesinde `contacts` collection'ını kontrol edin
4. Yeni bir doküman görünmelidir

## 🔐 Güvenlik Notları

- **Test Mode**: Geliştirme aşamasında kullanılabilir, ancak production'da güvenlik kuralları eklemelisiniz
- **API Key**: Public olarak görünebilir, ancak Firestore güvenlik kuralları ile korunmalıdır
- **Rate Limiting**: Firebase'in ücretsiz planında günlük limitler vardır

## 💰 Firebase Fiyatlandırması

Firebase'in **Spark (Ücretsiz)** planı:
- 50K okuma/gün
- 20K yazma/gün
- 20K silme/gün
- 1 GB depolama

Küçük-orta ölçekli web siteleri için yeterlidir.

## 🎯 Sonraki Adımlar

1. ✅ Firebase kurulumu tamamlandı
2. ⏭️ Admin panel oluşturulabilir (randevu ve mesaj görüntüleme)
3. ⏭️ E-posta bildirimleri eklenebilir (Firebase Functions ile)
4. ⏭️ Güvenlik kuralları production için güncellenebilir

## 📞 Yardım

Firebase dokümantasyonu: https://firebase.google.com/docs

