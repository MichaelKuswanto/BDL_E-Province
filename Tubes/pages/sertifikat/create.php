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

    $sql = "INSERT INTO Sertifikat (id_sertifikat, NIK, id_instansi, jenis_sertifikat, tanggal_penerbitan, tanggal_kedaluwarsa, status_sertifikat) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = array($id_sertifikat, $nik, $id_instansi, $jenis_sertifikat, $tanggal_penerbitan, $tanggal_kedaluwarsa, $status_sertifikat);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        header('Location: index.php');
        exit;
    }
}
?>

<h2>Tambah Sertifikat</h2>

<form method="post" action="create.php">
    <div class="form-group">
        <label for="id_sertifikat">ID Sertifikat</label>
        <input type="text" class="form-control" id="id_sertifikat" name="id_sertifikat" required>
    </div>
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
        <label for="tanggal_penerbitan">Tanggal Penerbitan</label>
        <input type="date" class="form-control" id="tanggal_penerbitan" name="tanggal_penerbitan" required>
    </div>
    <div class="form-group">
        <label for="tanggal_kedaluwarsa">Tanggal Kedaluwarsa</label>
        <input type="date" class="form-control" id="tanggal_kedaluwarsa" name="tanggal_kedaluwarsa" required>
    </div>
    <div class="form-group">
        <label for="status_sertifikat">Status Sertifikat</label>
        <input type="text" class="form-control" id="status_sertifikat" name="status_sertifikat" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include '../../includes/footer.php'; ?>