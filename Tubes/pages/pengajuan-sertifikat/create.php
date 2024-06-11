<?php
include '../../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $id_instansi = $_POST['id_instansi'];
    $jenis_sertifikat = $_POST['jenis_sertifikat'];
    $request_date = $_POST['request_date'];
    $status_sertifikat = $_POST['status_sertifikat'];
    $catatan = $_POST['catatan'];
    $syarat_pengajuan = $_POST['syarat_pengajuan'];

    $sql = "EXEC InsertPengajuanSertifikat @NIK = ?, @id_instansi = ?, @jenis_sertifikat = ?, @request_date = ?, @status_sertifikat = ?, @catatan = ?, @syarat_pengajuan = ?";
    $params = array($nik, $id_instansi, $jenis_sertifikat, $request_date, $status_sertifikat, $catatan, $syarat_pengajuan);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        header('Location: index.php');
        exit;
    }
}
?>

<h2>Tambah Pengajuan Sertifikat</h2>

<form method="post" action="create.php">
    <div class="form-group">
        <label for="nik">NIK</label>
        <input type="text" class="form-control" id="nik" name="nik" required>
    </div>
    <div class="form-group">
        <label for="id_instansi">ID Instansi</label>
        <input type="text" class="form-control" id="id_instansi" name="id_instansi" required>
    </div>
    <div class="form-group">
        <label for="jenis_sertifikat">Jenis Sertifikat</label>
        <select class="form-control" id="jenis_sertifikat" name="jenis_sertifikat" required>
            <?php
            $sql = "SELECT id_jenis_sertifikat, nama_jenis_sertifikat FROM JenisSertifikat";
            $result = sqlsrv_query($conn, $sql);

            if ($result === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo "<option value='" . $row['id_jenis_sertifikat'] . "'>" . $row['nama_jenis_sertifikat'] . "</option>";
            }

            sqlsrv_free_stmt($result);
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="request_date">Tanggal Pengajuan</label>
        <input type="date" class="form-control" id="request_date" name="request_date" required>
    </div>
    <div class="form-group">
        <label for="status_sertifikat">Status Sertifikat</label>
        <input type="text" class="form-control" id="status_sertifikat" name="status_sertifikat" required>
    </div>
    <div class="form-group">
        <label for="catatan">Catatan</label>
        <textarea class="form-control" id="catatan" name="catatan"></textarea>
    </div>
    <div class="form-group">
        <label for="syarat_pengajuan">Syarat Pengajuan</label>
        <textarea class="form-control" id="syarat_pengajuan" name="syarat_pengajuan"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include '../../includes/footer.php'; ?>