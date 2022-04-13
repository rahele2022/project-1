<?php

//function request($field){
//
//    return isset($_REQUEST['field']) && $_REQUEST['field'] != "" ? $_REQUEST['field'] : null;
//}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $family = isset($_POST['family']) ? $_POST['family'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null ;
    $age = isset($_POST['age']) ? $_POST['age'] :null ;

//    $name = request('name');
//    $family = request('family');
//    $email = request('email');
//    $age = request('age');


    if (! is_null($name) && ! is_null($family) && ! is_null($email) && ! is_null($age)) {

        $link = mysqli_connect('localhost:3306', 'root', '');
        if (!$link) {

            echo 'could not connect :' . mysqli_connect_error();
            exit;
        }


//$SQL ='CREATE DATABASE customers';
//
//if ($result = mysqli_query($link , $SQL)){
//
//    echo 'database query run successfully';
//}else{
//
//    echo 'error : ' . mysqli_error($link);
//}


        mysqli_select_db($link, 'customers');


//$SQL ='create table users(id INT AUTO_INCREMENT , name VARCHAR(100) NOT NULL , family VARCHAR(100) NOT NULL ,email varchar(100) NOT NULL , age varchar(100) NOT NULL ,primary key (id))';
//
//if ($result1= mysqli_query($link , $SQL)){
//
//    echo 'table query run successfully';
//}else{
//    echo 'error : ' . mysqli_error($link);
//}

        $statement = mysqli_prepare($link , "insert into users( name , family , email , age ) values (? ,? , ? , ?)");

        mysqli_stmt_bind_param($statement , 'sssi' , $name , $family ,$email , $age);

        if ($result = mysqli_stmt_execute($statement)) {

//            echo 'insert query run successfully';
        } else {
            echo 'error : ' . mysqli_error($link);
        }


    }
}








?>


<html dir = "rtl">
<head>
    <title>صفحه ورود کاربران</title>
</head>
<body>
    <h3>صفحه ورود کاربران</h3>
    <form action="/projects/" method="post">
        <label > نام :</label>
        <input type="text" name="name"><br><br>
        <label > نام خانوادگی :</label>
        <input type="text" name="family"><br><br>
        <label > ایمیل :</label>
        <input type="email" name="email"><br><br>
        <label > سن : </label>
        <input type="number" name="age"><br><br>
        <button>submit</button>

    </form>
</body>
</html>