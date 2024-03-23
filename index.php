<?php
session_start();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sscoffe </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="assets/img/Sscafe.jpg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap4.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style6.css" rel="stylesheet">
    <link href="assets/css/designbaru17.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <!-- <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary icon-alamat"></i> <a href="#" class="text-white">MvpOnal</a></small> -->
                    <!-- <small class="me-3"><i class="fas fa-envelope me-2 text-secondary icon-email"></i><a href="#" class="text-white">MvpOnal@gmail.com</a></small> -->
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.html" class="navbar-brand">
                    <h1 class="text-primary display-6">SsCoffee</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" id="navbarToggler">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <!-- <a href="?q=beranda" class="nav-item nav-link <?php echo isset($_GET['q']) && $_GET['q'] == 'beranda' ? 'active' : ''; ?>">Home</a>
                        <a href="?q=shop" class="nav-item nav-link <?php echo isset($_GET['q']) && $_GET['q'] == 'shop' ? 'active' : ''; ?>">Shop</a>
                        <a href="?q=shop-detail" class="nav-item nav-link <?php echo isset($_GET['q']) && $_GET['q'] == 'shop-detail' ? 'active' : ''; ?>">Shop
                            Detail</a> -->
                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="?q=cart" class="dropdown-item <?php echo isset($_GET['q']) && $_GET['q'] == 'cart' ? 'active' : ''; ?>">Cart</a>
                                <a href="?q=chackout" class="dropdown-item <?php echo isset($_GET['q']) && $_GET['q'] == 'checkout' ? 'active' : ''; ?>">Checkout</a>
                                <a href="?q=404" class="dropdown-item <?php echo isset($_GET['q']) && $_GET['q'] == '404' ? 'active' : ''; ?>">404
                                    Page</a>
                            </div>
                        </div> -->
                        <!-- <a href="?q=contact" class="nav-item nav-link <?php echo isset($_GET['q']) && $_GET['q'] == 'contact' ? 'active' : ''; ?>">Contact</a> -->
                    </div>
                    <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                        <a href="#" class="position-relative me-4 my-auto">
                            <?php
                            // Cek apakah pengguna sudah login atau belum
                            if (isset($_SESSION['user_id'])) {
                                // Jika pengguna sudah login
                                if (isset($_SESSION['cart_items']) && $_SESSION['cart_items'] > 0) {
                                    // Tampilkan keranjang belanja dengan jumlah item
                            ?>
                                    <a href="?q=cart" class="position-relative me-4 my-auto shopping">
                                        <i class="fa fa-shopping-bag fa-2x"></i>
                                        <span class="position-absolute rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px; background-color: #ffb524;">
                                            <?php echo $_SESSION['cart_items']; ?>
                                        </span>
                                    </a>
                                <?php
                                } else {
                                    // Tampilkan keranjang belanja kosong
                                ?>
                                    <a href="?q=cart" class="position-relative me-4 my-auto shopping">
                                        <i class="fa fa-shopping-bag fa-2x"></i>
                                        <span class="position-absolute rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px; background-color: #ffb524;">
                                            0
                                        </span>
                                    </a>
                            <?php
                                }
                            } else {
                                // Jika pengguna belum login, Anda bisa tidak menampilkan link menuju keranjang belanja
                                // Tergantung pada desain dan kebutuhan aplikasi Anda
                            }
                            ?>
                        </a>

                        <?php
                        if (isset($_SESSION['username'])) {
                            // Pengguna sudah login
                            echo '<div class="dropdown user-dropdown">
                            <button class="btn-user">
                            <img class="user-avatar" src="./assets/img/profil.png" width="40" alt="user avatar">
                            <span class="username">' . $_SESSION['username'] . '</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li>
                                <img class="user-avatar1" src="./assets/img/profil.png" width="30" alt="user avatar">
                                <span class="username1">' . $_SESSION['username'] . '</span>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="status_pesanan.php">Status Pesanan</a></li>
                                <li><a class="dropdown-item" href="login_users/logout.php">Logout</a></li>
                            </ul>
                        </div>';
                        } else {
                            // Pengguna belum login, tampilkan tombol login seperti sebelumnya
                            echo '<button class="btn btn-primary my-auto shopping btn-login" data-bs-toggle="modal" data-bs-target="#loginModal">    
        Log in 
    </button>';
                        }
                        ?>

                    </div>
                </div>

        </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close rotate" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="judul-login">
                        <img src="./assets/img/Sscafe.png" alt="" class="logo_login">
                        <h3 class="modal-title" id="loginModalLabel" style="color:#5c2c06;">Welcome to Sscoffe</h3>
                    </div>
                    <!-- Form Login -->
                    <form id="loginForm" action="login_users/login_users.php" method="post" class="body_login">
                        <div class="mb-3">
                            <!-- <label for="loginUsername" class="form-label">Username</label> -->
                            <input type="text" class="form-control" id="loginUsername" name="loginUsername" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="loginEmail" class="form-label">Email</label> -->
                            <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="loginPassword" class="form-label">Password</label> -->
                            <div class="input-group">
                                <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Password" required>
                                <button type="button" class="btn toggle-password btn-mata">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary text-white btn-login1" style="width: 100%;">Log in</button>
                    </form>
                </div>
                <div class="modal-footer" id="centeredFooter"> <!-- Menambahkan id -->
                    Belum punya akun? <a href="#" class="me-auto" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal" style="color: orange;"> Register</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Register -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" id="closeButton" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title judul-login" id="registerModalLabel" style="color:#5c2c06;">Silahkan Register Akun Anda</h5>
                    <!-- Form Register -->
                    <form id="registerForm" action="login_users/register_users.php" method="post" class="body_login">
                        <div class="mb-3">
                            <!-- <label for="registerUsername" class="form-label">Username</label> -->
                            <input type="text" class="form-control" id="registerUsername" name="registerUsername" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="registerEmail" class="form-label">Email</label> -->
                            <input type="email" class="form-control" id="registerEmail" name="registerEmail" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" class="form-control" id="registerPassword" name="registerPassword" placeholder="Password" required>
                                <!-- Menambahkan onclick event untuk toggle password -->
                                <button type="button" class="btn toggle-password btn-mata" onclick="togglePassword('registerPassword')">
                                    <i id="eye-icon" class="bi bi-eye"></i> <!-- Ikon mata terbuka -->
                                    <i id="slash-icon" class="bi bi-eye-slash" style="display: none;"></i> <!-- Ikon mata tertutup -->
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary text-white btn-login1" style="width: 100%;">Register</button>
                    </form>
                </div>
                <div class="modal-footer" style="text-align: center;">

                    Sudah memiliki akun? <a href="#" class="me-auto" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal" style="color: orange;"> Log in</a>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" id="closeButton" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <?php
    include 'link.php';
    ?>


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary footer-logo1 mb-0">SsCoffe</h1>
                            <p class="text-secondary footer-logo2 mb-0">SsCoffe Products</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <!-- <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                            <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                        </div> -->
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-5 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Why People Like us!</h4>
                        <p class="mb-4">typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                        <!-- <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a> -->
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" ">
                    <div class=" d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Account</h4>
                    <a class="btn-link" href="">Home</a>
                    <a class="btn-link" href="">Shop</a>
                    <a class="btn-link" href="">Shop details</a>
                    <a class="btn-link" href="">Shopping Cart</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Contact</h4>
                    <p>Address: 1429 Netus Rd, NY 48247</p>
                    <p>Email: Example@gmail.com</p>
                    <p>Phone: +0123 4567 8910</p>
                    <p>Payment Accepted</p>

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>SsCoffe</a>,
                        All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    Designed By <a class="border-bottom" href="">AnjasMara</a> Distributed By <a class="border-bottom" href="">Anjas</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/lightbox/js/lightbox.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
    <script>
        // Fungsi untuk toggle password dan mengubah ikon pada login
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('.toggle-password');
            const password = document.getElementById('loginPassword');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.querySelector('i').classList.toggle('bi-eye');
                this.querySelector('i').classList.toggle('bi-eye-slash');
            });
        });
        // Fungsi untuk toggle password dan mengubah ikon pada register
        function togglePassword(elementId) {
            var passwordInput = document.getElementById(elementId);
            var eyeIcon = document.getElementById('eye-icon');
            var slashIcon = document.getElementById('slash-icon');

            // Mengubah tipe input dari password ke text dan sebaliknya
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.style.display = 'inline'; // Tampilkan ikon mata terbuka
                slashIcon.style.display = 'none'; // Sembunyikan ikon slash (mata tertutup)
            } else {
                passwordInput.type = "password";
                eyeIcon.style.display = 'none'; // Sembunyikan ikon mata terbuka
                slashIcon.style.display = 'inline'; // Tampilkan ikon slash (mata tertutup)
            }
        }

        // untuk animasi Close
        document.getElementById("closeButton").addEventListener("click", function() {
            // Tambahkan kelas rotate untuk animasi putar saat tombol close diklik
            this.classList.add("rotate");
        });

        // Menangkap elemen tombol
        var navbarToggler = document.getElementById("navbarToggler");
        // Menambahkan event listener untuk klik pada tombol
        navbarToggler.addEventListener("click", function() {
            // Toggle kelas "close" pada tombol
            this.classList.toggle("close");
            // Toggle rotasi ikon
            var icon = this.querySelector(".fa");
            if (this.classList.contains("close")) {
                icon.classList.remove("fa-bars");
                icon.classList.add("fa-times");
            } else {
                icon.classList.remove("fa-times");
                icon.classList.add("fa-bars");
            }
        });

        // dropdown user
        document.addEventListener("DOMContentLoaded", function() {
            var userDropdown = document.querySelector('.user-dropdown');
            var dropdownMenu = userDropdown.querySelector('.dropdown-menu');

            userDropdown.addEventListener('click', function() {
                dropdownMenu.classList.toggle('show');
            });

            // Tambahkan event listener untuk menutup dropdown ketika di luar dropdown diklik
            document.addEventListener('click', function(event) {
                var isClickInside = userDropdown.contains(event.target);
                if (!isClickInside && dropdownMenu.classList.contains('show')) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>

</body>

</html>