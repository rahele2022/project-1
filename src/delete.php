<?php

if ( ! isset($_GET['id'])){

    header("location: /projects");
    return;
}

include './database.php';

$stmt = $conn -> prepare("delete from users where id=?");

$id = (int) $_GET['id'];

$stmt -> bind_param('i' , $id);
$stmt -> execute();

if ($conn -> affected_rows == true){

    header("location: /projects");
    return;
}