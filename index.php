<?php

//Взаимодействие с front

if($_POST !== null){
       $host = '127.0.0.1';
       $db = 'decor_home';
       $user = 'root';
       $pass = '';
       $charset = 'utf8';

       $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
       $opt = [
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
           PDO::ATTR_EMULATE_PREPARES => false,
       ];


       // Получение объекта PDO
    try {
        $pdo = new PDO($dsn, $user, $pass, $opt);
    } catch (\PDOException $e) {
        die("Ошибка подключения к БД");
    }

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
}else{
    return false;
}