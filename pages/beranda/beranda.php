<?php
include './conf/koneksi.php';

// Query untuk mengambil data judul dari tabel carousel
$sql = "SELECT title FROM carousel";
$result = $conn->query($sql);

// Periksa apakah ada hasil dari query
if ($result->num_rows > 0) {
    // Ambil judul dari baris pertama hasil query
    $row = $result->fetch_assoc();
    $title = $row['title'];
}


// Query untuk mengambil data image_url dari tabel carousel untuk ID 1
$sql_id_1 = "SELECT image_url FROM carousel WHERE id = 5";
$result_id_1 = $conn->query($sql_id_1);

// Periksa apakah ada hasil dari query untuk ID 1
if ($result_id_1->num_rows > 0) {
    $row_id_1 = $result_id_1->fetch_assoc();
    $image1 = $row_id_1['image_url'];
} else {
    echo "Data untuk ID 1 tidak ditemukan.";
}

// Query untuk mengambil data image_url dari tabel carousel untuk ID 1
$sql_id_2 = "SELECT image_url FROM carousel WHERE id = 6";
$result_id_2 = $conn->query($sql_id_2);

// Periksa apakah ada hasil dari query untuk ID 1
if ($result_id_2->num_rows > 0) {
    $row_id_2 = $result_id_2->fetch_assoc();
    $image2 = $row_id_2['image_url'];
} else {
    echo "Data untuk ID 1 tidak ditemukan.";
}
?>


