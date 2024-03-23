<?php
// Koneksi ke database
include '../conf/koneksi.php';

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil ID produk yang akan dihapus
    $deleteProductId = $_POST['deleteProductId'];

    // Query untuk menghapus produk dari database
    $sql = "DELETE FROM carousel WHERE id = '$deleteProductId'";

    // Jalankan query untuk menghapus produk
    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman utama setelah berhasil menghapus produk
        echo "<script>window.location.href = '?q=homes';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();