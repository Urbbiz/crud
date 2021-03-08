<?php
require __DIR__.'/bootstrap.php';
_d(readData());

//POST scenarijus
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_GET['id'] ?? 0;
    $id = (int) $id;

    deleteBox($id, $apples); //  trina
    header('Location: '.URL);
    die;
}

header('Location: ' .URL);
die;

?>