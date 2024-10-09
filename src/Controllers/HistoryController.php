<?php

include_once "../../db_config.php";
include_once "./BracketsController.php";
include_once "../Models/HistoryModel.php";

class HistoryController
{
    private $model;

    public function __construct($model)
    {
        $this->model = new HistoryModel($model);
    }

    public function checkBrackets($string)
    {
        try {
            //Проверяем на пустую строку
            if (empty($string)) {
                throw new Exception("Строка не заполнена");
            }
            //Добавление защиты от XSS-скриптов
            $safe_string = htmlspecialchars($string);
            // Вызываем функцию
            $result = brackets($safe_string);
            $this->model->saveHistory($safe_string, $result);
            //Возвращаем ответ в формате JSON
            echo json_encode(["success" => $result]);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function getHistory()
    {
        try {
            $history = $this->model->getHistory();
            echo json_encode($history);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function deleteHistory()
    {
        $history = $this->model->deleteHistory();
    }
}

$controller = new HistoryController($connection);

if ($_GET["action"] == "getHistory") {
    $controller->getHistory();
} elseif ($_GET["action"] == "checkBrackets") {
    $data = json_decode(file_get_contents("php://input"), true);
    $controller->checkBrackets($data["string"]);
} elseif ($_GET["action"] == "deleteHistory") {
    $controller->deleteHistory();
}
