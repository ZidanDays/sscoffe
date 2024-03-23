<?php
// Pastikan ada sesi yang aktif sebelum mengakses $_SESSION
session_start();

// Koneksi ke database
include './conf/koneksi.php';

// Validasi apakah aksi adalah "add" dan data produk diterima dengan benar
if ($_GET['action'] === 'add' && isset($_POST['product_id'], $_POST['product_name'], $_POST['price'], $_POST['quantity'], $_POST['image_url'])) {
    // Ambil data produk dari formulir
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity']; // Anda dapat menyesuaikan jika ingin memperhitungkan jumlah produk yang dipilih
    $image_url = $_POST['image_url'];

    // Validasi data
    if (!is_numeric($product_id) || !is_numeric($price) || !is_numeric($quantity) || $quantity <= 0) {
        echo "Invalid request. Please make sure all the required fields are filled correctly.";
        exit();
    }

    // Mendapatkan user_id dari sesi (pastikan sesi user_id telah diset sebelumnya)
    if (!isset($_SESSION['user_id'])) {
        echo "User session not found. Please login before adding products to cart.";
        exit();
    }
    $user_id = $_SESSION['user_id'];

    // Menghitung total harga
    $total = $price * $quantity;

    // Menyiapkan statement SQL untuk menyimpan data ke dalam tabel keranjang_belanja
    $sql = "INSERT INTO keranjang_belanja (product_id, product_name, price, quantity, total, image_url, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameter ke statement
    $stmt->bind_param("issidsi", $product_id, $product_name, $price, $quantity, $total, $image_url, $user_id);

    // Eksekusi statement
    if ($stmt->execute()) {
        // Produk berhasil ditambahkan ke keranjang belanja
        // Perbarui jumlah item di keranjang belanja
        $_SESSION['cart_items'] = isset($_SESSION['cart_items']) ? $_SESSION['cart_items'] + 1 : 1;
        // Redirect kembali ke halaman sebelumnya
        echo "<script>window.location.href = '?q=cart';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
} else {
    // Aksi tidak sesuai atau data produk tidak lengkap, berikan respons yang sesuai
    echo "Invalid request. Please make sure all the required fields are filled correctly.";
}

// Tutup koneksi
$conn->close();
