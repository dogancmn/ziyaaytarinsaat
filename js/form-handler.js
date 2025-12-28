// Form Handler for Contact and Appointment Forms
// Works with PHP API endpoints

(function() {
    'use strict';

    // Contact Form Handler
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Gönderiliyor...';

            const formData = new FormData(this);
            const data = {
                name: formData.get('name') || document.getElementById('name')?.value,
                email: formData.get('email') || document.getElementById('email')?.value,
                subject: formData.get('subject') || document.getElementById('subject')?.value,
                message: formData.get('message') || document.getElementById('message')?.value
            };

            try {
                const response = await fetch('api/contact.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams(data)
                });

                const result = await response.json();

                if (result.success) {
                    alert(result.message || 'Mesajınız başarıyla gönderildi!');
                    this.reset();
                } else {
                    alert(result.message || 'Bir hata oluştu. Lütfen tekrar deneyin.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Bir hata oluştu. Lütfen daha sonra tekrar deneyin.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });
    }

    // Appointment Form Handler
    const appointmentForm = document.getElementById('appointmentForm');
    if (appointmentForm) {
        appointmentForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Gönderiliyor...';

            const data = {
                name: document.getElementById('apptName')?.value || '',
                email: document.getElementById('apptEmail')?.value || '',
                mobile: document.getElementById('apptMobile')?.value || '',
                service: document.getElementById('apptService')?.value || '',
                appointment_date: document.getElementById('apptDate')?.value || '',
                appointment_time: document.getElementById('apptTime')?.value || '',
                message: document.getElementById('apptMessage')?.value || ''
            };

            try {
                const response = await fetch('api/appointment.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams(data)
                });

                const result = await response.json();

                if (result.success) {
                    alert(result.message || 'Randevunuz başarıyla oluşturuldu!');
                    this.reset();
                } else {
                    alert(result.message || 'Bir hata oluştu. Lütfen tekrar deneyin.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Bir hata oluştu. Lütfen daha sonra tekrar deneyin.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });
    }
})();

