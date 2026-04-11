<?php
// Подключение к базе данных
include_once 'pdo.php';
$db = new DB();
$pdo = $db->connect();

// Получаем список категорий (таблица catalog)
$stmt = $pdo->query("SELECT * FROM catalog ORDER BY id ASC;");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Получаем товары для каждой категории (таблица tovar через товar_catalog)
$todos = [];
foreach ($categories as $category) {
    $stmt = $pdo->prepare("
        SELECT *
        FROM tovar
        WHERE id IN (SELECT id_tovar FROM tovar_catalog WHERE id_catalog = :id_category);
    ");
    $stmt->execute(['id_category' => $category['id']]);
    $todos[$category['id']] = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Формируем итоговую структуру данных
$response = [
    'categories' => $categories,
    'todos' => $todos
];

// Отправляем заголовок JSON
header('Content-Type: application/json');

// Выводим JSON
echo json_encode($response);
exit;
?>