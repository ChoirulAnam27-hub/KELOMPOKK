<?php
include 'koneksi.php';

// Query untuk menghapus semua isi tabel bookings
$query = "TRUNCATE TABLE bookings";

if (mysqli_query($conn, $query)) {
    echo json_encode(["status" => "success", "message" => "Jadwal berhasil dikosongkan!"]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>