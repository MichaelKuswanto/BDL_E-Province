<?php include '../../includes/header.php'; ?>

<h2>Daftar Sertifikat</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID Sertifikat</th>
            <th>NIK</th>
            <th>ID Instansi</th>
            <th>Jenis Sertifikat</th>
            <th>Tanggal Penerbitan</th>
            <th>Tanggal Kedaluwarsa</th>
            <th>Status Sertifikat</th>
            <th>Tanggal Pengambilan</th>
            <th>Nama Pengambil</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT s.id_sertifikat, s.NIK, s.id_instansi, js.nama_jenis_sertifikat, s.tanggal_penerbitan, s.tanggal_kedaluwarsa, s.status_sertifikat, s.tgl_pengambilan, s.nama_pengambil
                FROM Sertifikat s
                JOIN JenisSertifikat js ON s.jenis_sertifikat = js.id_jenis_sertifikat";
        $result = sqlsrv_query($conn, $sql);

        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id_sertifikat'] . "</td>";
            echo "<td>" . $row['NIK'] . "</td>";
            echo "<td>" . $row['id_instansi'] . "</td>";
            echo "<td>" . $row['nama_jenis_sertifikat'] . "</td>";
            echo "<td>" . $row['tanggal_penerbitan']->format('Y-m-d') . "</td>";
            echo "<td>" . $row['tanggal_kedaluwarsa']->format('Y-m-d') . "</td>";
            echo "<td>" . $row['status_sertifikat'] . "</td>";
            echo "<td>" . ($row['tgl_pengambilan'] ? $row['tgl_pengambilan']->format('Y-m-d') : '-') . "</td>";
            echo "<td>" . $row['nama_pengambil'] . "</td>";
            echo "<td>
                    <a href='edit.php?id=" . $row['id_sertifikat'] . "' class='btn btn-sm btn-primary'>Edit</a>
                    <a href='delete.php?id=" . $row['id_sertifikat'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                  </td>";
            echo "</tr>";
        }

        sqlsrv_free_stmt($result);
        ?>
    </tbody>
</table>

<?php include '../../includes/footer.php'; ?>