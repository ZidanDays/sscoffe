<?php
// Periksa apakah formulir edit telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    include '../conf/koneksi.php';

    // Ambil data dari formulir edit
    $editId = $_POST['edit_id'];
    $editProductName = $_POST['edit_productName'];
    $editRating = $_POST['edit_rating'];
    $editPrice = $_POST['edit_price'];

    // Tentukan direktori tempat menyimpan gambar
    $uploadDir = './uploads/bestproduk/';

    // Ambil informasi file yang diunggah (jika ada)
    $editImage = $_FILES['edit_image']['name'];
    $editImageTmpName = $_FILES['edit_image']['tmp_name'];

    // Cek apakah gambar diunggah
    if (!empty($editImage)) {
        // Jika ya, proses gambar yang diunggah
        $fileExtension = pathinfo($editImage, PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $uniqueFileName;

        if (move_uploaded_file($editImageTmpName, $uploadPath)) {
            // Perbarui data produk di database berdasarkan ID dengan image_url yang baru
            $sql = "UPDATE best_produk SET product_name='$editProductName', image_url='$uploadPath', rating=$editRating, price=$editPrice WHERE id=$editId";
            if ($conn->query($sql) === TRUE) {
                // Redirect kembali ke halaman utama setelah berhasil mengedit produk
                echo "<script>window.location.href = '?q=bestproduk';</script>";
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar produk.";
            exit();
        }
    } else {
        // Jika tidak ada gambar yang diunggah, hanya perbarui data lainnya tanpa memperbarui image_url
        $sql = "UPDATE best_produk SET product_name='$editProductName', rating=$editRating, price=$editPrice WHERE id=$editId";
        if ($conn->query($sql) === TRUE) {
            // Redirect kembali ke halaman utama setelah berhasil mengedit produk
            echo "<script>window.location.href = '?q=bestproduk';</script>";
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika formulir edit tidak dikirimkan, redirect kembali ke halaman utama
    echo "<script>window.location.href = '?q=beranda';</script>";
    exit();
}