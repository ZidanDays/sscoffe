<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Users Data</p>
                    <div class="table-responsive text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Koneksi ke database
                                include '../conf/koneksi.php';

                                // Query untuk mengambil data dari tabel users
                                $sql = "SELECT `id`, `username`, `email`, `password` FROM `users` WHERE 1";
                                $result = $conn->query($sql);

                                // Periksa apakah ada baris data yang dikembalikan
                                if ($result->num_rows > 0) {
                                    // Output data dari setiap baris
                                    $no = 1; // Untuk nomor urut
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['password']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editUserModal" onclick="setEditUserModalData('<?php echo $row['id']; ?>', '<?php echo htmlspecialchars($row['username'], ENT_QUOTES); ?>', '<?php echo $row['email']; ?>', '<?php echo $row['password']; ?>')">Edit</button>

                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal" onclick="setDeleteUserModalData('<?php echo $row['id']; ?>')">Delete</button>
                                            </td>

                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No records found</td></tr>";
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


<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk mengedit user -->
                <form id="editUserForm" action="?q=edit_user" method="POST">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="mb-3">
                        <label for="edit_username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="edit_username" name="edit_username">
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="edit_email">
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="edit_password" name="edit_password">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Delete User -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteUserForm" action="?q=delete_user" method="POST">
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
    function setEditUserModalData(id, username, email, password) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_username').value = username;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_password').value = password;
    }
</script>

<!-- DELETE -->
<script>
    function setDeleteUserModalData(id) {
        document.getElementById('delete_id').value = id;
    }
</script>