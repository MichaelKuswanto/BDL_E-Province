<?php
include '../../includes/header.php';

$id_instansi = $_GET['id'];

$sql = "DELETE FROM InstansiPemerintah WHERE id_instansi = ?";
$params = array($id_instansi);
$result = sqlsrv_query($conn, $sql, $params);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    header('Location: index.php');
    exit;
}
?>
