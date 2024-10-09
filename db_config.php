<?php
$db_config = array(
    'host'=>"localhost",
    'user'=>"root",
    'password'=>"",
    'dbname'=>"history",
);

$connection = mysqli_connect($db_config['host'],$db_config['user'],$db_config['password'],$db_config['dbname']);
