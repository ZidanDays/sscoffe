<?php
// Informasi koneksi database
$servername = "server"; // Lokasi server database
$username = "sscoffem_admin"; // Nama pengguna database
$password = "qAj~TUfw8{YO"; // Kata sandi database
$database = "sscoffem_admin"; // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}