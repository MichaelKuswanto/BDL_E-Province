<?php include '../../includes/header.php'; ?>

<h2>Daftar Penduduk</h2>
<a href="create.php" class="btn btn-primary mb-3">Tambah Penduduk</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>NIK</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM Penduduk";
        $result = sqlsrv_query($conn, $sql);

        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['NIK'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['alamat'] . "</td>";
            echo "<td>" . $row['tanggal_lahir']->format('Y-m-d') . "</td>";
            echo "<td>" . $row['nomor_telepon'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>
                    <a href='edit.php?nik=" . $row['NIK'] . "' class='btn btn-sm btn-primary'>Edit</a>
                    <a href='delete.php?nik=" . $row['NIK'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                  </td>";
            echo "</tr>";
        }

        sqlsrv_free_stmt($result);
        ?>
    </tbody>
</table>

<?php include '../../includes/footer.php'; ?>