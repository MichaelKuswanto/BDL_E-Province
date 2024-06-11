<?php
include '../../includes/header.php'; ?>

<h2>Daftar Instansi Pemerintah</h2>
<a href="create.php" class="btn btn-primary mb-3">Tambah Instansi Pemerintah</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID Instansi</th>
            <th>Nama Instansi</th>
            <th>Alamat Instansi</th>
            <th>No. Telepon</th>
            <th>Email</th>
            <th>Kota</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM InstansiPemerintah";
        $result = sqlsrv_query($conn, $sql);

        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id_instansi'] . "</td>";
            echo "<td>" . $row['nama_instansi'] . "</td>";
            echo "<td>" . $row['alamat_instansi'] . "</td>";
            echo "<td>" . $row['nomor_telepon_instansi'] . "</td>";
            echo "<td>" . $row['email_instansi'] . "</td>";
            echo "<td>" . $row['kota'] . "</td>";
            echo "<td>
                    <a href='edit.php?id=" . $row['id_instansi'] . "' class='btn btn-sm btn-primary'>Edit</a>
                    <a href='delete.php?id=" . $row['id_instansi'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                </td>";
            echo "</tr>";
        }

        sqlsrv_free_stmt($result);
        ?>
    </tbody>
</table>

<?php include '../../includes/footer.php'; ?>