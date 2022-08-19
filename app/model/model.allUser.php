<?php
require_once('config.php');

$sql = "SELECT * FROM cadastro";
$stmt = $pdo->query($sql);
$stmt->execute();

$allUser = $stmt->fetchAll(PDO::FETCH_ASSOC);
