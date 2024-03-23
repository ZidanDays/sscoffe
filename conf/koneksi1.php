<?php
// Informasi koneksi database
$servername = "localhost"; // Lokasi server database
$username = "root"; // Nama pengguna database
$password = ""; // Kata sandi database
$database = "keisya_ecommerse"; // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}