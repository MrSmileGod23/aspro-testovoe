# aspro-testovoe


Написать функцию "brackets($string)" , принимающая на вход строку с выражением и возвращающая "TRUE" или "FALSE". 
Если скобки расставлены правильно - "TRUE", "FALSE" - в противном случае. 
Функция должна работать со всеми видами скобок, которые есть в примерах.
    1.Примеры возвращающие "FALSE":
        1. "( 2 * 45 [ 11 ) - 7]"
        2. "( 2 { 3 / [ ? } 1 ] )"
        3. "> < > <"
    2.Примеры возвращающие "TRUE":
        1. "< ( { [ 42 ] } ) >"
        2. "( 2 * 44 [ 11 ] )"
        3. "< a * ( 4 / 7 - [ 2 - 2] / { 11 } ) >"
        4. "(привет+пока)"
