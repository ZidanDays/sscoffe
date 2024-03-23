<?php
// Koneksi ke database
include '../conf/koneksi.php';

// Periksa apakah ada request POST yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim dari form
    $edit_id = $_POST['edit_id'];
    $edit_title = $_POST['edit_title'];
    $edit_title2 = $_POST['edit_title2'];
    $edit_deskripsi = $_POST['edit_deskripsi'];

    // Tentukan direktori tempat menyimpan gambar
    $uploadDir = './uploads/section4/';

    // Ambil informasi file yang diunggah (jika ada)
    $edit_image = $_FILES['edit_image']['name'];
    $edit_imageTmpName = $_FILES['edit_image']['tmp_name'];

    // Cek apakah gambar diunggah
    if (!empty($edit_image)) {
        // Jika ya, proses gambar yang diunggah
        $fileExtension = pathinfo($edit_image, PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $uniqueFileName;

        if (move_uploaded_file($edit_imageTmpName, $uploadPath)) {
            // Update data produk beserta gambar baru ke database
            $sql = "UPDATE section4 SET title='$edit_title', title2='$edit_title2', deskripsi='$edit_deskripsi', image_url='$uploadPath' WHERE id=$edit_id";
            if ($conn->query($sql) === TRUE) {
                // Redirect kembali ke halaman utama setelah berhasil mengedit produk
                echo "<script>window.location.href = '?q=section4';</script>";
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar produk.";
            exit();
        }
    } else {
        // Jika tidak ada gambar yang diunggah, hanya update data tanpa mengubah gambar
        $sql = "UPDATE section4 SET title='$edit_title', title2='$edit_title2', deskripsi='$edit_deskripsi' WHERE id=$edit_id";
        if ($conn->query($sql) === TRUE) {
            // Redirect kembali ke halaman utama setelah berhasil mengedit produk
            echo "<script>window.location.href = '?q=section4';</script>";
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

// Tutup koneksi
$conn->close();