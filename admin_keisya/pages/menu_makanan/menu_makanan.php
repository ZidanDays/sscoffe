<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Produk Minuman</p>
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                        data-bs-target="#addProductModal">Add Product</button>
                    <div class="table-responsive text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Deskription</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Koneksi ke database
                                include '../conf/koneksi.php';

                                // Query untuk mengambil data produk dari tabel products
                                $sql = "SELECT * FROM produk_makanan";
                                $result = $conn->query($sql);

                                // Periksa apakah ada hasil dari query
                                if ($result->num_rows > 0) {
                                    // Output data dari setiap baris
                                    $no = 1;
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><img src="<?php echo $row['image_url']; ?>" alt="Product Image"
                                            class="img-fluid" style="max-width: 100px;"></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#editProductModalMakanan"
                                            onclick="setEditModalData('<?php echo $row['id']; ?>', '<?php echo htmlspecialchars($row['product_name'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($row['description'], ENT_QUOTES); ?>', '<?php echo $row['price']; ?>')">Edit</button>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteProductModal"
                                            onclick="setDeleteModalData('<?php echo $row['id']; ?>')">Delete</button>
                                    </td>
                                </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No products available</td></tr>";
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
                <form action="?q=add_produk_makanan" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName">
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="productDescription"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="text" class="form-control" id="productPrice" name="productPrice">
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="productImage">
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-select" id="productCategory" name="productCategory">
                            <option value="Coffe">Coffe</option>
                            <option value="Non Coffe">Non Coffe</option>
                            <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Product -->
<div class="modal fade" id="editProductModalMakanan" tabindex="-1" aria-labelledby="editProductModalLabelMakanan"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk mengedit produk -->
                <form action="?q=edit_produk_makanan" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="editProductId" name="editProductId">
                    <div class="mb-3">
                        <label for="editProductName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="editProductName" name="editProductName">
                    </div>
                    <div class="mb-3">
                        <label for="editProductDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editProductDescription"
                            name="editProductDescription"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editProductPrice" class="form-label">Price</label>
                        <input type="text" class="form-control" id="editProductPrice" name="editProductPrice">
                    </div>
                    <div class="mb-3">
                        <label for="editProductCategory" class="form-label">Category</label>
                        <select class="form-select" id="editProductCategory" name="editProductCategory">
                            <option value="Coffe">Coffe</option>
                            <option value="Non Coffe">Non Coffe</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editProductImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="editProductImage" name="editProductImage">
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
            </div>
            <div class="modal-footer">
                <form action="?q=delete_produk_makanan" method="POST">
                    <input type="hidden" id="deleteProductId" name="deleteProductId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT UNTUK EDIT DATA -->
<script>
function setEditModalData(id, productName, description, price) {
    document.getElementById('editProductId').value = id;
    document.getElementById('editProductName').value = productName;
    document.getElementById('editProductDescription').value = description;
    document.getElementById('editProductPrice').value = price;
}
</script>

<!-- SCRIPT UNTUK HAPUS -->
<script>
function setDeleteModalData(id) {
    document.getElementById('deleteProductId').value = id;
}
</script>