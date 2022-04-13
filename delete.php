<?php

if ( ! isset($_GET['id'])){

    header("location: /projects");
    return;
}

$link =mysqli_connect('localhost:3306' , 'root' , '');

if (! $link){

    echo 'could not connected : ' . mysqli_connect_error();
}

mysqli_select_db($link , 'customers');

$stmt = mysqli_prepare($link , "delete from users where id=?");

$id = (int) $_GET['id'];

mysqli_stmt_bind_param($stmt , 'i' , $id);
mysqli_stmt_execute($stmt);

if (mysqli_affected_rows($link)){

    header("location: /projects");
    return;
}