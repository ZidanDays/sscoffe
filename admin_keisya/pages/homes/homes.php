<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Order Details</p>
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                        data-bs-target="#addProductModal">Add Product</button>
                    <div class="table-responsive text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Image</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../conf/koneksi.php';

                                // Query untuk mengambil data dari tabel banners
                                $sql = "SELECT * FROM carousel";
                                $result = $conn->query($sql);

                                // Periksa apakah ada hasil dari query
                                if ($result->num_rows > 0) {
                                    // Output data dari setiap baris
                                    $no = 1;
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><img src="<?php echo $row['image_url']; ?>" alt="Slide Image" class="img-fluid"
                                            style="max-width: 600px;"></td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#editProductModal"
                                            onclick="document.getElementById('editProductId').value = <?php echo $row['id']; ?>; document.getElementById('editProductTitle').value = '<?php echo $row['title']; ?>';">Edit
                                            Product</button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteProductModal"
                                            onclick="document.getElementById('deleteProductId').value = <?php echo $row['id']; ?>;">Delete
                                            Product</button>
                                    </td>

                                </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>No konten available</td></tr>";
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

<!-- Modal add produk -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambahkan produk -->
                <form action="?q=add_produk" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productTitle" class="form-label">Product Title</label>
                        <input type="text" class="form-control" id="productTitle" name="productTitle">
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="productImage">
                    </div>

                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Produk -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk mengedit produk -->
                <form action="?q=edit_produk" method="POST" enctype="multipart/form-data">
                    <!-- Input field untuk ID produk yang sedang diedit (hidden input) -->
                    <input type="hidden" id="editProductId" name="editProductId">
                    <div class="mb-3">
                        <label for="editProductTitle" class="form-label">Product Title</label>
                        <input type="text" class="form-control" id="editProductTitle" name="editProductTitle">
                    </div>
                    <!-- Input field untuk unggah gambar produk baru -->
                    <div class="mb-3">
                        <label for="editProductImage" class="form-label">Upload New Product Image</label>
                        <input type="file" class="form-control" id="editProductImage" name="editProductImage">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Delete Produk -->
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
            </div>
            <div class="modal-footer">
                <form action="?q=delete_produk" method="POST">
                    <input type="hidden" id="deleteProductId" name="deleteProductId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>