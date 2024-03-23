<?php
// Koneksi ke database
include '../conf/koneksi.php';

// Periksa apakah ada request POST yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil ID produk yang akan dihapus
    $delete_id = $_POST['delete_id'];

    // Buat query untuk menghapus produk dari database
    $sql = "DELETE FROM section4 WHERE id=$delete_id";

    // Jalankan query
    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman utama setelah berhasil menghapus produk
        echo "<script>window.location.href = '?q=section4';</script>";
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Tutup koneksi
$conn->close();