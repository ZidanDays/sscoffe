<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Best Products</p>
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                        data-bs-target="#addProductModal">Add Product</button>
                    <div class="table-responsive text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Rating</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Koneksi ke database
                                include '../conf/koneksi.php';

                                // Query untuk mengambil data dari tabel best_produk
                                $sql = "SELECT * FROM best_produk";
                                $result = $conn->query($sql);

                                // Periksa apakah ada baris data yang dikembalikan
                                if ($result->num_rows > 0) {
                                    // Output data dari setiap baris
                                    $no = 1; // Untuk nomor urut
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><img src="<?php echo $row['image_url']; ?>" alt="Product Image"
                                            style="width: 100px;"></td>
                                    <td><?php echo $row['rating']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#editProductModal"
                                            onclick="setEditModalData('<?php echo $row['id']; ?>',
                                            '<?php echo htmlspecialchars($row['product_name'], ENT_QUOTES); ?>',
                                            '<?php echo $row['rating']; ?>', '<?php echo $row['price']; ?>')">Edit</button>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteProductModal"
                                            onclick="setDeleteModalData('<?php echo $row['id']; ?>')">Delete</button>


                                    </td>
                                </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No records found</td></tr>";
                                }
                                // Tutup koneksi
                                $conn->close();
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Product -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambahkan produk -->
                <form action="?q=add_bestproduk" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName">
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="productImage">
                    </div>
                    <div class="mb-3">
                        <label for="productRating" class="form-label">Rating</label>
                        <input type="number" class="form-control" id="productRating" name="productRating" min="1"
                            max="5">
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="text" class="form-control" id="productPrice" name="productPrice">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Product -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk mengedit produk -->
                <form id="editProductForm" action="?q=edit_bestproduk" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="mb-3">
                        <label for="edit_productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="edit_productName" name="edit_productName">
                    </div>
                    <div class="mb-3">
                        <label for="edit_image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="edit_image" name="edit_image">
                    </div>
                    <div class="mb-3">
                        <label for="edit_rating" class="form-label">Rating</label>
                        <input type="number" class="form-control" id="edit_rating" name="edit_rating">
                    </div>
                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="edit_price" name="edit_price">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Product -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product?</p>
                <!-- Form untuk menghapus produk -->
                <form id="deleteProductForm" action="?q=delete_bestproduk" method="POST">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- EDIT -->
<script>
function setEditModalData(id, productName, rating, price) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_productName').value = productName;
    document.getElementById('edit_rating').value = rating;
    document.getElementById('edit_price').value = price;
}
</script>

<!-- DELETE -->
<script>
function setDeleteModalData(id) {
    document.getElementById('delete_id').value = id;
}
</script>