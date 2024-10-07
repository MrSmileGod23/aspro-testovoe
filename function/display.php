<?php
include "../database/dbconnect.php";

$sql = "select * from history";

$result = mysqli_query($connection, $sql);

//Создаем массив для хранения
$history = [];

//Перебираем результат запроса и добавляем каждую запись в массив
while ($data = mysqli_fetch_assoc($result)) {
    $history[] = $data;
}

header('Content-Type: application/json');

//Возвращаем массив в формате JSON
echo json_encode($history);
