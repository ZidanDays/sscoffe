<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="?q=beranda">Home</a></li>
        <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing details</h1>
        <form action="?q=proses_chackout" method="POST" enctype="multipart/form-data">
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">First Name</label>
                                <?php
                                if (isset($_SESSION['username'])) {
                                    // Pengguna sudah login, tampilkan nama pengguna
                                    echo '<input type="text" name="first_name" class="form-control" value="' . $_SESSION['username'] . '" readonly>
                                    ';
                                } else {
                                    // Pengguna belum login, tampilkan input kosong
                                    echo '<input type="text" class="form-control" name="first_name">';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Last Name</label>
                                <input type="text" class="form-control" placeholder="(optional)" name="last_name">
                            </div>
                        </div>
                        <!-- Input Nomor Meja -->
                        <div class="form-item w-100">
                            <label class="form-label my-3">Nomor Meja</label>
                            <select class="form-select" name="table_number">
                                <?php
                                // Generate table numbers from M1 to M100
                                for ($i = 1; $i <= 100; $i++) {
                                    echo '<option value="M' . $i . '">M' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-item">
                        <textarea name="order_notes" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Order Notes (Optional)"></textarea>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loop through the posted data to display product details -->
                                <?php
                                if (isset($_POST['proceed_checkout'])) {
                                    for ($i = 0; $i < count($_POST['product_ids']); $i++) {
                                        $product_id = $_POST['product_ids'][$i];
                                        $product_name = $_POST['product_names'][$i];
                                        $price = $_POST['prices'][$i];
                                        $quantity = $_POST['quantities'][$i];
                                        $image_url = $_POST['image_urls'][$i];
                                ?>
                                        <tr>
                                            <!-- Hidden input elements to store product details -->
                                            <input type="hidden" name="product_ids[]" value="<?php echo $product_id; ?>">
                                            <input type="hidden" name="product_names[]" value="<?php echo $product_name; ?>">
                                            <input type="hidden" name="prices[]" value="<?php echo $price; ?>">
                                            <input type="hidden" name="quantities[]" value="<?php echo $quantity; ?>">
                                            <input type="hidden" name="image_urls[]" value="<?php echo $image_url; ?>">

                                            <td>
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="admin_keisya<?php echo $image_url; ?>" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </td>
                                            <td class="py-5"><?php echo $product_name; ?></td>
                                            <td class="py-5">Rp.<?php echo $price; ?></td>
                                            <td class="py-5"><?php echo $quantity; ?></td>
                                            <td class="py-5">Rp.<?php echo $price * $quantity; ?></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No items selected</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>


                    <!-- Kolom untuk menampilkan total pembelian -->
                    <?php
                    // Menerima data total dari cart.php
                    if (isset($_POST['proceed_checkout'])) {
                        $grandtotal = $_POST['grandtotal'];
                    }
                    ?>
                    <!-- Kolom untuk menampilkan total pembelian -->
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <div class="col-12">
                            <h5>Total Pembelian:</h5>
                            <?php
                            // Menampilkan total pembelian
                            echo '<p class="mb-0">Total: Rp.' . $grandtotal . '</p>';
                            ?>
                        </div>
                    </div>


                    <div class="row g-4 text-center align-items-center justify-content-center  py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Transfer-1" name="Transfer" value="Transfer">
                                <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                            </div>
                            <p class="text-start text-dark">Silahkan Melakukan Transfer pada Nomor Rekening Berikut :
                                00####</p>
                        </div>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Upload Bukti Transfer</label>
                        <input type="file" name="transfer_proof" class="form-control-file">
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <!-- Tombol "Pesan" -->
                        <button type="submit" name="pesanBtn" id="pesanBtn" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary btn-addto" style="border-radius: 30px;">Pesan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->