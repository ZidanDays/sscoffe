<?php
// Pastikan ada sesi yang aktif sebelum mengakses $_SESSION
session_start();

include './conf/koneksi.php';

// Cek apakah tombol "pesanBtn" diklik
if (isset($_POST['pesanBtn'])) {
    // Ambil data yang diperlukan dari formulir
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $table_number = $_POST['table_number'];
    $order_notes = $_POST['order_notes'];
    $transfer = isset($_POST['Transfer']) ? $_POST['Transfer'] : '';

    // Proses upload bukti transfer
    $upload_dir = "uploads/transfer/"; // Lokasi direktori untuk menyimpan file bukti transfer
    $transfer_proof = $_FILES['transfer_proof']['name']; // Nama file bukti transfer
    $temp_name = $_FILES['transfer_proof']['tmp_name']; // Lokasi sementara file yang diupload

    // Pindahkan file bukti transfer dari lokasi sementara ke lokasi tujuan
    move_uploaded_file($temp_name, $upload_dir . $transfer_proof);

    // Simpan data checkout ke dalam tabel database "checkout"
    $sql_checkout = "INSERT INTO checkout (first_name, last_name, table_number, order_notes, transfer_proof) VALUES ('$first_name', '$last_name', '$table_number', '$order_notes', '$transfer_proof')";

    // Eksekusi query untuk menyimpan data checkout
    if ($conn->query($sql_checkout) === TRUE) {
        // Ambil data produk dari array POST
        $product_ids = $_POST['product_ids'];
        $product_names = $_POST['product_names'];
        $prices = $_POST['prices'];
        $quantities = $_POST['quantities'];
        $image_urls = $_POST['image_urls'];

        // Loop melalui array produk untuk menyimpan setiap produk ke dalam tabel checkout
        for ($i = 0; $i < count($product_ids); $i++) {
            $product_id = $product_ids[$i];
            $product_name = $product_names[$i];
            $price = $prices[$i];
            $quantity = $quantities[$i];
            $image_url = $image_urls[$i];

            // Simpan data produk ke dalam tabel checkout
            $sql_save_product = "INSERT INTO checkout (first_name, last_name, table_number, order_notes, transfer_proof, product_id, product_name, price, quantity, image_url) VALUES ('$first_name', '$last_name', '$table_number', '$order_notes', '$transfer_proof', '$product_id', '$product_name', '$price', '$quantity', '$image_url')";

            // Eksekusi query untuk menyimpan data produk
            if ($conn->query($sql_save_product) !== TRUE) {
                echo "Error: " . $sql_save_product . "<br>" . $conn->error;
            }
        }

        // Kosongkan keranjang belanja setelah menyalin data
        $user_id = $_SESSION['user_id'];
        $sql_clear_cart = "DELETE FROM keranjang_belanja WHERE user_id = '$user_id'";
        $_SESSION["cart_items"] = 0;
        if ($conn->query($sql_clear_cart) !== TRUE) {
            echo "Error: " . $sql_clear_cart . "<br>" . $conn->error;
        }

        // Redirect ke halaman beranda setelah proses berhasil
        echo "<script>window.location.href = '?q=beranda';</script>";
        exit();
    } else {
        echo "Error: " . $sql_checkout . "<br>" . $conn->error;
    }
}

// Tutup koneksi database
$conn->close();
