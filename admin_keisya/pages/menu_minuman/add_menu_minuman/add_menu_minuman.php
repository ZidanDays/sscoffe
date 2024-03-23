<?php
// Koneksi ke database
include '../conf/koneksi.php';

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productCategory = $_POST['productCategory']; // Tambahkan baris ini untuk mengambil data kategori

    // Tentukan direktori tempat menyimpan gambar
    $uploadDir = './uploads/produk_minuman/';

    // Ambil informasi file yang diunggah (jika ada)
    $productImage = $_FILES['productImage']['name'];
    $productImageTmpName = $_FILES['productImage']['tmp_name'];

    // Cek apakah gambar produk diunggah
    if (!empty($productImage)) {
        // Jika ya, proses gambar yang baru diunggah
        $fileExtension = pathinfo($productImage, PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $uniqueFileName;

        if (move_uploaded_file($productImageTmpName, $uploadPath)) {
            // Insert data produk beserta gambar baru ke database
            $sql = "INSERT INTO produk_minuman (product_name, description, price, image_url, category) VALUES ('$productName', '$productDescription', '$productPrice', '$uploadPath', '$productCategory')";
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar produk.";
            exit();
        }
    } else {
        // Jika tidak ada gambar baru diunggah, hanya insert data produk
        $sql = "INSERT INTO produk_minuman (product_name, description, price, category) VALUES ('$productName', '$productDescription', '$productPrice', '$productCategory')";
    }

    // Jalankan query untuk menyimpan produk
    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman utama setelah berhasil menambah produk
        echo "<script>window.location.href = '?q=menu_minuman';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();