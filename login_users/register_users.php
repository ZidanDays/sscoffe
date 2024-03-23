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
    include '../conf/koneksi.php';

    // Ambil data dari formulir pendaftaran
    $username = $_POST['registerUsername'];
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];

    // Hash password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Siapkan dan jalankan query untuk menyimpan data pengguna ke dalam database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Registrasi berhasil
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful',
                text: 'You have successfully registered!! Please Login'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../'; 
                }
            });
          </script>";
    } else {
        // Registrasi gagal
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Registration Failed',
                text: 'Error! Please Register Again: " . $sql . "<br>" . $conn->error . "'
            });
          </script>";
    }

    // Tutup koneksi ke database
    $conn->close();
    ?>
</body>

</html>