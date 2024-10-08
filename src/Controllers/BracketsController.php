<?php

function brackets($string)
{
//Создаем стек
    $stack = [];
//Создаем список открывающих скобок
    $openChar = ["(", "[", "<", "{"];
//Создаем список закрывающих скобок
    $closeChar = [")", "]", ">", "}"];
//Создаем список пар
    $pairs = ["()", "[]", "<>", "{}"];

//Цикл перебирает каждый символ строки
    for ($i = 0; $i < strlen($string); $i++) {
//Текущий символ
        $char = $string[$i];

//Есть ли текущий символ в списке открывающих скобок
        if (in_array($char, $openChar)) {
//Если есть,то добавляем его в стек
            array_push($stack, $char);
        }
//Если это не открывающая скобка,то проверяем закрывающая ли она
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
    if (empty($stack)) {
        return json_encode(true);
    } else {
        return json_encode(false);
    }
}

