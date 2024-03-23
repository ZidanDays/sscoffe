<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="?q=beranda">Home</a></li>
        <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
        <li class="breadcrumb-item active text-white">Shop</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">Menu Coffee shop</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <?php
                    include './conf/koneksi.php';
                    // Query untuk mengambil daftar kategori dari kedua tabel
                    $sql = "SELECT DISTINCT category FROM (
                    SELECT category FROM produk_makanan
                    UNION
                    SELECT category FROM produk_minuman
                    ) AS categories";

                    // Lakukan query ke database
                    $result_categories = $conn->query($sql);
                    ?>

                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <label for="fruits">Default Sorting:</label>
                            <select id="fruitlist" name="fruitlist" class="border-0 form-select-sm bg-light me-3" onchange="this.form.submit()">

                                <option value="all">All</option> <!-- Pilihan default -->
                                <?php
                                // Periksa apakah query mengembalikan baris
                                if ($result_categories->num_rows > 0) {
                                    // Loop melalui hasil query kategori
                                    while ($row_category = $result_categories->fetch_assoc()) {
                                        echo "<option value='" . $row_category['category'] . "'>" . $row_category['category'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No categories found</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <?php
                            include './conf/koneksi.php';

                            // Query untuk mengambil daftar kategori dan jumlah item dari kedua tabel
                            $sql = "SELECT category, COUNT(*) as total FROM (
                            SELECT category FROM produk_makanan
                            UNION ALL
                            SELECT category FROM produk_minuman
                            ) AS categories
                            GROUP BY category";

                            // Lakukan query ke database
                            $result_categories = $conn->query($sql);
                            ?>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Category Produk</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                        <?php
                                        if ($result_categories->num_rows > 0) {
                                            while ($row_category = $result_categories->fetch_assoc()) {
                                                $category = $row_category['category'];
                                                $total_items = $row_category['total'];
                                        ?>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <?php echo $category; ?>
                                                        <span>(<?php echo $total_items; ?>)</span>
                                                    </div>
                                                </li>
                                        <?php
                                            }
                                        } else {
                                            echo "<li>No categories found</li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <h4 class="mb-3">Produk Pilihan</h4>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="assets/img/Espreso.jpg" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Espreso</h6>
                                        <div class="d-flex mb-2 ">
                                            <i class="fa fa-star text-secondary bintang"></i>
                                            <i class="fa fa-star text-secondary bintang"></i>
                                            <i class="fa fa-star text-secondary bintang"></i>
                                            <i class="fa fa-star text-secondary bintang"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="assets/img/Latte.jpg" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">latte</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary bintang"></i>
                                            <i class="fa fa-star text-secondary bintang"></i>
                                            <i class="fa fa-star text-secondary bintang"></i>
                                            <i class="fa fa-star text-secondary bintang"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="assets/img/Kentang goreng.jpg" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">Kentang Goreng</h6>
                                        <div class="d-flex mb-2 ">
                                            <i class="fa fa-star text-secondary bintang"></i>
                                            <i class="fa fa-star text-secondary bintang"></i>
                                            <i class="fa fa-star text-secondary bintang"></i>
                                            <i class="fa fa-star text-secondary bintang"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">2.99 $</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center my-4">
                                    <a href="?q=beranda" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100 btn-addto">View
                                        More</a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="position-relative">
                                    <img src="assets/img/bener kopi.jpg" class="img-fluid w-100 rounded" alt="">
                                    <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            <div class="row g-4 justify-content-center">
                                <?php
                                // Koneksi ke database
                                include './conf/koneksi.php';

                                if (isset($_POST['fruitlist'])) {
                                    $category = $_POST['fruitlist'];
                                } else {
                                    $category = "all"; // Set kategori default jika tidak ada yang dipilih
                                }

                                // Query untuk mengambil data dari kedua tabel jika kategori adalah "All" atau tidak ada yang dipilih
                                if ($category === "all" || $category === "Food") {
                                    $sql = "SELECT * FROM produk_makanan UNION SELECT * FROM produk_minuman";
                                } else {
                                    // Query untuk mengambil data dari tabel produk_makanan jika kategori lain dipilih
                                    $sql = "SELECT * FROM produk_makanan WHERE category = '$category'";
                                }

                                $result = $conn->query($sql);

                                // Periksa apakah ada baris data yang dikembalikan
                                if ($result->num_rows > 0) {
                                    // Output data dari setiap baris
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <div class="col-md-6 col-lg-6 col-xl-4">
                                            <div class="rounded position-relative fruite-item" data-category="<?php echo $row['category']; ?>">
                                                <div class="fruite-img">
                                                    <img src="admin_keisya<?php echo $row['image_url']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $row['category']; ?></div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4 class="nama_menu"> <a href="?q=shop-detail" style="color:black;"><?php echo $row['product_name']; ?> </a></h4>
                                                    <p><?php echo $row['description']; ?></p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><?php echo $row['price']; ?></p>
                                                        <a href="?q=shop-detail" class="btn border border-secondary rounded-pill px-3 text-primary btn-addto"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                $conn->close();
                                ?>



                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        <a href="#" class="rounded">&laquo;</a>
                                        <a href="#" class="active rounded">1</a>
                                        <a href="#" class="rounded">2</a>
                                        <a href="#" class="rounded">3</a>
                                        <a href="#" class="rounded">4</a>
                                        <a href="#" class="rounded">5</a>
                                        <a href="#" class="rounded">6</a>
                                        <a href="#" class="rounded">&raquo;</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var categorySelect = document.getElementById("fruitlist"); // Mengubah "fruits" menjadi "fruitlist"
        var fruitItems = document.querySelectorAll(".fruite-item");

        // Fungsi untuk menampilkan atau menyembunyikan item berdasarkan kategori yang dipilih
        function filterItems(selectedCategory) {
            fruitItems.forEach(function(item) {
                var itemCategory = item.getAttribute("data-category").toLowerCase();
                if (selectedCategory === "all" || itemCategory === selectedCategory) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        }

        // Tampilkan semua item saat halaman dimuat
        filterItems(categorySelect.value.toLowerCase());

        // Event listener untuk meng-handle perubahan kategori
        categorySelect.addEventListener("change", function() {
            var selectedCategory = this.value.toLowerCase();
            filterItems(selectedCategory);
        });
    });
</script>