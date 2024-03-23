<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sscoffe </title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <?php
    // Pastikan session dimulai sebelum mengakses atau membuat session
    session_start();

    include '../conf/koneksi.php';

    // Ambil data dari formulir login
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // Cari pengguna berdasarkan alamat email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Pengguna ditemukan
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verifikasi password
        if (password_verify($password, $hashed_password)) {
            // Password cocok, buat session pengguna dan alihkan ke halaman beranda
            $_SESSION['user_id'] = $row['id']; // Menyimpan user_id dalam sesi
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];

            // Ambil jumlah produk di keranjang belanja dari database
            $user_id = $row['id'];
            $sql_cart_count = "SELECT COUNT(*) as total_items FROM keranjang_belanja WHERE user_id = '$user_id'";
            $result_cart_count = $conn->query($sql_cart_count);
            $row_cart_count = $result_cart_count->fetch_assoc();
            $jumlah_produk_dari_database = $row_cart_count['total_items'];

            // Simpan jumlah produk di sesi
            $_SESSION['cart_items'] = $jumlah_produk_dari_database;


            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Login Successful',
                    text: 'Welcome back, " . $row['username'] . "!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '../'; // Redirect ke halaman beranda
                });
              </script>";
        } else {
            // Password tidak cocok, tampilkan pesan kesalahan
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: 'Invalid email or password. Please try again.'
                });
              </script>";
        }
    } else {
        // Pengguna tidak ditemukan, tampilkan pesan kesalahan
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: 'Invalid email or password. Please try again.'
            });
          </script>";
    }

    // Tutup koneksi ke database
    $conn->close();
    ?>
</body>

</html>