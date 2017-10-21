<?php
include('sesion.php');
header('Content-Type: application/json');
echo json_encode($_SESSION['messaje']);
unset($_SESSION['messaje']);
?>
