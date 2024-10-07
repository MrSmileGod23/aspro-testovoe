# Проект на Nginx + PHP-CGI

## Описание
Этот проект представляет собой веб-приложение на PHP, которое использует Nginx для обработки HTTP-запросов и PHP-CGI для выполнения PHP-скриптов.

## Функционал
Программа реализует функцию brackets($string), которая проверяет правильность расстановки всех видов скобок в строке. Функция принимает на вход строку, содержащую различные скобки, такие как:

Круглые скобки ()
Квадратные скобки []
Фигурные скобки {}
Угловые скобки <>

Основная задача:
Функция должна возвращать:

TRUE, если все скобки в строке правильно открыты и закрыты в соответствии с правилами вложенности.
FALSE, если скобки расставлены неправильно (например, закрытие идет без открытия или нарушен порядок типов скобок).

Пример правильной строки:
```
$string = "{[()]}";  // TRUE
```
Пример неправильной строки:
```
$string = "{[(])}";  // FALSE
```
Функция должна обрабатывать любые последовательности символов и корректно работать для строк любой длины.

## Требования
Перед началом работы убедитесь, что на вашем компьютере установлены следующие программы:
- **Nginx**: веб-сервер для обработки запросов.
- **PHP** (версия 8.3) с поддержкой **PHP-CGI**.
- **MariaDB** (или другая MySQL совместимая база данных, если используется).
- **Git**: для клонирования проекта.

## Установка

### 1. Клонирование репозитория
Сначала клонируйте репозиторий на ваш компьютер:

```
git clone https://github.com/MrSmileGod23/aspro-testovoe.git
cd aspro-testovoe
```

### 2. Установка зависимостей

```
npm install
```

### 3. Настройка Nginx

```
server {
        listen       80;
        server_name  localhost;

        root  C:/OSPanel/domains/aspro-testovoe;
        index index.html;

        location / {
            try_files $uri $uri/ =404;
        }

        # Обработка PHP-скриптов через PHP-CGI
        location ~ \.php$ {
            include        fastcgi_params;
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.html;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        }

        location ~ /\.ht {
            deny  all;
        }
    }
```

### 4. Запуск PHP-CGI

```
php-cgi -b 127.0.0.1:9000
```

### 5. Настройка базы данных

Импортируйте структуру и данные из файла database.sql к примеру в HeidiSQL

### 6. Запустите nginx и октройте сайт

http://localhost

