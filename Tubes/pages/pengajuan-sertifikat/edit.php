<?php
include '../../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pengajuan = $_POST['id_pengajuan'];
    $nik = $_POST['nik'];
    $id_instansi = $_POST['id_instansi'];
    $jenis_sertifikat = $_POST['jenis_sertifikat'];
    $request_date = $_POST['request_date'];
    $finish_date = $_POST['finish_date'] ? $_POST['finish_date'] : null;
    $status_sertifikat = $_POST['status_sertifikat'];
    $catatan = $_POST['catatan'];
    $syarat_pengajuan = $_POST['syarat_pengajuan'];

    $sql = "UPDATE PengajuanSertifikat SET NIK = ?, id_instansi = ?, jenis_sertifikat = ?, request_date = ?, finish_date = ?, status_sertifikat = ?, catatan = ?, syarat_pengajuan = ? WHERE id_pengajuan = ?";
    $params = array($nik, $id_instansi, $jenis_sertifikat, $request_date, $finish_date, $status_sertifikat, $catatan, $syarat_pengajuan, $id_pengajuan);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        header('Location: index.php');
        exit;
    }
}

$id_pengajuan = $_GET['id'];
$sql = "SELECT * FROM PengajuanSertifikat WHERE id_pengajuan = ?";
$params = array($id_pengajuan);
$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
sqlsrv_free_stmt($result);
?>

<h2>Edit Pengajuan Sertifikat</h2>

<form method="post" action="edit.php">
    <input type="hidden" name="id_pengajuan" value="<?php echo $row['id_pengajuan']; ?>">
    <div class="form-group">
        <label for="nik">NIK</label>
        <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $row['NIK']; ?>" required>
    </div>
    <div class="form-group">
        <label for="id_instansi">ID Instansi</label>
        <input type="text" class="form-control" id="id_instansi" name="id_instansi" value="<?php echo $row['id_instansi']; ?>" required>
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

            while ($row_jenis = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $selected = ($row_jenis['id_jenis_sertifikat'] == $row['jenis_sertifikat']) ? 'selected' : '';
                echo "<option value='" . $row_jenis['id_jenis_sertifikat'] . "' " . $selected . ">" . $row_jenis['nama_jenis_sertifikat'] . "</option>";
            }

            sqlsrv_free_stmt($result);
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="request_date">Tanggal Pengajuan</label>
        <input type="date" class="form-control" id="request_date" name="request_date" value="<?php echo $row['request_date']->format('Y-m-d'); ?>" required>
    </div>
    <div class="form-group">
        <label for="finish_date">Tanggal Selesai</label>
        <input type="date" class="form-control" id="finish_date" name="finish_date" value="<?php echo $row['finish_date'] ? $row['finish_date']->format('Y-m-d') : ''; ?>">
    </div>
    <div class="form-group">
        <label for="status_sertifikat">Status Sertifikat</label>
        <input type="text" class="form-control" id="status_sertifikat" name="status_sertifikat" value="<?php echo $row['status_sertifikat']; ?>" required>
    </div>
    <div class="form-group">
        <label for="catatan">Catatan</label>
        <textarea class="form-control" id="catatan" name="catatan"><?php echo $row['catatan']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="syarat_pengajuan">Syarat Pengajuan</label>
        <textarea class="form-control" id="syarat_pengajuan" name="syarat_pengajuan"><?php echo $row['syarat_pengajuan']; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include '../../includes/footer.php'; ?>