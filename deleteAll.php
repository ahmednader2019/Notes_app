<?php 

$connection = require_once 'connection.php';

$connection->removeAllNotes();

header('Location: index.php');