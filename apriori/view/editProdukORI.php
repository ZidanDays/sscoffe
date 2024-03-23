<?php
$conn = mysqli_connect('localhost', 'root', '', 'keisya_ecommerse');
if ($_POST['idx']) {
    $id = $_POST['idx'];
    $data = mysqli_query($conn, "SELECT * FROM `produk` WHERE id='$id' ");
    $row = mysqli_fetch_array($data);
    echo '<input type="hidden" name="id_produk" value="' . $id . '">';
    echo '<div class="form-group">
        <label for="">Produk</label>
        <input type="text" name="produk" value="' . $row['product_name'] . '" id="" class="form-control" required />
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <select name="category" id="category" class="form-control" required>
            <option value="Coffe" ' . ($row['category'] == 'coffe' ? 'selected' : '') . '>Coffe</option>
            <option value="Non Coffe" ' . ($row['category'] == 'non_coffe' ? 'selected' : '') . '>Non Coffe</option>
            <option value="Food" ' . ($row['category'] == 'food' ? 'selected' : '') . '>Food</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Harga</label>
        <input type="number" name="harga" value="' . $row['price'] . '" class="form-control">
    </div>
    <div class="form-group">
        <label for="">URL Gambar</label>
        <input type="text" name="image_url" value="' . $row['image_url'] . '" id="" class="form-control" required />
    </div>
    <div class="form-group">
    <label for="">Deskripsi</label>
        <input type="text" name="description" value="' . $row['description'] . '" class="form-control">
    </div>

    <div class="form-group">
    <label for="bundling">Bundling</label>
    <select name="bundling" class="form-control">
        <option value="' . $row['bundling'] . '">' . $row['bundling'] . '</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
    </div>


    <div class="form-group">
        <label for="">File</label>
        <input type="file" name="file" class="form-control">
    </div>';
    echo '<img src="../admin_keisya/' . $row['image_url'] . '" width="180px" height="180px" alt="">';

}
