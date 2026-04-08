<?php
// --- GET. ВЫВОД КАТАЛОГА ---
if($_GET !== null){
    // Получение данных из таблицы catalog по полю id
    $stmt = $pdo->prepare("SELECT * FROM catalog");
    $stmt->execute();
    $results = $stmt->fetchAll();
    print_r($results);
}else{
     return false;
}

