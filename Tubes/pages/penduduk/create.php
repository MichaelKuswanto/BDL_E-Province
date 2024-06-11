<?php
include '../../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $email = $_POST['email'];

    $sql = "INSERT INTO Penduduk (NIK, nama, alamat, tanggal_lahir, nomor_telepon, email) VALUES (?, ?, ?, ?, ?, ?)";
    $params = array($nik, $nama, $alamat, $tanggal_lahir, $nomor_telepon, $email);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        header('Location: index.php');
        exit;
    }
}
?>

<h2>Tambah Penduduk</h2>

<form method="post" action="create.php">
    <div class="form-group">
        <label for="nik">NIK</label>
        <input type="text" class="form-control" id="nik" name="nik" required>
    </div>
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
    </div>
    <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
    </div>
    <div class="form-group">
        <label for="nomor_telepon">Nomor Telepon</label>
        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include '../../includes/footer.php'; ?>