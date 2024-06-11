<?php
include '../../includes/header.php';

$id_pengajuan = $_GET['id'];

$sql = "DELETE FROM PengajuanSertifikat WHERE id_pengajuan = ?";
$params = array($id_pengajuan);
$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    header('Location: index.php');
    exit;
}