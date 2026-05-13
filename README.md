QR Code Siswa
=IMAGE("https://quickchart.io/qr?text=" & ENCODEURL(G2))
Link Absensi Ortu
=IF(I2=""; ""; 
"https://script.google.com/macros/s/XXXX/exec?tipe=ortu&nama=" & ENCODEURL(A2) & "&kelas=" & ENCODEURL(B2))
QR Code Ortu
=IMAGE("https://quickchart.io/qr?text=" & ENCODEURL(M2))
⚙️ Setup Google Apps Script
1. Buka Google Sheets

Klik:

Extensions → Apps Script
2. Paste Script

Masukkan script Apps Script.

3. Deploy Web App

Klik:

Deploy → New Deployment

Setting:

Execute as: Me
Who has access: Anyone

Lalu copy URL deployment.

🔥 API Mode

Digunakan Laravel untuk mengambil data realtime.

Contoh:

https://script.google.com/macros/s/XXXX/exec?mode=api
🖥️ Setup Laravel
Install Laravel
composer create-project laravel/laravel absensi-qrcode
Jalankan Laravel
php artisan serve
📦 Controller Laravel

Tambahkan:

use Illuminate\Support\Facades\Http;
Contoh Controller
public function index()
{
    $response = Http::withoutVerifying()
        ->get('https://script.google.com/macros/s/XXXX/exec?mode=api');

    $data = json_decode($response->body(), true);

    return view('admin.dashboard', [
        'data' => $data ?? []
    ]);
}
🎨 UI Dashboard

Dashboard menggunakan:

Tailwind CSS
Chart.js
Filter kelas
Statistik realtime
Tabel realtime
📊 Statistik Dashboard
Total Data
Siswa Hadir
Ortu Hadir
Belum Hadir
🔍 Filter Kelas

Dashboard mendukung filter:

XIIA
XIIB
XI TKJ
dll
📈 Chart

Menggunakan Doughnut Chart dari Chart.js.

🔐 Pembatasan Waktu QR

QR dapat dibatasi:

tanggal tertentu
jam tertentu

Contoh:

var jamMulai = "08:00";
var jamSelesai = "10:00";
📝 Log History

Setiap scan akan masuk ke sheet:

Log

Data:

nama
kelas
tipe absensi
jam scan
🔄 Auto Refresh

Dashboard refresh otomatis setiap 10 detik.

<meta http-equiv="refresh" content="10">
📌 Alur Sistem
Siswa
Scan QR
Masuk ke Apps Script
Data tersimpan
Dashboard update realtime
Orang Tua
Scan QR khusus ortu
Sistem cek kuota
Status ortu update
Dashboard update realtime
🛡️ Validasi

Sistem mendukung:

Validasi kuota
Validasi tanggal
Validasi jam
Validasi siswa
Validasi kelas
📈 Pengembangan Selanjutnya

Fitur yang bisa ditambahkan:

Login admin
Export PDF
Export Excel
Dark mode
GPS lokasi
QR expire
Rekap per kelas
Grafik realtime
Notifikasi WhatsApp
👨‍💻 Author

Project dibuat menggunakan:

Laravel
Google Sheets
Google Apps Script
Tailwind CSS
Chart.js
⭐ Support

Jika project ini membantu:

⭐ Star repository
🍴 Fork repository
📢 Share project
