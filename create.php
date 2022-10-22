<?php


$connection = require_once('./connection.php');

// Validate note object;

if(isset($_POST['id'])){
    $id = $_POST['id'];
}
//$id = $_POST['id'] ?? '';
if ($id){
    $connection->updateNote($id, $_POST);
} else {
    $connection->addNote($_POST);
}

header('Location: index.php');