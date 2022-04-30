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

//    echo "<script>
//             window.location.href = '/projects';
//             alert('*اطلاعات کاربر با موفقیت حذف شد*');
//               </script>";
    session_start();
    $_SESSION['msg'] = '*اطلاعات کاربر با موفقیت حذف شد*';
    header('location: /projects');

    return;
}