<?php
include '../../includes/header.php';

$id_instansi = $_GET['id'];
$sql = "SELECT * FROM InstansiPemerintah WHERE id_instansi = ?";
$params = array($id_instansi);
$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
sqlsrv_free_stmt($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_instansi = $_POST['nama_instansi'];
    $alamat_instansi = $_POST['alamat_instansi'];
    $nomor_telepon_instansi = $_POST['nomor_telepon_instansi'];
    $email_instansi = $_POST['email_instansi'];
    $kota = $_POST['kota'];

    $sql = "UPDATE InstansiPemerintah 
            SET nama_instansi = ?, alamat_instansi = ?, nomor_telepon_instansi = ?, email_instansi = ?, kota = ? 
            WHERE id_instansi = ?";
    $params = array($nama_instansi, $alamat_instansi, $nomor_telepon_instansi, $email_instansi, $kota, $id_instansi);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        header('Location: index.php');
        exit;
    }
}
?>

<h2>Edit Instansi Pemerintah</h2>

<form method="post" action="edit.php?id=<?php echo $row['id_instansi']; ?>">
    <input type="hidden" name="id_instansi" value="<?php echo $row['id_instansi']; ?>">
    <div class="form-group">
        <label for="nama_instansi">Nama Instansi</label>
        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" value="<?php echo $row['nama_instansi']; ?>" required>
    </div>
    <div class="form-group">
        <label for="alamat_instansi">Alamat Instansi</label>
        <textarea class="form-control" id="alamat_instansi" name="alamat_instansi" rows="3" required><?php echo $row['alamat_instansi']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="nomor_telepon_instansi">No. Telepon Instansi</label>
        <input type="text" class="form-control" id="nomor_telepon_instansi" name="nomor_telepon_instansi" value="<?php echo $row['nomor_telepon_instansi']; ?>" required>
    </div>
    <div class="form-group">
        <label for="email_instansi">Email Instansi</label>
        <input type="email" class="form-control" id="email_instansi" name="email_instansi" value="<?php echo $row['email_instansi']; ?>" required>
    </div>
    <div class="form-group">
        <label for="kota">Kota</label>
        <input type="text" class="form-control" id="kota" name="kota" value="<?php echo $row['kota']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include '../../includes/footer.php'; ?>