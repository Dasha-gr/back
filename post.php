<?php

include_once "pdo.php";

$db = new DB();
$pdo = $db->connect();

// --- POST. ВНЕСЕНИЕ ДАННЫХ ИЗ ФОРМЫ В ТАБЛИЦУ ---
if($_POST !== null){
    $fam = $_POST['fam'];
    $name = $_POST['name'];
    $ote = $_POST['ote'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO form (fam, name, ote, phone, email) VALUES(?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $fam);
    $stmt->bindParam(2, $name);
    $stmt->bindParam(3, $ote);
    $stmt->bindParam(4, $phone);
    $stmt->bindParam(5, $email);

    $stmt->execute();
} 