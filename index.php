<?php


// ---ПОДКЛЮЧЕНИЕ К БД--
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

try {
    $pdo = new PDO($dsn, $user, $pass, $opt);
} catch (\PDOException $e) {
    die("Ошибка подключения к БД");
}
// --- КОНЕЦ ПОДКЛЮЧЕНИЯ ---


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


// --- GET. ВЫВОД КАТАЛОГА ---
if($_GET !== null){
    // И здесь $pdo тоже доступен!

    // Получение данных из таблицы catalog по полю id
    $id = intval($_GET['id']);
    
    $stmt = $pdo->prepare("SELECT name_catalog FROM catalog WHERE id=?");
    $stmt->bindParam(1, $id);
    $stmt->execute();

    $results = $stmt->fetchAll();
    print_r($results);

}else{
     return false;
}