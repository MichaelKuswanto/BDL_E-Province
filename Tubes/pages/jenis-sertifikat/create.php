<?php
include '../../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_jenis_sertifikat = $_POST['id_jenis_sertifikat'];
    $nama_jenis_sertifikat = $_POST['nama_jenis_sertifikat'];

    $sql = "INSERT INTO JenisSertifikat (id_jenis_sertifikat, nama_jenis_sertifikat) VALUES (?, ?)";
    $params = array($id_jenis_sertifikat, $nama_jenis_sertifikat);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        header('Location: index.php');
        exit;
    }
}
?>

<h2>Tambah Jenis Sertifikat</h2>

<form method="post" action="create.php">
    <div class="form-group">
        <label for="id_jenis_sertifikat">ID Jenis Sertifikat</label>
        <input type="text" class="form-control" id="id_jenis_sertifikat" name="id_jenis_sertifikat" required>
    </div>
    <div class="form-group">
        <label for="nama_jenis_sertifikat">Nama Jenis Sertifikat</label>
        <input type="text" class="form-control" id="nama_jenis_sertifikat" name="nama_jenis_sertifikat" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include '../../includes/footer.php'; ?>