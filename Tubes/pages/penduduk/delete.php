<?php
include '../../includes/header.php';

$nik = $_GET['nik'];

$sql = "DELETE FROM Penduduk WHERE NIK = ?";
$params = array($nik);
$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    header('Location: index.php');
    exit;
}