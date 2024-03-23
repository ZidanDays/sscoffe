<?php
// Koneksi ke database
include './conf/koneksi.php';

// Cek apakah ada aksi penghapusan produk
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    // Mengambil id produk yang akan dihapus dari URL
    $cart_id = $_POST['cart_id'];

    // Menghapus produk dari tabel keranjang_belanja
    $sql_delete = "DELETE FROM keranjang_belanja WHERE id = '$cart_id'";
    if ($conn->query($sql_delete) === TRUE) {
        // Memperbarui nilai $_SESSION['cart_items']
        $user_id = $_SESSION['user_id']; // Ambil ID pengguna dari sesi
        $sql_cart_count = "SELECT COUNT(*) as total_items FROM keranjang_belanja WHERE user_id = '$user_id'";
        $result_cart_count = $conn->query($sql_cart_count);
        $row_cart_count = $result_cart_count->fetch_assoc();
        $_SESSION['cart_items'] = $row_cart_count['total_items'];
    } else {
        echo "Error: " . $sql_delete . "<br>" . $conn->error;
    }

    // Redirect kembali ke halaman cart.php setelah selesai menghapus
    echo "<script>window.location.href = '?q=cart';</script>";
}

// Kosongkan keranjang belanja setelah menyalin data
if (isset($_GET['action']) && $_GET['action'] == 'clear_cart') {
    $user_id = $_SESSION['user_id'];
    $sql_clear_cart = "DELETE FROM keranjang_belanja WHERE user_id = '$user_id'";
    if ($conn->query($sql_clear_cart) !== TRUE) {
        echo "Error: " . $sql_clear_cart . "<br>" . $conn->error;
    } else {
        // Set $_SESSION['cart_items'] ke nilai 0 setelah keranjang belanja dikosongkan
        $_SESSION['cart_items'] = 0;
        // Redirect kembali ke halaman cart.php setelah keranjang belanja dikosongkan
        echo "<script>window.location.href = '?q=cart';</script>";
    }
}

// Tutup koneksi
$conn->close();
