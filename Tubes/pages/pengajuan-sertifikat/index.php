<?php include '../../includes/header.php'; ?>

<h2>Daftar Pengajuan Sertifikat</h2>
<a href="create.php" class="btn btn-primary mb-3">Tambah Pengajuan Sertifikat</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID Pengajuan</th>
            <th>NIK</th>
            <th>ID Instansi</th>
            <th>Jenis Sertifikat</th>
            <th>Tanggal Pengajuan</th>
            <th>Tanggal Selesai</th>
            <th>Status Sertifikat</th>
            <th>Catatan</th>
            <th>Syarat Pengajuan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT ps.id_pengajuan, ps.NIK, ps.id_instansi, js.nama_jenis_sertifikat, ps.request_date, ps.finish_date, ps.status_sertifikat, ps.catatan, ps.syarat_pengajuan
                FROM PengajuanSertifikat ps
                JOIN JenisSertifikat js ON ps.jenis_sertifikat = js.id_jenis_sertifikat";
        $result = sqlsrv_query($conn, $sql);

        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id_pengajuan'] . "</td>";
            echo "<td>" . $row['NIK'] . "</td>";
            echo "<td>" . $row['id_instansi'] . "</td>";
            echo "<td>" . $row['nama_jenis_sertifikat'] . "</td>";
            echo "<td>" . $row['request_date']->format('Y-m-d') . "</td>";
            echo "<td>" . ($row['finish_date'] ? $row['finish_date']->format('Y-m-d') : '-') . "</td>";
            echo "<td>" . $row['status_sertifikat'] . "</td>";
            echo "<td>" . $row['catatan'] . "</td>";
            echo "<td>" . $row['syarat_pengajuan'] . "</td>";
            echo "<td>
                    <a href='edit.php?id=" . $row['id_pengajuan'] . "' class='btn btn-sm btn-primary'>Edit</a>
                    <a href='delete.php?id=" . $row['id_pengajuan'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                  </td>";
            echo "</tr>";
        }

        sqlsrv_free_stmt($result);
        ?>
    </tbody>
</table>

<?php include '../../includes/footer.php'; ?>