# 📌 Sistem Absensi QR Code

Sistem absensi berbasis:

- Google Sheets
- Google Apps Script
- QR Code
- Laravel Dashboard
- Tailwind CSS
- Chart.js

Mendukung:
- Absensi siswa
- Absensi orang tua
- QR Code otomatis
- Dashboard realtime
- Filter kelas
- Statistik kehadiran
- Kuota absensi
- Log history absensi

---

# 🚀 Fitur

## ✅ Fitur Utama

- QR Code otomatis untuk siswa
- QR Code otomatis untuk orang tua
- Dashboard admin modern
- Statistik realtime
- Filter per kelas
- Auto refresh dashboard
- Log history scan QR
- Kuota scan
- Pembatasan tanggal dan jam absensi
- API Google Apps Script untuk Laravel

---

# 🧩 Teknologi

## Backend
- PHP Laravel
- Google Apps Script

## Frontend
- Tailwind CSS
- Chart.js

## Database
- Google Sheets

---

# 📂 Struktur Data Google Sheets

| Kolom | Isi |
|---|---|
| A | Nama Siswa |
| B | Kelas |
| C | Status Siswa |
| D | Jam Terakhir |
| E | Kuota Siswa |
| F | Total Absen Siswa |
| G | Link Absensi Siswa |
| H | QR Code Siswa |
| I | Nama Ortu |
| J | Status Ortu |
| K | Kuota Ortu |
| L | Total Absen Ortu |
| M | Link Absensi Ortu |
| N | QR Code Ortu |

---

# 🔥 Formula Google Sheets

## Link Absensi Siswa

```excel
=IF(A2=""; ""; 
"https://script.google.com/macros/s/XXXX/exec?tipe=siswa&nama=" & ENCODEURL(A2) & "&kelas=" & ENCODEURL(B2))
