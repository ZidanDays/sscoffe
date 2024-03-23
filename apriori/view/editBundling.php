<?php
$conn = mysqli_connect('localhost', 'root', '', 'keisya_ecommerse');
if (isset($_POST['idx'])) {
    $id = $_POST['idx'];
    $data = mysqli_query($conn, "SELECT * FROM `bundling` WHERE id_bundling='$id' ");
    $row = mysqli_fetch_array($data);
    ?>
    <input type="hidden" name="id_produk" value="<?php echo $id; ?>">
    <div class="form-group">
        <label for="produk">Produk</label>
        <input type="text" name="produk" value="<?php echo $row['product_name']; ?>" id="produk" class="form-control" required />
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <select name="category" id="category" class="form-control" required>
            <option value="Coffe" <?php echo ($row['category'] == 'Coffe' ? 'selected' : ''); ?>>Coffe</option>
            <option value="Non Coffe" <?php echo ($row['category'] == 'Non Coffe' ? 'selected' : ''); ?>>Non Coffe</option>
            <option value="Food" <?php echo ($row['category'] == 'Food' ? 'selected' : ''); ?>>Food</option>
        </select>
    </div>
    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" name="harga" value="<?php echo $row['price']; ?>" id="harga" class="form-control">
    </div>
    <div class="form-group">
        <label for="image_url">URL Gambar</label>
        <input type="text" name="image_url" value="<?php echo $row['image_url']; ?>" id="image_url" class="form-control" required />
    </div>
    <div class="form-group">
        <label for="description">Deskripsi</label>
        <input type="text" name="description" value="<?php echo $row['description']; ?>" id="description" class="form-control">
    </div>

    <div class="form-group">
        <label for="bundling">Bundling</label>
        <select name="bundling" id="bundling" class="form-control">
            <option value="<?php echo $row['bundling']; ?>"><?php echo $row['bundling']; ?></option>
            <option value="0">Remove</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
    </div>

    <div class="form-group">
        <label for="file">File</label>
        <input type="file" name="file" id="file" class="form-control">
    </div>
    <img src="../admin_keisya/<?php echo $row['image_url']; ?>" width="180px" height="180px" alt="">
<?php } ?>
