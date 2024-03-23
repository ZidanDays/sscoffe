<?php
// $conn = mysqli_connect('localhost', 'root', '', 'dm_apriori');
$conn = mysqli_connect('localhost', 'root', '', 'keisya_ecommerse');

if (isset($_POST['inputProduk'])) {
    $produk = $_POST['produk'];
    $harga = $_POST['harga'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'JPG');
    $nama = './uploads/produk/' . $_FILES['file']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $cekProduk = mysqli_query($conn, "SELECT * FROM paket WHERE product_name LIKE '%" . $produk . "%'");
    
    if (mysqli_num_rows($cekProduk) > 0) {
        $pesan = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf !</strong> Produk ' . $produk . ' Sudah Ada.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    } else {
        if (empty($nama)) {
            $input = mysqli_query($conn, "INSERT INTO paket(`product_name`, `description`, `price`, `category`) VALUES ('$produk','$description','$harga','$category')");
            
            if ($input) {
                $pesan = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Berhasil!</strong> Menginput data Produk ' . $produk . '.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
            } else {
                $pesan = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal1 !</strong> Terjadi Kesalahan.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
            }
        } else {
            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                if ($ukuran < 1044070) {
                    move_uploaded_file($file_tmp, '../admin_keisya/uploads/produk/' . $_FILES['file']['name']);
                    $input = mysqli_query($conn, "INSERT INTO paket(`product_name`, `price`, `description`, `category`, `image_url`) VALUES ('$produk','$harga','$description','$category','$nama')");
                    
                    if ($input) {
                        $pesan = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Berhasil!</strong> Menginput data Produk ' . $produk . '.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                    } else {
                        $pesan = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal2 !</strong> Terjadi Kesalahan.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                    }
                } else {
                    $pesan = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal3 !</strong> UKURAN FILE TERLALU BESAR.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                }
            } else {
                $pesan = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal4 !</strong> EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            }
        }
    }
}
elseif (isset($_POST['edit'])) {
    $id_produk = $_POST['id_produk'];
    $produk = $_POST['produk'];
    $harga = $_POST['harga'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $bundling = $_POST['bundling'];
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'JPG');
    $nama = './uploads/produk/' . $_FILES['file']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (empty($nama)) {
        // mysqli_query($conn, "INSERT INTO `bundling` (`id_bundling`, `id_product`, `product_name`, `price`, `description`, `category`, `bundling`) VALUES ('', '$id_produk', '$produk', '$harga', '$description', '$category', '$bundling')");
        $edit = mysqli_query($conn, "UPDATE paket SET `product_name`='$produk', `price`='$harga', `description`='$description', `category`='$category', `bundling`='$bundling' WHERE id='$id_produk'");
    
        if ($edit) {
            $pesan = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> Mengubah data Produk ' . $produk . '.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        } else {
            $pesan = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal !</strong> Terjadi Kesalahan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    } else {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                // move_uploaded_file($file_tmp, '../admin_keisya/' . $nama);
                move_uploaded_file($file_tmp, '../admin_keisya/uploads/produk/' . $nama);
                // mysqli_query($conn, "INSERT INTO `bundling` (`id_bundling`, `id_product`, `product_name`, `price`, `description`, `category`, `bundling`) VALUES ('', '$id_produk', '$produk', '$harga', '$description', '$category', '$bundling')");
                $edit = mysqli_query($conn, "UPDATE paket SET `product_name`='$produk', `price`='$harga', `description`='$description', `category`='$category', `bundling`='$bundling',  `image_url`='$nama' WHERE id='$id_produk'");
    
                if ($edit) {
                    $pesan = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> Mengubah data Produk ' . $produk . '.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                } else {
                    $pesan = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal !</strong> Terjadi Kesalahan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                }
            } else {
                $pesan = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Gagal !</strong> UKURAN FILE TERLALU BESAR.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
            }
        } else {
            $pesan = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal !</strong> EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }
    
    echo $pesan;
    
    if (isset($pesan)) {
        echo '<script>window.location.href = "?menu=produk";</script>';
    }
    
}

 else {
    $pesan = '';
}
if ($_SESSION['apriori_level'] == "2") {
    $insert = '';
} else {
    $insert = '<!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Input Produk
    </button><br><br>';
}
echo $insert;
?>

<?php
if (!empty($pesan)) {
    echo $pesan;
}
?>
<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-danger"><i class="fa fa-table"></i> Daftar Produk Penjualan</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-info text-white">
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Paket</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['edit'])) {
                    $id_produk  = $_POST['id_produk'];
                    // $data = mysqli_query($conn, "SELECT * FROM paket WHERE id_produk='$id_produk' ");
                    $data = mysqli_query($conn, "SELECT * FROM paket WHERE id='$id_produk' ");
                } else {
                    // $data = mysqli_query($conn, "SELECT * FROM paket");
                    $data = mysqli_query($conn, "SELECT * FROM paket");
                }
                $no = 1;
                while ($row = mysqli_fetch_array($data)) {
                    if ($_SESSION['apriori_level'] == "1") {
                        $edit = '<a class="btn btn-success" title="Edit" href="#editProduk" data-toggle="modal" data-id="' . $row['id'] . '">Edit</a>';
                        $hapus = ' <a onClick=\'return confirm("Anda Yakin Menghapus Produk Ini?")\' href="index.php?hapusPaket=' . $row['id'] . '" class="btn btn-danger">Delete</a>';
                    } else {
                        $edit = 'None';
                        $hapus = 'None';
                    }
                    echo '<tr>
                        <td>' . $no . '</td>
                        <td>' . $row['product_name'] . '</td>
                        <td>' . $row['category'] . '</td>
                        <td>' . "Rp" . number_format($row['price'], 0, ',', '.') . '</td>
                        <td>' . $row['description'] . '</td>
                        <td>' . $row['bundling'] . '</td>
                        <td>' . "<img src='../admin_keisya/" . $row['image_url'] . "' width='180px' height='180px'>" . '</td>
                        <td>
                        ' . $edit . '' . $hapus . '
                        </td>
                    </tr>';
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Data Penjualan Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="produk">Produk</label>
                        <input type="text" name="produk" id="" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control" required>
                            <option value="food">Food</option>
                            <option value="drink">Drink</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" name="file" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="description">description</label>
                        <input type="text" name="description" id="" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="inputProduk" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit  -->
<div class="modal fade" id="editProduk" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i> Update Produk</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="data-produk"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="edit" class="btn btn-primary">
                        Simpan</button>
                    <button type="button" class="btn btn-danger" name="reset" data-dismiss="modal">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal edit -->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    //select edit data 
    $(document).ready(function() {
        $('#editProduk').on('show.bs.modal', function(e) {
            var idx = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type: 'post',
                url: 'view/editPaket.php',
                data: 'idx=' + idx,
                success: function(data) {
                    $('.data-produk').html(data); //menampilkan data ke dalam modal
                }
            });
        });
    });
    //end select data
</script>