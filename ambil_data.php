<?php
include 'koneksi.php';

$query = "SELECT jam, nama_pemesan FROM bookings";
$result = mysqli_query($conn, $query);

$data_booking = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data_booking[$row['jam']] = $row['nama_pemesan'];
}

header('Content-Type: application/json');
echo json_encode($data_booking);
?>