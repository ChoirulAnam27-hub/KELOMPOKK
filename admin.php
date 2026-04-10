<?php 
include 'koneksi.php'; // Menghubungkan ke database
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Futsal Kita</title>
    <link rel="stylesheet" href="style.css"> <style>
        /* Tambahan khusus halaman admin */
        .admin-box { background: white; padding: 25px; border-radius: 15px; margin-top: 20px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background-color: #f8f9fa; color: #555; }
        .btn-danger { background: #ff4757; color: white; border: none; padding: 10px 15px; border-radius: 8px; cursor: pointer; font-weight: bold; }
        .btn-danger:hover { background: #ff6b81; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🛠️ Dashboard Admin</h1>
            <p>Daftar Pesanan Lapangan Hari Ini</p>
        </header>

        <div class="admin-box">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h3>Data Booking Terkini</h3>
                <button onclick="resetData()" class="btn-danger">⚠️ Reset Semua Jadwal</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Jam</th>
                        <th>Nama Pemesan</th>
                        <th>Waktu Input</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ambil data dari database untuk ditampilkan di tabel
                    $query = "SELECT * FROM bookings ORDER BY jam ASC";
                    $tampil = mysqli_query($conn, $query);

                    if (mysqli_num_rows($tampil) > 0) {
                        while($data = mysqli_fetch_assoc($tampil)) {
                            echo "<tr>
                                    <td><strong>{$data['jam']}</strong></td>
                                    <td>{$data['nama_pemesan']}</td>
                                    <td><small style='color:gray'>{$data['tanggal']}</small></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' style='text-align:center;'>Belum ada bokingan hari ini.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <p style="text-align: center; margin-top: 20px;">
            <a href="index.html" style="color: white; text-decoration: none;">← Kembali ke Halaman Depan</a>
        </p>
    </div>

    <script>
        // Fungsi untuk panggil reset.php
        async function resetData() {
            if (confirm('PERINGATAN: Semua data booking akan dihapus permanen. Lanjutkan?')) {
                try {
                    const response = await fetch('reset.php');
                    const hasil = await response.json();
                    if (hasil.status === 'success') {
                        alert(hasil.message);
                        location.reload(); // Refresh halaman supaya tabel jadi kosong
                    }
                } catch (err) {
                    alert('Gagal menghubungi server.');
                }
            }
        }
    </script>
</body>
</html>