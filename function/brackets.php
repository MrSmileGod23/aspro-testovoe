<?php

include "../database/dbconnect.php";

function brackets($string)
{

    //Создаем стек
    $stack = [];
    //Создаем список открывающих скобок
    $openChar = ['(', '[', '<', '{'];
    //Создаем список закрывающих скобок
    $closeChar = [')', ']', '>', '}'];
    //Создаем список пар
    $pairs = ['()', '[]', '<>', '{}'];

    //Цикл перебирает каждый символ строки
    for ($i = 0; $i < strlen($string); $i++) {
        //Текущий символ
        $char = $string[$i];

        //Есть ли текущий символ в списке открывающих скобок
        if (in_array($char, $openChar)) {
            //Если есть,то добавляем его в стек
            array_push($stack, $char);
        } //Если это не открывающая скобка,то проверяем закрывающая ли она
        elseif (in_array($char, $closeChar)) {
            //Достаем из стека последний элемент
            $charPop = array_pop($stack);
            //Создаем пару из последнего элемента и текущего символа
            $pair = "{$charPop}{$char}";
            //Проверяем,есть ли такая пара в списке пар
            if (!in_array($pair, $pairs)) {
                return json_encode(false);
            }
        }
    }
    //Если стек пустой, возвращает true
    return json_encode(true);

}

$msg_box = ""; // Храним сообщение для вывода
$errors = array(); // Массив для ошибков

// Проверяем поля
if ($_POST['string'] == "") $errors[] = "Поле 'Ваша строка' не заполнено!";

// если форма без ошибок
if (empty($errors)) {
    // собираем данные из формы
    $string = $_POST['string'];
    $result = brackets($string);
    $sql = "INSERT INTO history (string,status) values ('$string','$result')";
    mysqli_query($connection, $sql);
    $msg_box = $result;
} else {
    // если были ошибки, то выводим их
    $msg_box = "";
    foreach ($errors as $one_error) {
        $msg_box = $one_error;
    }
}

// Делаем ответ в формате json
echo json_encode(array(
    'success' => $msg_box
));





