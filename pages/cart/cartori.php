<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="?q=beranda">Home</a></li>
        <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">

            <!-- Tampilkan detail item -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Nama Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Koneksi ke database
                    include './conf/koneksi.php';

                    // Ambil ID pengguna dari session
                    $user_id = $_SESSION['user_id'];

                    // Query untuk mengambil data dari tabel keranjang_belanja hanya untuk pengguna yang sedang login
                    $sql_cart = "SELECT * FROM keranjang_belanja WHERE user_id = '$user_id'";
                    $result_cart = $conn->query($sql_cart);

                    // Inisialisasi subtotal dan total
                    $subtotal = 0;
                    $grandtotal = 0;

                    // Periksa apakah ada baris data yang dikembalikan
                    if ($result_cart->num_rows > 0) {
                        // Output data dari setiap baris
                        while ($row_cart = $result_cart->fetch_assoc()) {
                            // Hitung subtotal dan total untuk setiap item
                            $subtotal += ($row_cart['price'] * $row_cart['quantity']);
                            $grandtotal += ($row_cart['price'] * $row_cart['quantity']);
                    ?>
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="admin_keisya<?php echo $row_cart['image_url']; ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo $row_cart['product_name']; ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" id="price_<?php echo $row_cart['id']; ?>">
                                        <?php echo $row_cart['price']; ?> $</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <!-- Tombol untuk mengurangi jumlah jika diperlukan -->
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="changeQuantity(<?php echo $row_cart['id']; ?>, -1)">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" id="quantity_<?php echo $row_cart['id']; ?>" class="form-control form-control-sm text-center border-0" value="<?php echo $row_cart['quantity']; ?>" onchange="updateTotal(<?php echo $row_cart['id']; ?>)">
                                        <div class="input-group-btn">
                                            <!-- Tombol untuk menambah jumlah jika diperlukan -->
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="changeQuantity(<?php echo $row_cart['id']; ?>, 1)">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" id="total_<?php echo $row_cart['id']; ?>">
                                        <?php echo $row_cart['price'] * $row_cart['quantity']; ?> $</p>
                                </td>
                                <td>
                                    <form action="?q=cart_delete&action=delete" method="post">
                                        <input type="hidden" name="cart_id" value="<?php echo $row_cart['id']; ?>">
                                        <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                </tbody>
        <?php
                        }
                    } else {
                        echo "Keranjang belanja kosong.";
                    }

                    // Tutup koneksi
                    $conn->close();
        ?>
            </table>

        </div>

        <!-- Tampilkan subtotal dan total -->
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Total <span class="fw-normal">Belanja</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0" id="grandtotalsub">
                                <?php echo $subtotal; ?> $
                            </p>
                        </div>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 me-4" style="color: black;">
                            <?php echo $grandtotal; ?> $
                        </p>
                    </div>
                    <!-- Form untuk checkout -->
                    <form action="?q=chackout" method="post">
                        <input type="hidden" name="grandtotal" value="<?php echo $grandtotal; ?>">
                        <?php
                        // Koneksi ke database
                        include './conf/koneksi.php';

                        // Ambil ID pengguna dari session
                        $user_id = $_SESSION['user_id'];

                        // Query untuk mengambil data dari tabel keranjang_belanja hanya untuk pengguna yang sedang login
                        $sql_cart = "SELECT * FROM keranjang_belanja WHERE user_id = '$user_id'";
                        $result_cart = $conn->query($sql_cart);

                        // Output data dari setiap baris
                        while ($row_cart = $result_cart->fetch_assoc()) {
                            // Sisipkan input tersembunyi untuk setiap produk dalam keranjang
                            echo '<input type="hidden" name="product_ids[]" value="' . $row_cart['product_id'] . '">';
                            echo '<input type="hidden" name="product_names[]" value="' . $row_cart['product_name'] . '">';
                            echo '<input type="hidden" name="prices[]" value="' . $row_cart['price'] . '">';
                            echo '<input type="hidden" name="quantities[]" value="' . $row_cart['quantity'] . '">';
                            echo '<input type="hidden" name="image_urls[]" value="' . $row_cart['image_url'] . '">';
                        }
                        ?>
                        <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary btn-addto" name="proceed_checkout">
                            Proceed Checkout
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->


<script>
    function changeQuantity(cartId, change) {
        var quantityElement = document.getElementById('quantity_' + cartId);
        var quantity = parseInt(quantityElement.value);
        if (isNaN(quantity)) {
            quantity = 0;
        }
        quantity += change;
        if (quantity < 0) {
            quantity = 0;
        }
        quantityElement.value = quantity;
        updateTotal(cartId); // Panggil fungsi updateTotal untuk menghitung ulang total
        updateSubtotal(); // Panggil fungsi updateSubtotal untuk menghitung ulang grandtotalsub
    }

    function updateTotal(cartId) {
        var quantity = parseInt(document.getElementById('quantity_' + cartId).value);
        var price = parseFloat(document.getElementById('price_' + cartId).innerText);
        var totalElement = document.getElementById('total_' + cartId);
        var total = quantity * price;
        totalElement.innerText = total.toFixed(2); // Tampilkan total dengan dua angka desimal
    }

    function updateSubtotal() {
        var grandtotalsub = 0;
        var totalElements = document.querySelectorAll('[id^="total_"]');
        totalElements.forEach(function(totalElement) {
            grandtotalsub += parseFloat(totalElement.innerText);
        });

        var subtotalElement = document.getElementById('grandtotalsub');
        subtotalElement.innerText = grandtotalsub.toFixed(2) + " $";

    }

    // Panggil updateTotal untuk setiap item keranjang untuk menginisialisasi nilai total
    var totalElements = document.querySelectorAll('[id^="total_"]');
    totalElements.forEach(function(totalElement) {
        var cartId = totalElement.id.split('_')[1];
        updateTotal(cartId);
    });
</script>