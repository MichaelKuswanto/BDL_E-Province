<?php include '../../includes/header.php'; ?>

<h2>Daftar Jenis Sertifikat</h2>
<a href="create.php" class="btn btn-primary mb-3">Tambah Jenis Sertifikat</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID Jenis Sertifikat</th>
            <th>Nama Jenis Sertifikat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM JenisSertifikat";
        $result = sqlsrv_query($conn, $sql);

        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id_jenis_sertifikat'] . "</td>";
            echo "<td>" . $row['nama_jenis_sertifikat'] . "</td>";
            echo "<td>
                    <a href='edit.php?id=" . $row['id_jenis_sertifikat'] . "' class='btn btn-sm btn-primary'>Edit</a>
                    <a href='delete.php?id=" . $row['id_jenis_sertifikat'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                  </td>";
            echo "</tr>";
        }

        sqlsrv_free_stmt($result);
        ?>
    </tbody>
</table>

<?php include '../../includes/footer.php'; ?>