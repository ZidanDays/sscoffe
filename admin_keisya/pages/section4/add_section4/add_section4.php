<?php
// Koneksi ke database
include '../conf/koneksi.php';

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $title = $_POST['title'];
    $title2 = $_POST['title2'];
    $deskripsi = $_POST['deskripsi'];

    // Tentukan direktori tempat menyimpan gambar
    $uploadDir = './uploads/section4/';

    // Ambil informasi file yang diunggah (jika ada)
    $image = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];

    // Cek apakah gambar diunggah
    if (!empty($image)) {
        // Jika ya, proses gambar yang diunggah
        $fileExtension = pathinfo($image, PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $uniqueFileName;

        if (move_uploaded_file($imageTmpName, $uploadPath)) {
            // Insert data produk beserta gambar baru ke database
            $sql = "INSERT INTO section4 (title, title2, deskripsi, image_url) VALUES ('$title', '$title2', '$deskripsi', '$uploadPath')";
            if ($conn->query($sql) === TRUE) {
                // Redirect kembali ke halaman utama setelah berhasil menambah produk
                echo "<script>window.location.href = '?q=section4';</script>";
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar produk.";
            exit();
        }
    } else {
        echo "Image is required";
        exit();
    }
}

// Tutup koneksi
$conn->close();