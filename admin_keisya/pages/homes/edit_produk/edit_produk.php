<?php
// Koneksi ke database
include '../conf/koneksi.php';

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $editProductId = $_POST['editProductId'];
    $editProductTitle = $_POST['editProductTitle'];

    // Tentukan direktori tempat menyimpan gambar
    $uploadDir = './uploads/carousel/';

    // Ambil informasi file yang diunggah (jika ada)
    $editProductImage = $_FILES['editProductImage']['name'];
    $editProductImageTmpName = $_FILES['editProductImage']['tmp_name'];

    // Cek apakah gambar produk baru diunggah
    if (!empty($editProductImage)) {
        // Jika ya, proses gambar yang baru diunggah
        $fileExtension = pathinfo($editProductImage, PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $uniqueFileName;

        if (move_uploaded_file($editProductImageTmpName, $uploadPath)) {
            // Update data produk beserta gambar baru di database menggunakan prepared statement
            $sql = "UPDATE carousel SET title = ?, image_url = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $editProductTitle, $uploadPath, $editProductId);
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar baru.";
            exit();
        }
    } else {
        // Jika tidak ada gambar baru diunggah, hanya update judul produk
        $sql = "UPDATE carousel SET title = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $editProductTitle, $editProductId);
    }

    // Eksekusi prepared statement
    if ($stmt->execute()) {
        // Redirect kembali ke halaman utama setelah berhasil mengedit produk
        echo "<script>window.location.href = '?q=homes';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup prepared statement
    $stmt->close();
}

// Tutup koneksi
$conn->close();