<?php
include '../../includes/header.php';

$id_jenis_sertifikat = $_GET['id'];

$sql = "DELETE FROM JenisSertifikat WHERE id_jenis_sertifikat = ?";
$params = array($id_jenis_sertifikat);
$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    header('Location: index.php');
    exit;
}