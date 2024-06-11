<?php
include '../../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_jenis_sertifikat = $_POST['id_jenis_sertifikat'];
    $nama_jenis_sertifikat = $_POST['nama_jenis_sertifikat'];

    $sql = "UPDATE JenisSertifikat SET nama_jenis_sertifikat = ? WHERE id_jenis_sertifikat = ?";
    $params = array($nama_jenis_sertifikat, $id_jenis_sertifikat);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        header('Location: index.php');
        exit;
    }
}

$id_jenis_sertifikat = $_GET['id'];
$sql = "SELECT * FROM JenisSertifikat WHERE id_jenis_sertifikat = ?";
$params = array($id_jenis_sertifikat);
$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
sqlsrv_free_stmt($result);
?>

<h2>Edit Jenis Sertifikat</h2>

<form method="post" action="edit.php">
    <input type="hidden" name="id_jenis_sertifikat" value="<?php echo $row['id_jenis_sertifikat']; ?>">
    <div class="form-group">
        <label for="nama_jenis_sertifikat">Nama Jenis Sertifikat</label>
        <input type="text" class="form-control" id="nama_jenis_sertifikat" name="nama_jenis_sertifikat" value="<?php echo $row['nama_jenis_sertifikat']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include '../../includes/footer.php'; ?>