<?php
// Periksa apakah formulir delete telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    // Koneksi ke database
    include '../conf/koneksi.php';

    // Ambil ID produk yang akan dihapus
    $deleteId = $_POST['delete_id'];

    // Hapus produk dari database berdasarkan ID
    $sql = "DELETE FROM best_produk WHERE id=$deleteId";
    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman utama setelah berhasil menghapus produk
        echo "<script>window.location.href = '?q=bestproduk';</script>";
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika formulir delete tidak dikirimkan, redirect kembali ke halaman utama
    echo "<script>window.location.href = '?q=bestproduk';</script>";
    exit();
}