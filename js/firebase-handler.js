// Firebase Database Handler
// Contact ve Appointment formları için

class FirebaseHandler {
  constructor() {
    // Firestore database referansı
    this.db = firebase.firestore();
  }

  // İletişim formu gönderimi
  async submitContactForm(formData) {
    try {
      const docRef = await this.db.collection('contacts').add({
        name: formData.name,
        email: formData.email,
        subject: formData.subject,
        message: formData.message,
        timestamp: firebase.firestore.FieldValue.serverTimestamp(),
        read: false
      });
      
      console.log('Contact form submitted with ID: ', docRef.id);
      return { success: true, id: docRef.id };
    } catch (error) {
      console.error('Error submitting contact form: ', error);
      return { success: false, error: error.message };
    }
  }

  // Randevu formu gönderimi
  async submitAppointmentForm(formData) {
    try {
      const docRef = await this.db.collection('appointments').add({
        name: formData.name,
        email: formData.email,
        mobile: formData.mobile,
        service: formData.service,
        date: formData.date,
        time: formData.time,
        message: formData.message,
        timestamp: firebase.firestore.FieldValue.serverTimestamp(),
        status: 'pending' // pending, confirmed, cancelled
      });
      
      console.log('Appointment submitted with ID: ', docRef.id);
      return { success: true, id: docRef.id };
    } catch (error) {
      console.error('Error submitting appointment: ', error);
      return { success: false, error: error.message };
    }
  }

  // Tüm randevuları getir (admin panel için)
  async getAllAppointments() {
    try {
      const snapshot = await this.db.collection('appointments')
        .orderBy('timestamp', 'desc')
        .get();
      
      return snapshot.docs.map(doc => ({
        id: doc.id,
        ...doc.data()
      }));
    } catch (error) {
      console.error('Error fetching appointments: ', error);
      return [];
    }
  }

  // Tüm iletişim mesajlarını getir (admin panel için)
  async getAllContacts() {
    try {
      const snapshot = await this.db.collection('contacts')
        .orderBy('timestamp', 'desc')
        .get();
      
      return snapshot.docs.map(doc => ({
        id: doc.id,
        ...doc.data()
      }));
    } catch (error) {
      console.error('Error fetching contacts: ', error);
      return [];
    }
  }
}

// Global instance
const firebaseHandler = new FirebaseHandler();

