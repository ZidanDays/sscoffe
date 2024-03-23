<?php
// Pastikan file ini hanya diakses setelah pengiriman formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    include '../conf/koneksi.php';

    // Ambil data dari formulir
    $productName = $_POST['productName'];
    $productRating = $_POST['productRating'];
    $productPrice = $_POST['productPrice'];

    // Tentukan direktori tempat menyimpan gambar produk
    $uploadDir = './uploads/bestproduk/';

    // Ambil informasi file yang diunggah (jika ada)
    $productImage = $_FILES['productImage']['name'];
    $productImageTmpName = $_FILES['productImage']['tmp_name'];

    // Cek apakah gambar diunggah
    if (!empty($productImage)) {
        // Jika ya, proses gambar yang diunggah
        $fileExtension = pathinfo($productImage, PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $uniqueFileName;

        if (move_uploaded_file($productImageTmpName, $uploadPath)) {
            // Insert data produk beserta gambar baru ke database
            $sql = "INSERT INTO best_produk (product_name, image_url, rating, price) VALUES ('$productName', '$uploadPath', $productRating, '$productPrice')";
            if ($conn->query($sql) === TRUE) {
                // Redirect kembali ke halaman utama setelah berhasil menambah produk
                echo "<script>window.location.href = '?q=bestproduk';</script>";
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar produk.";
            exit();
        }
    } else {
        echo "Product image is required";
        exit();
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika file ini diakses secara langsung tanpa melalui pengiriman formulir, redirect ke halaman yang sesuai
    header("Location: ?q=beranda");
    exit();
}