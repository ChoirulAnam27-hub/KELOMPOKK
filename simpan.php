<?php
include 'koneksi.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['jam']) && isset($data['nama'])) {
    $jam = $data['jam'];
    $nama = mysqli_real_escape_string($conn, $data['nama']);

    $query = "INSERT INTO bookings (jam, nama_pemesan) VALUES ('$jam', '$nama')";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }
}
?>