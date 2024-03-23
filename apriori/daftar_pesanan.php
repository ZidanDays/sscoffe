<?php
session_start();

// Check if the user is logged in
if (empty($_SESSION['apriori_id'])) {
    header("Location: index.php?menu=forbidden");
    exit();
}

include_once "database.php";
include_once "fungsi.php";
include_once "import/excel_reader2.php";

// Check database connection
$db_object = new database();

$sql = "SELECT * FROM checkout ORDER BY id DESC";
$query = $db_object->db_query($sql);

// Periksa apakah form dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["confirm"])) {
    // Ambil nilai order_id dari formulir
    $order_id = $_POST["order_id"];

    // Lakukan update pada database untuk mengonfirmasi pesanan
    $db_object = new database();
    $sql = "UPDATE checkout SET confirmation_status = 1 WHERE id = '$order_id'";
    $params = array(':order_id' => $order_id);
    $db_object->db_query($sql);

    // Redirect kembali ke halaman sebelumnya atau halaman lain yang sesuai
    echo '<script>';
    echo 'window.location.href = "?menu=daftar_pesanan";';
    echo '</script>';

    exit();
}

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-money-bill-wave"></i> Data Penjualan</h1>
    <!-- <a href="?menu=data_transaksi" class="btn btn-secondary"><i class="fa fa-arrow-circle-left"></i> Kembali</a> -->
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger"><i class="fas fa-fw fa-edit"></i> Daftar Pesanan</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Catatan Pesanan</th>
                        <th>Nomor Meja</th>
                        <th>Tanggal Pesanan</th>
                        <!-- <th>ID Bulan</th> -->
                        <th>Tahun</th>
                        <th>Jam</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Bukti Pembayaran</th>
                        <!-- <th>URL Gambar</th> -->
                        <th>Konfirmasi Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                <?php
// Inisialisasi tanggal pesanan saat ini
$currentDate = null;

foreach ($query as $data) :
    // Ambil tanggal pesanan
    $orderDate = $data['order_date'];

    // Set locale ke bahasa Indonesia
    setlocale(LC_TIME, 'id_ID');

    // Konversi tanggal menjadi hari
    $orderDay = strftime('%A', strtotime($orderDate));

    // Jika tanggal pesanan berbeda, tambahkan kategori baru
    if ($orderDate != $currentDate) {
        echo '<tr><td colspan="14" style="background-color: #f0f0f0;"><strong>' . $orderDay . ', ' . $orderDate . '</strong></td></tr>';
        $currentDate = $orderDate;
    }
?>

                    <tr>
                        <td>No</td>
                        <td><?= htmlspecialchars($data['id']); ?></td>
                        <td><?= htmlspecialchars($data['first_name'] . ' ' . $data['last_name']); ?></td>
                        <td><?= htmlspecialchars($data['order_notes']); ?></td>
                        <td><?= htmlspecialchars($data['table_number']); ?></td>
                        <td><?= htmlspecialchars($data['order_date']); ?></td>
                        <!-- <td><?= htmlspecialchars($data['id_bulan']); ?></td> -->
                        <td><?= htmlspecialchars($data['tahun']); ?></td>
                        <td><?= htmlspecialchars($data['jam']); ?></td>
                        <td><?= htmlspecialchars($data['product_id']); ?></td>
                        <td><?= htmlspecialchars($data['product_name']); ?></td>
                        <td>Rp.<?= htmlspecialchars($data['price']); ?></td>
                        <td><?= htmlspecialchars($data['quantity']); ?></td>
                        <td>
                            <a href="../uploads/transfer/<?= htmlspecialchars($data['transfer_proof']); ?>" target="_blank">
                                <img src="../uploads/transfer/<?= htmlspecialchars($data['transfer_proof']); ?>" style="width: 100%; display: block; margin: 0 auto;">
                            </a>
                        </td>

                        <!-- <td><?= htmlspecialchars($data['image_url']); ?></td> -->
                        <td>
                            <?php if ($data['confirmation_status'] == 0 && $data['quantity'] == NULL) : ?>
                                <form method="post" action="">
                                    <input type="hidden" name="order_id" value="<?= $data['id']; ?>">
                                </form>
                            <?php elseif ($data['confirmation_status'] == 0) : ?>
                                <form method="post" action="">
                                    <input type="hidden" name="order_id" value="<?= $data['id']; ?>">
                                    <button type="submit" name="confirm" class="btn btn-warning">Konfirmasi</button>
                                </form>
                            <?php else : ?>
                                <span class="badge badge-success">Sudah Dikonfirmasi</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
