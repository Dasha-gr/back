<?php
// Подключение к базе данных
include_once 'pdo.php';
$db = new DB();
$pdo = $db->connect();

// --- GET. ВНЕСЕНИЕ ДАННЫХ ИЗ БД В БЛОК ---
$stmt = $pdo->query("SELECT * FROM catalog");
$results = $stmt->fetchAll();


echo json_encode($results); // Вывод результата в формате JSON
