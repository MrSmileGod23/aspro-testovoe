<?php

class HistoryModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function saveHistory($string, $result)
    {
        try {
            $sql = "INSERT INTO history (string, status) VALUES ('$string', '$result')";
            mysqli_query($this->connection, $sql);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function getHistory()
    {
        $sql = "SELECT * FROM history";
        $result = mysqli_query($this->connection, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function deleteHistory()
    {
        $sql = "DELETE FROM history";
        mysqli_query($this->connection, $sql);
    }
}
