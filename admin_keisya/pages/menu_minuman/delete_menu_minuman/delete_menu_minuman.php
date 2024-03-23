<?php
// Koneksi ke database
include '../conf/koneksi.php';

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $deleteProductId = $_POST['deleteProductId'];

    // Query untuk menghapus produk dari tabel
    $sql = "DELETE FROM produk_minuman WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $deleteProductId);

    // Eksekusi prepared statement
    if ($stmt->execute()) {
        // Redirect kembali ke halaman utama setelah berhasil menghapus produk
        echo "<script>window.location.href = '?q=menu_minuman';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup prepared statement
    $stmt->close();
}

// Tutup koneksi
$conn->close();