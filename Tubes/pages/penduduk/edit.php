<?php
include '../../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $email = $_POST['email'];

    $sql = "UPDATE Penduduk SET nama = ?, alamat = ?, tanggal_lahir = ?, nomor_telepon = ?, email = ? WHERE NIK = ?";
    $params = array($nama, $alamat, $tanggal_lahir, $nomor_telepon, $email, $nik);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        header('Location: index.php');
        exit;
    }
}

$nik = $_GET['nik'];
$sql = "SELECT * FROM Penduduk WHERE NIK = ?";
$params = array($nik);
$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
sqlsrv_free_stmt($result);
?>

<h2>Edit Penduduk</h2>

<form method="post" action="edit.php">
    <input type="hidden" name="nik" value="<?php echo $row['NIK']; ?>">
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" required><?php echo $row['alamat']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $row['tanggal_lahir']->format('Y-m-d'); ?>" required>
    </div>
    <div class="form-group">
        <label for="nomor_telepon">Nomor Telepon</label>
        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?php echo $row['nomor_telepon']; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include '../../includes/footer.php'; ?>