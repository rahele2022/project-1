<?php

$SQL ='CREATE DATABASE customers';

if ($result = mysqli_query($link , $SQL)){

    echo 'database query run successfully';
}else{

    echo 'error : ' . mysqli_error($link);
}


$SQL ='create table users(id INT AUTO_INCREMENT , name VARCHAR(100) NOT NULL , family VARCHAR(100) NOT NULL ,email varchar(100) NOT NULL , age varchar(100) NOT NULL ,primary key (id))';

if ($result1= mysqli_query($link , $SQL)){

    echo 'table query run successfully';
}else{
    echo 'error : ' . mysqli_error($link);
}

