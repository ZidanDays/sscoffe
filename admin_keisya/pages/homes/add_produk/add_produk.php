<?php
// Koneksi ke database
include '../conf/koneksi.php';

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $productTitle = $_POST['productTitle'];

    // Tentukan direktori tempat menyimpan gambar
    $uploadDir = './uploads/carousel';

    // Ambil informasi file yang diunggah
    $fileName = $_FILES['productImage']['name'];
    $fileTmpName = $_FILES['productImage']['tmp_name'];

    // Buat nama unik untuk file yang diunggah
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $uniqueFileName = uniqid() . '.' . $fileExtension;

    // Tentukan lokasi akhir file yang akan disimpan
    $uploadPath = $uploadDir . $uniqueFileName;

    // Pindahkan file yang diunggah ke lokasi yang ditentukan
    if (move_uploaded_file($fileTmpName, $uploadPath)) {
        // File berhasil diunggah, simpan path relatif ke gambar di dalam database
        $sql = "INSERT INTO carousel (title, image_url) VALUES ('$productTitle', '$uploadPath')";

        if ($conn->query($sql) === TRUE) {
            // Redirect kembali ke halaman utama setelah berhasil menambahkan produk
            echo "<script>window.location.href = '?q=homes';</script>";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Terjadi kesalahan saat mengunggah file
        echo "Terjadi kesalahan saat mengunggah file.";
    }
}

// Tutup koneksi
$conn->close();