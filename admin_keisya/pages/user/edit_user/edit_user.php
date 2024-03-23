<?php
// Pastikan ini adalah file yang dipanggil dari form edit_user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_id'])) {
    // Koneksi ke database
    include '../conf/koneksi.php';

    // Ambil data dari form
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    // Hash password menggunakan algoritma yang aman, misalnya password_hash()
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Lakukan proses update ke database
    $sql = "UPDATE `users` SET `username` = '$username', `email` = '$email', `password` = '$hashed_password' WHERE `id` = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman lain jika update berhasil
        echo "<script>window.location.href = '?q=user';</script>";
        exit; // Pastikan untuk keluar dari script agar redirect benar-benar dieksekusi
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika tidak ada permintaan POST atau tidak ada data yang diterima
    echo "Invalid request!";
}
