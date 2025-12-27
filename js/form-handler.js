// Form Handler - GitHub Pages (Test) ve cPanel (Production) için
// GitHub Pages'te mock mode, cPanel'de gerçek API kullanır

(function() {
    'use strict';
    
    // Environment detection - GitHub Pages mi yoksa cPanel mi?
    const isGitHubPages = window.location.hostname.includes('github.io') || 
                          window.location.hostname.includes('github.com');
    
    // Contact Form Handler
    function initContactForm() {
        const form = document.getElementById('contactForm');
        if (!form) return;
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                name: document.getElementById('name').value.trim(),
                email: document.getElementById('email').value.trim(),
                subject: document.getElementById('subject').value.trim(),
                message: document.getElementById('message').value.trim()
            };
            
            // Validasyon
            if (!formData.name || !formData.email || !formData.message) {
                alert('Lütfen tüm zorunlu alanları doldurun.');
                return;
            }
            
            if (!isValidEmail(formData.email)) {
                alert('Geçerli bir e-posta adresi giriniz.');
                return;
            }
            
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Gönderiliyor...';
            
            if (isGitHubPages) {
                // GitHub Pages - Mock mode (sadece test için)
                setTimeout(function() {
                    alert('✅ TEST MODU: Mesajınız başarıyla gönderildi!\n\n(GitHub Pages\'te formlar test modunda çalışıyor. Gerçek veritabanı bağlantısı cPanel\'de aktif olacak.)');
                    form.reset();
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }, 1000);
            } else {
                // cPanel - Gerçek API
                fetch('api/contact.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        form.reset();
                    } else {
                        alert(data.message || 'Bir hata oluştu. Lütfen tekrar deneyin.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
            }
        });
    }
    
    // Appointment Form Handler
    function initAppointmentForm() {
        const form = document.getElementById('appointmentForm');
        if (!form) return;
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                name: document.getElementById('apptName').value.trim(),
                email: document.getElementById('apptEmail').value.trim(),
                mobile: document.getElementById('apptMobile').value.trim(),
                service: document.getElementById('apptService').value.trim(),
                appointment_date: document.getElementById('apptDate').value.trim(),
                appointment_time: document.getElementById('apptTime').value.trim(),
                message: document.getElementById('apptMessage').value.trim() || ''
            };
            
            // Validasyon
            if (!formData.name || !formData.email || !formData.mobile || 
                !formData.service || !formData.appointment_date || !formData.appointment_time) {
                alert('Lütfen tüm zorunlu alanları doldurun.');
                return;
            }
            
            if (!isValidEmail(formData.email)) {
                alert('Geçerli bir e-posta adresi giriniz.');
                return;
            }
            
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Gönderiliyor...';
            
            if (isGitHubPages) {
                // GitHub Pages - Mock mode (sadece test için)
                setTimeout(function() {
                    alert('✅ TEST MODU: Randevunuz başarıyla alındı!\n\n' +
                          'Ad: ' + formData.name + '\n' +
                          'E-posta: ' + formData.email + '\n' +
                          'Telefon: ' + formData.mobile + '\n' +
                          'Hizmet: ' + formData.service + '\n' +
                          'Tarih: ' + formData.appointment_date + '\n' +
                          'Saat: ' + formData.appointment_time + '\n\n' +
                          '(GitHub Pages\'te formlar test modunda çalışıyor. Gerçek veritabanı bağlantısı cPanel\'de aktif olacak.)');
                    form.reset();
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }, 1000);
            } else {
                // cPanel - Gerçek API
                fetch('api/appointment.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        form.reset();
                    } else {
                        alert(data.message || 'Bir hata oluştu. Lütfen tekrar deneyin.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
            }
        });
    }
    
    // Email validation
    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    // Initialize forms when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initContactForm();
            initAppointmentForm();
        });
    } else {
        initContactForm();
        initAppointmentForm();
    }
})();

