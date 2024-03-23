<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Section 4</p>
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                        data-bs-target="#addProductModal">Add Product</button>
                    <div class="table-responsive text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Title 2</th>
                                    <th>Deskription</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Koneksi ke database
                                include '../conf/koneksi.php';

                                // Query untuk mengambil data dari tabel Anda
                                $sql = "SELECT * FROM section4";
                                $result = $conn->query($sql);

                                // Periksa apakah ada baris data yang dikembalikan
                                if ($result->num_rows > 0) {
                                    // Output data dari setiap baris
                                    $no = 1; // Untuk nomor urut
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['title2']; ?></td>
                                    <td><?php echo $row['deskripsi']; ?></td>
                                    <td><img src="<?php echo $row['image_url']; ?>" alt="Image" style="width: 100px;">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#editProductModalMakanan"
                                            onclick="setEditModalData('<?php echo $row['id']; ?>', '<?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($row['title2'], ENT_QUOTES); ?>', '<?php echo $row['deskripsi']; ?>')">Edit</button>

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


<!-- Modal Edit Product -->
<div class="modal fade" id="editProductModalMakanan" tabindex="-1" aria-labelledby="editProductModalMakananLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalMakananLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk mengedit produk -->
                <form id="editProductForm" action="?q=edit_section4" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edit_title" name="edit_title">
                    </div>
                    <div class="mb-3">
                        <label for="edit_title2" class="form-label">Title 2</label>
                        <input type="text" class="form-control" id="edit_title2" name="edit_title2">
                    </div>
                    <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_deskripsi" name="edit_deskripsi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="edit_image" name="edit_image">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Product -->
<div class="modal fade" id="editProductModalMakanan" tabindex="-1" aria-labelledby="editProductModalMakananLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalMakananLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk mengedit produk -->
                <form id="editProductForm" action="?q=edit_section4" method="POST">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edit_title" name="edit_title">
                    </div>
                    <div class="mb-3">
                        <label for="edit_title2" class="form-label">Title 2</label>
                        <input type="text" class="form-control" id="edit_title2" name="edit_title2">
                    </div>
                    <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_deskripsi" name="edit_deskripsi"></textarea>
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
                <form id="deleteProductForm" action="?q=delete_section4" method="POST">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- EDIT -->
<script>
function setEditModalData(id, title, title2, deskripsi) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_title').value = title;
    document.getElementById('edit_title2').value = title2;
    document.getElementById('edit_deskripsi').value = deskripsi;
}
</script>

<!-- DELETE -->
<script>
// Function untuk mengatur ID produk yang akan dihapus
function setDeleteModalData(id) {
    document.getElementById('delete_id').value = id;
}
</script>