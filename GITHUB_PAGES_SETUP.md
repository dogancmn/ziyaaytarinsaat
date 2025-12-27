# GitHub Pages Kurulum Rehberi

Eğer Settings → Pages sayfasında "Build and deployment" bölümünü göremiyorsanız, şu adımları deneyin:

## Yöntem 1: General Settings'ten Aktifleştirme

1. Repository'de **Settings** → **General** (Genel) sekmesine gidin
2. Sayfanın en altına kaydırın
3. **Features** (Özellikler) bölümünü bulun
4. **Pages** seçeneğinin yanındaki checkbox'ı işaretleyin
5. Kaydedin
6. Tekrar **Settings** → **Pages** sekmesine gidin
7. Artık ayarları görebilmelisiniz

## Yöntem 2: Actions Sekmesinden

1. Repository'de **Actions** sekmesine gidin
2. Sol menüden **Pages** workflow'unu bulun
3. Eğer görünmüyorsa, herhangi bir workflow çalıştırın (push yaptığınızda otomatik çalışır)
4. Workflow çalıştıktan sonra **Settings** → **Pages** sekmesine gidin

## Yöntem 3: Manuel Branch Deployment

1. Repository'de herhangi bir dosyayı düzenleyin (örn: README.md)
2. Commit ve push yapın
3. **Settings** → **Pages** sekmesine gidin
4. Artık "Build and deployment" bölümü görünmeli

## Yöntem 4: Repository İzinlerini Kontrol

1. **Settings** → **Actions** → **General** sekmesine gidin
2. **Workflow permissions** bölümünde:
   - "Read and write permissions" seçeneğini seçin
   - **Save** butonuna tıklayın
3. Tekrar **Settings** → **Pages** sekmesine gidin

## Yöntem 5: GitHub CLI ile (Terminal)

Eğer GitHub CLI yüklüyse:

```bash
gh api repos/dogancmn/ziyaaytarinsaat/pages -X POST \
  -f source[type]=branch \
  -f source[branch]=main \
  -f source[path]=/
```

## Kontrol

Ayarları yaptıktan sonra:
- 5-10 dakika bekleyin
- Şu linki deneyin: https://dogancmn.github.io/ziyaaytarinsaat/
- Eğer hala 404 alıyorsanız, **Settings** → **Pages** sayfasında yeşil bir kutu görmelisiniz

## Sorun Giderme

- Repository public mi? (Private repo'lar için GitHub Pro gerekebilir)
- Actions izinleri doğru mu?
- Repository'de en az bir commit var mı?

