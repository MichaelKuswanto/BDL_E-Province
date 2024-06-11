<?php
include '../../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_instansi = $_POST['id_instansi'];
    $nama_instansi = $_POST['nama_instansi'];
    $alamat_instansi = $_POST['alamat_instansi'];
    $nomor_telepon_instansi = $_POST['nomor_telepon_instansi'];
    $email_instansi = $_POST['email_instansi'];
    $kota = $_POST['kota'];

    $sql = "INSERT INTO InstansiPemerintah 
            (id_instansi, nama_instansi, alamat_instansi, nomor_telepon_instansi, email_instansi, kota) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $params = array($id_instansi, $nama_instansi, $alamat_instansi, $nomor_telepon_instansi, $email_instansi, $kota);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        header('Location: index.php');
        exit;
    }
}
?>

<h2>Tambah Instansi Pemerintah</h2>

<form method="post" action="create.php">
    <div class="form-group">
        <label for="id_instansi">ID Instansi</label>
        <input type="text" class="form-control" id="id_instansi" name="id_instansi" required>
    </div>
    <div class="form-group">
        <label for="nama_instansi">Nama Instansi</label>
        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" required>
    </div>
    <div class="form-group">
        <label for="alamat_instansi">Alamat Instansi</label>
        <textarea class="form-control" id="alamat_instansi" name="alamat_instansi" rows="3" required></textarea>
    </div>
    <div class="form-group">
        <label for="nomor_telepon_instansi">No. Telepon Instansi</label>
        <input type="text" class="form-control" id="nomor_telepon_instansi" name="nomor_telepon_instansi" required>
    </div>
    <div class="form-group">
        <label for="email_instansi">Email Instansi</label>
        <input type="email" class="form-control" id="email_instansi" name="email_instansi" required>
    </div>
    <div class="form-group">
        <label for="kota">Kota</label>
        <input type="text" class="form-control" id="kota" name="kota">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include '../../includes/footer.php'; ?>