<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-7">
                <h1 class="mb-5 display-3 text-primary judul"><?php echo $title ?> </h1>
                <div class="position-relative mx-auto">
                    <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="number" placeholder="Search">
                    <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Submit Now</button>
                </div>
            </div>
            <div class="col-md-12 col-lg-5">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active rounded">
                            <img src="admin_keisya<?php echo $image1 ?>" class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                            <a href="#" class="btn px-4 py-2 text-white rounded">Coffe</a>
                        </div>
                        <div class="carousel-item rounded">
                            <img src="admin_keisya<?php echo $image2 ?>" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                            <a href="#" class="btn px-4 py-2 text-white rounded">food</a>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Caffe Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Menu</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                <span class="text-dark" style="width: 130px;">All Drinks</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                <span class="text-dark" style="width: 130px;">Coffe</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                <span class="text-dark" style="width: 130px;">Non Coffe</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                <span class="text-dark" style="width: 130px;">Food</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <?php
                                // Koneksi ke database
                                include './conf/koneksi.php';

                                // Query untuk mengambil data dari tabel produk_makanan
                                // $sql = "SELECT * FROM produk_makanan";
                                // $sql = "SELECT * FROM produk WHERE category = 'Food';
                                $sql = "SELECT * FROM produk WHERE category = 'Coffe' OR category = 'Non Coffe'";

                                $result = $conn->query($sql);

                                // Periksa apakah ada baris data yang dikembalikan
                                if ($result->num_rows > 0) {
                                    // Output data dari setiap baris
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="admin_keisya<?php echo $row['image_url']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $row['category']; ?></div>

                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4 class="nama_menu"> <a href="?q=shop-detail" style="color:black;"><?php echo $row['product_name']; ?></a></h4>
                                                    <p><?php echo $row['description']; ?></p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><?php echo $row['price']; ?></p>
                                                        
                                                        <?php
                                                        // Koneksi ke database
                                                        include './conf/koneksi.php';

                                                        // Cek apakah pengguna sudah login
                                                        if (isset($_SESSION['username'])) {
                                                            // Pengguna sudah login, tampilkan formulir untuk menambahkan produk ke keranjang
                                                            echo '
                                                                <form action="?q=cart_add&action=add" method="post" enctype="multipart/form-data">  
                                                                    <input type="hidden" name="product_id" value="' . $row['id'] . '">
                                                                    <input type="hidden" name="image_url" value="' . $row['image_url'] . '">
                                                                    <input type="hidden" name="product_name" value="' . $row['product_name'] . '">
                                                                    <input type="hidden" name="price" value="' . $row['price'] . '">
                                                                    <input type="number" name="quantity" style="width: 50px; padding: 8px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">

                                                                    <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary btn-addto">
                                                                        <i class="fa fa-shopping-bag me-2 text-primary logo-add"></i> Add to Cart
                                                                    </button>
                                                                </form>';
                                                        } else {
                                                            // Pengguna belum login, tampilkan tombol untuk membuka modal login dengan pemberitahuan
                                                            echo '
                                                            <button class="btn border border-secondary rounded-pill px-3 text-primary btn-addto" onclick="showLoginAlert()">
                                                                <i class="fa fa-shopping-bag me-2 text-primary logo-add"></i> Add to Cart
                                                            </button>';
                                                        }
                                                        ?>



                                                        <!-- Script untuk menampilkan SweetAlert -->
                                                        <script>
                                                            function showLoginAlert() {
                                                                Swal.fire({
                                                                    icon: 'warning',
                                                                    title: 'Peringatan',
                                                                    text: 'Silakan login terlebih dahulu untuk menambahkan produk ke keranjang belanja.'
                                                                });
                                                            }
                                                        </script>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                // Tutup koneksi
                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab-2" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <?php
                                // Koneksi ke database
                                include './conf/koneksi.php';

                                // Query untuk mengambil data dari tabel produk_makanan dengan kategori Coffe
                                // $sql = "SELECT * FROM produk_makanan WHERE category = 'Coffe'";
                                $sql = "SELECT * FROM produk WHERE category = 'Coffe'";
                                $result = $conn->query($sql);

                                // Periksa apakah ada baris data yang dikembalikan
                                if ($result->num_rows > 0) {
                                    // Output data dari setiap baris
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="admin_keisya<?php echo $row['image_url']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $row['category']; ?></div>

                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4 class="nama_menu"> <a href="?q=shop-detail" style="color:black;"><?php echo $row['product_name']; ?> </a></h4>
                                                    <p><?php echo $row['description']; ?></p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><?php echo $row['price']; ?></p>
                                                        <!-- <a href="?q=shop-detail" class="btn border border-secondary rounded-pill px-3 text-primary btn-addto"><i class="fa fa-shopping-bag me-2 text-primary logo-add"></i> Add to
                                                            cart</a> -->
                                                        
                                                        
                                                            <?php
                                                        // Koneksi ke database
                                                        include './conf/koneksi.php';

                                                        // Cek apakah pengguna sudah login
                                                        if (isset($_SESSION['username'])) {
                                                            // Pengguna sudah login, tampilkan formulir untuk menambahkan produk ke keranjang
                                                            echo '
                                                                <form action="?q=cart_add&action=add" method="post" enctype="multipart/form-data">  
                                                                    <input type="hidden" name="product_id" value="' . $row['id'] . '">
                                                                    <input type="hidden" name="image_url" value="' . $row['image_url'] . '">
                                                                    <input type="hidden" name="product_name" value="' . $row['product_name'] . '">
                                                                    <input type="hidden" name="price" value="' . $row['price'] . '">
                                                                    <input type="number" name="quantity" style="width: 50px; padding: 8px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">

                                                                    <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary btn-addto">
                                                                        <i class="fa fa-shopping-bag me-2 text-primary logo-add"></i> Add to Cart
                                                                    </button>
                                                                </form>';
                                                        } else {
                                                            // Pengguna belum login, tampilkan tombol untuk membuka modal login dengan pemberitahuan
                                                            echo '
                                                            <button class="btn border border-secondary rounded-pill px-3 text-primary btn-addto" onclick="showLoginAlert()">
                                                                <i class="fa fa-shopping-bag me-2 text-primary logo-add"></i> Add to Cart
                                                            </button>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                // Tutup koneksi
                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-3" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <?php
                                // Koneksi ke database
                                include './conf/koneksi.php';

                                // Query untuk mengambil data dari tabel produk_makanan dengan kategori Non Coffe
                                // $sql = "SELECT * FROM produk_makanan WHERE category = 'Non Coffe'";
                                $sql = "SELECT * FROM produk WHERE category = 'Non Coffe'";
                                $result = $conn->query($sql);

                                // Periksa apakah ada baris data yang dikembalikan
                                if ($result->num_rows > 0) {
                                    // Output data dari setiap baris
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="admin_keisya<?php echo $row['image_url']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $row['category']; ?></div>

                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4 class="nama_menu"> <a href="?q=shop-detail" style="color:black;"><?php echo $row['product_name']; ?></a></h4>
                                                    <p><?php echo $row['description']; ?></p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><?php echo $row['price']; ?></p>
                                                        
                                                        <?php
                                                        // Koneksi ke database
                                                        include './conf/koneksi.php';

                                                        // Cek apakah pengguna sudah login
                                                        if (isset($_SESSION['username'])) {
                                                            // Pengguna sudah login, tampilkan formulir untuk menambahkan produk ke keranjang
                                                            echo '
                                                                <form action="?q=cart_add&action=add" method="post" enctype="multipart/form-data">  
                                                                    <input type="hidden" name="product_id" value="' . $row['id'] . '">
                                                                    <input type="hidden" name="image_url" value="' . $row['image_url'] . '">
                                                                    <input type="hidden" name="product_name" value="' . $row['product_name'] . '">
                                                                    <input type="hidden" name="price" value="' . $row['price'] . '">
                                                                    <input type="number" name="quantity" style="width: 50px; padding: 8px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">

                                                                    <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary btn-addto">
                                                                        <i class="fa fa-shopping-bag me-2 text-primary logo-add"></i> Add to Cart
                                                                    </button>
                                                                </form>';
                                                        } else {
                                                            // Pengguna belum login, tampilkan tombol untuk membuka modal login dengan pemberitahuan
                                                            echo '
                                                            <button class="btn border border-secondary rounded-pill px-3 text-primary btn-addto" onclick="showLoginAlert()">
                                                                <i class="fa fa-shopping-bag me-2 text-primary logo-add"></i> Add to Cart
                                                            </button>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                // Tutup koneksi
                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab-4" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <?php
                                // Koneksi ke database
                                include './conf/koneksi.php';

                                // Query untuk mengambil data dari tabel produk_makanan dengan kategori Non Coffe
                                // $sql = "SELECT * FROM produk_makanan WHERE category = 'Non Coffe'";
                                $sql = "SELECT * FROM produk WHERE category = 'Food'";
                                $result = $conn->query($sql);

                                // Periksa apakah ada baris data yang dikembalikan
                                if ($result->num_rows > 0) {
                                    // Output data dari setiap baris
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="admin_keisya<?php echo $row['image_url']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $row['category']; ?></div>

                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4 class="nama_menu"> <a href="?q=shop-detail" style="color:black;"><?php echo $row['product_name']; ?></a></h4>
                                                    <p><?php echo $row['description']; ?></p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><?php echo $row['price']; ?></p>
                                                        <?php
                                                        // Koneksi ke database
                                                        include './conf/koneksi.php';
                                                        // Cek apakah pengguna sudah login
                                                        if (isset($_SESSION['username'])) {
                                                            // Pengguna sudah login, tampilkan formulir untuk menambahkan produk ke keranjang
                                                            echo '
                                                                <form action="?q=cart_add&action=add" method="post" enctype="multipart/form-data">  
                                                                    <input type="hidden" name="product_id" value="' . $row['id'] . '">
                                                                    <input type="hidden" name="image_url" value="' . $row['image_url'] . '">
                                                                    <input type="hidden" name="product_name" value="' . $row['product_name'] . '">
                                                                    <input type="hidden" name="price" value="' . $row['price'] . '">
                                                                    <input type="number" name="quantity" style="width: 50px; padding: 8px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                                                                    <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary btn-addto">
                                                                        <i class="fa fa-shopping-bag me-2 text-primary logo-add"></i> Add to Cart
                                                                    </button>
                                                                </form>';
                                                        } else {
                                                            // Pengguna belum login, tampilkan tombol untuk membuka modal login dengan pemberitahuan
                                                            echo '
                                                            <button class="btn border border-secondary rounded-pill px-3 text-primary btn-addto" onclick="showLoginAlert()">
                                                                <i class="fa fa-shopping-bag me-2 text-primary logo-add"></i> Add to Cart
                                                            </button>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                // Tutup koneksi
                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->


<!-- Vesitable Shop Start-->
<div class="container-fluid vesitable py-5">
    <div class="container py-5">
        <h1 class="mb-0">Rekomendasi Paket Bundling Best Seller</h1>
        <div class="owl-carousel vegetable-carousel justify-content-center">
            <?php
            // Koneksi ke database
            include './conf/koneksi.php';

            // Query untuk mengambil data dari tabel produk_makanan
            // $sql = "SELECT * FROM produk_minuman";
            // $sql = "SELECT * FROM produk WHERE category = 'Food'";
            $sql = "SELECT * FROM `paket`";
            $result = $conn->query($sql);

            // Periksa apakah ada baris data yang dikembalikan
            if ($result->num_rows > 0) {
                // Output data dari setiap baris
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="border border-primary rounded position-relative vesitable-item">

                        <div class="vesitable-img">
                            <img src="admin_keisya<?php echo $row['image_url']; ?>" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">
                            <?php echo $row['category']; ?></div>
                        <div class="p-4 rounded-bottom">
                            <h4 class="nama_menu"><a href="?q=shop-detail" style="color:black;"><?php echo $row['product_name']; ?></a></h4>
                            <p><?php echo $row['description']; ?></p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0"><?php echo $row['price']; ?></p>
                            <?php
                                                        // Koneksi ke database
                                                        include './conf/koneksi.php';
                                                        // Cek apakah pengguna sudah login
                                                        if (isset($_SESSION['username'])) {
                                                            // Pengguna sudah login, tampilkan formulir untuk menambahkan produk ke keranjang
                                                            echo '
                                                                <form action="?q=cart_add&action=add" method="post" enctype="multipart/form-data">  
                                                                    <input type="hidden" name="product_id" value="' . $row['id'] . '">
                                                                    <input type="hidden" name="image_url" value="' . $row['image_url'] . '">
                                                                    <input type="hidden" name="product_name" value="' . $row['product_name'] . '">
                                                                    <input type="hidden" name="price" value="' . $row['price'] . '">
                                                                    <input type="number" name="quantity" style="width: 50px; padding: 8px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                                                                    <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary btn-addto">
                                                                        <i class="fa fa-shopping-bag me-2 text-primary logo-add"></i> Add to Cart
                                                                    </button>
                                                                </form>';
                                                        } else {
                                                            // Pengguna belum login, tampilkan tombol untuk membuka modal login dengan pemberitahuan
                                                            echo '
                                                            <button class="btn border border-secondary rounded-pill px-3 text-primary btn-addto" onclick="showLoginAlert()">
                                                                <i class="fa fa-shopping-bag me-2 text-primary logo-add"></i> Add to Cart
                                                            </button>';
                                                        }
                                                        ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "0 results";
            }
            // Tutup koneksi
            $conn->close();
            ?>
        </div>
    </div>
</div>
<!-- Vesitable Shop End -->


<!-- Banner Section Start-->
<?php
// Koneksi ke database
include './conf/koneksi.php';

// Query untuk mengambil data dari tabel produk_makanan
$sql = "SELECT * FROM section4";
$result = $conn->query($sql);

// Periksa apakah ada baris data yang dikembalikan
if ($result->num_rows > 0) {
    // Output data dari setiap baris
    while ($row = $result->fetch_assoc()) {
?>
        <!-- <div class="container-fluid banner bg-secondary my-5">
            <div class="container py-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="py-4">
                            <h1 class="display-3 text-white"><?php echo $row['title']; ?></h1>
                            <p class="fw-normal display-3 text-white mb-4"><?php echo $row['title2']; ?></p>
                            <p class="mb-4 text-white"><?php echo $row['deskripsi']; ?></p>
                            <a href="?q=shop-detail" class="banner-btn btn border-2 border-white rounded-pill text-white py-3 px-5">BUY</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative">
                            <img src="admin_keisya<?php echo $row['image_url']; ?>" class="img-fluid w-100 rounded" alt="">
                            <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 110px; height: 110px; top: 0; left: 0;">
                                <div class="d-flex flex-column">
                                    <span class="h2 mb-0">50$</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
<?php
    }
} else {
    echo "0 results";
}
// Tutup koneksi
$conn->close();
?>
<!-- Banner Section End -->


<!-- Bestsaler Product Start -->
<!-- <div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h1 class="display-4">Bestseller Products</h1>
            <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which
                looks reasonable.</p>
        </div>
        <div class="row g-4">
            <?php
            // Koneksi ke database
            include './conf/koneksi.php';

            // Query untuk mengambil data dari tabel best_produk
            $sql = "SELECT * FROM best_produk";
            $result = $conn->query($sql);

            // Periksa apakah ada baris data yang dikembalikan
            if ($result->num_rows > 0) {
                // Output data dari setiap baris
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <img src="admin_keisya<?php echo $row['image_url']; ?>" class="img-fluid rounded-circle w-100" alt="Product Image">
                                </div>
                                <div class="col-6">
                                    <a href="?q=shop-detail" class="h5 reting"><?php echo $row['product_name']; ?></a>
                                    <div class="d-flex my-3">
                                        <?php
                                        $rating = $row['rating'];
                                        for ($i = 0; $i < $rating; $i++) {
                                        ?>
                                            <i class="fas fa-star text-primary bintang"></i>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        for ($i = $rating; $i < 5; $i++) {
                                        ?>
                                            <i class="fas fa-star"></i>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <h4 class="mb-3"><?php echo $row['price']; ?></h4>
                                    <a href="?q=shop-detail" class="btn border border-secondary rounded-pill px-3 text-primary btn-addto"><i class="fa fa-shopping-bag me-2 text-primary logo-add"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No records found";
            }
            // Tutup koneksi
            $conn->close();
            ?>
        </div>
    </div>
</div> -->
<!-- Bestsaler Product End -->