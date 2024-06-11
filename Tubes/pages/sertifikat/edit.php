<?php
include '../../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_sertifikat = $_POST['id_sertifikat'];
    $nik = $_POST['nik'];
    $id_instansi = $_POST['id_instansi'];
    $jenis_sertifikat = $_POST['jenis_sertifikat'];
    $tanggal_penerbitan = $_POST['tanggal_penerbitan'];
    $tanggal_kedaluwarsa = $_POST['tanggal_kedaluwarsa'];
    $status_sertifikat = $_POST['status_sertifikat'];
    $tgl_pengambilan = $_POST['tgl_pengambilan'] ? $_POST['tgl_pengambilan'] : null;
    $nama_pengambil = $_POST['nama_pengambil'];

    $sql = "UPDATE Sertifikat SET NIK = ?, id_instansi = ?, jenis_sertifikat = ?, tanggal_penerbitan = ?, tanggal_kedaluwarsa = ?, status_sertifikat = ?, tgl_pengambilan = ?, nama_pengambil = ? WHERE id_sertifikat = ?";
    $params = array($nik, $id_instansi, $jenis_sertifikat, $tanggal_penerbitan, $tanggal_kedaluwarsa, $status_sertifikat, $tgl_pengambilan, $nama_pengambil, $id_sertifikat);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        header('Location: index.php');
        exit;
    }
}

$id_sertifikat = $_GET['id'];
$sql = "SELECT * FROM Sertifikat WHERE id_sertifikat = ?";
$params = array($id_sertifikat);
$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
sqlsrv_free_stmt($result);
?>

<h2>Edit Sertifikat</h2>

<form method="post" action="edit.php">
    <input type="hidden" name="id_sertifikat" value="<?php echo $row['id_sertifikat']; ?>">
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
        <label for="tanggal_penerbitan">Tanggal Penerbitan</label>
        <input type="date" class="form-control" id="tanggal_penerbitan" name="tanggal_penerbitan" value="<?php echo $row['tanggal_penerbitan']->format('Y-m-d'); ?>" required>
    </div>
    <div class="form-group">
        <label for="tanggal_kedaluwarsa">Tanggal Kedaluwarsa</label>
        <input type="date" class="form-control" id="tanggal_kedaluwarsa" name="tanggal_kedaluwarsa" value="<?php echo $row['tanggal_kedaluwarsa']->format('Y-m-d'); ?>" required>
    </div>
    <div class="form-group">
        <label for="status_sertifikat">Status Sertifikat</label>
        <input type="text" class="form-control" id="status_sertifikat" name="status_sertifikat" value="<?php echo $row['status_sertifikat']; ?>" required>
    </div>
    <div class="form-group">
        <label for="tgl_pengambilan">Tanggal Pengambilan</label>
        <input type="date" class="form-control" id="tgl_pengambilan" name="tgl_pengambilan" value="<?php echo $row['tgl_pengambilan'] ? $row['tgl_pengambilan']->format('Y-m-d') : ''; ?>">
    </div>
    <div class="form-group">
        <label for="nama_pengambil">Nama Pengambil</label>
        <input type="text" class="form-control" id="nama_pengambil" name="nama_pengambil" value="<?php echo $row['nama_pengambil']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include '../../includes/footer.php'; ?>