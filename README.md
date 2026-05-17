# Ngoding-AJG (Gamified Code Learning Web)

<p align="center">
  <strong>Belajar Ngoding Jadi Asik, Menantang, dan Gak Ngebosenin!</strong>
</p>

---

## 🚀 Tentang Ngoding-AJG

**Ngoding-AJG** adalah platform pembelajaran pemrograman berbasis web yang dirancang untuk memotivasi pengguna melalui elemen **Gamifikasi**. Kami percaya bahwa belajar coding tidak harus membosankan. Dengan sistem XP, Level, dan Leaderboard, setiap baris kode yang Anda pelajari membawa Anda satu langkah lebih dekat untuk menjadi master.

### ✨ Fitur Utama

*   **🎮 Gamification System**: Dapatkan XP (Experience Points) dan naikkan Level Anda setiap kali menyelesaikan modul pembelajaran.
*   **🔥 Daily Streaks**: Pertahankan konsistensi belajar Anda dengan sistem streak harian. Jangan sampai api belajar Anda padam!
*   **🏆 Global Leaderboard**: Bersaing dengan pembelajar lain dari seluruh dunia dan tunjukkan siapa yang paling jago.
*   **📚 Interactive Courses**: Kurikulum yang terstruktur, mulai dari "Frontend Master" hingga backend logic yang kompleks.
*   **✨ Modern UI/UX**: Antarmuka berbasis Dark Mode dengan sentuhan Glassmorphism yang premium dan responsif.

---

## 🛠️ Tech Stack

Project ini dibangun menggunakan teknologi modern:

- **Framework:** [Laravel 11](https://laravel.com)
- **Frontend:** [Tailwind CSS](https://tailwindcss.com) & [Blade Templates](https://laravel.com/docs/blade)
- **State Management:** [Alpine.js](https://alpinejs.dev)
- **Build Tool:** [Vite](https://vitejs.dev)
- **Database:** [MySQL](https://www.mysql.com)
- **Authentication:** [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze)

---

## 📸 Preview

*(Tambahkan screenshot di sini untuk mempercantik repo kamu!)*

| Landing Page | Dashboard | Leaderboard |
| :---: | :---: | :---: |
| ![Landing Page Placeholder](https://via.placeholder.com/300x200?text=Landing+Page) | ![Dashboard Placeholder](https://via.placeholder.com/300x200?text=Dashboard) | ![Leaderboard Placeholder](https://via.placeholder.com/300x200?text=Leaderboard) |

---

## ⚙️ Cara Install

Ikuti langkah-langkah di bawah ini untuk menjalankan project di komputer lokal Anda:

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Langkah-langkah
1.  **Clone repository**
    ```bash
    git clone https://github.com/RadityaRamadhanEka/Gamified-Code-Learning-Web.git
    cd Ngoding-AJG
    ```

2.  **Jalankan Setup Script** (Rekomendasi)
    Kami telah menyediakan script otomatis untuk instalasi:
    ```bash
    composer setup
    ```
    *Script ini akan melakukan `composer install`, setup `.env`, `key:generate`, `migrate`, dan `npm install`.*

3.  **Running di Lokal**
    Buka dua terminal atau gunakan perintah concurrently yang sudah kami siapkan:
    ```bash
    composer dev
    ```
    Perintah ini akan menjalankan:
    - `php artisan serve` (Server Laravel)
    - `npm run dev` (Vite Asset Bundler)
    - `php artisan queue:listen` (Queue Listener)

---

## 🤝 Kontribusi

Kontribusi selalu terbuka! Jika Anda memiliki ide fitur atau menemukan bug, silakan buat *issue* atau kirimkan *pull request*.

1. Fork Project ini
2. Buat Branch Fitur (`git checkout -b fitur/FiturMantap`)
3. Commit Perubahan (`git commit -m 'Menambahkan Fitur Mantap'`)
4. Push ke Branch (`git push origin fitur/FiturMantap`)
5. Buka Pull Request

---

## 📝 Lisensi

Project ini dilisensikan di bawah **MIT License**. Lihat file `LICENSE` untuk informasi lebih lanjut.

## 👨‍💻 Author

Dibuat dengan ❤️ oleh **Raditya Ramadhan Eka**
- GitHub: [@RadityaRamadhanEka](https://github.com/RadityaRamadhanEka)
- Portfolio: [radityaramadhan.com](https://radityaramadhan.com) *(opsional)*

---
<p align="center">
  Selamat belajar dan selamat ngoding! 🚀
</p>
