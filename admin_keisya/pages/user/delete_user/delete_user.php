<?php
// Koneksi ke database
include '../conf/koneksi.php';

// Pastikan ini adalah file yang dipanggil dari form delete_user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    // Ambil ID user yang akan dihapus
    $id = $_POST['delete_id'];

    // Lakukan proses penghapusan dari database
    $sql = "DELETE FROM `users` WHERE `id` = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman lain jika delete berhasil
        echo "<script>window.location.href = '?q=user';</script>";
        exit; // Pastikan untuk keluar dari script agar redirect benar-benar dieksekusi
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika tidak ada permintaan POST atau tidak ada data yang diterima
    echo "Invalid request!";
}
