<?php

function request($field){

    return isset($_REQUEST['field']) && $_REQUEST['field'] != "" ? $_REQUEST['field'] : null;
}

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//
//    $name = isset($_POST['name']) ? $_POST['name'] : null;
//    $family = isset($_POST['family']) ? $_POST['family'] : null;
//    $email = isset($_POST['email']) ? $_POST['email'] : null ;
//    $age = isset($_POST['age']) ? $_POST['age'] :null ;

function has_error($field){

    global $errors;
    return isset($errors['field']);
}
function get_error($field){

    global $errors;
    return has_error($field) ? $errors['field'] : null;
}

$errors =[];

if ($_SERVER['REQUEST_METHOD'] = 'POST'){

    $name = request('name');
    $family = request('family');
    $email = request('email');
    $age = request('age');

    if (is_null($name)){

        $errors['name'] = 'فیلد نام نمی تواند خالی باشد';
    }
    if (is_null('$family')){

        $errors['family'] = 'فیلد نام خانوادگی نمی تواند خالی باشد';
    }
    if (is_null($email)){

        $errors['email'] = 'فیلد ایمیل نمی تواند خالی باشد';
    }
    if (is_null($age)){

        $errors['age'] = 'فیلد سن نمی تواند خالی باشد';
    }
    if (! is_null($name) && ! is_null($family) && ! is_null($email) && ! is_null($age)) {

            echo 'حساب کاربری با موفقیت ایجاد شد';
        }


$link = mysqli_connect('localhost:3306', 'root', '');
if (!$link) {

    echo 'could not connect :' . mysqli_connect_error();
    exit;









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

            echo 'insert query run successfully';
        } else {
            echo 'error : ' . mysqli_error($link);
        }

        if (mysqli_affected_rows($link)){

            header("location: /projects ");
            return;
        }


    }
}








?>


<html dir = "rtl">
<head>
    <title>صفحه ورود کاربران</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-3">
            <div class="row">
                <div class="col-md-20">
        <div class="page-header">
            <h5 class="col-md text-right">صفحه ورود کاربران</h5>
        </div>

    <form  action="/projects/" method="post">
        <div class="form-group">
                <label class="col-md text-right">  نام </label>
                <input type="text" name="name" class="form-control">
            <?php if (has_error('name')){?>
                <span><?= get_error('name'); ?></span><br>
            <?php } ?>
        </div>
        <div class="form-group">
                <label class="col-md text-right" > نام خانوادگی </label>
                <input type="text" name="family" class="form-control">
        </div>
        <div class="form-group">
                <label class="col-md text-right" > ایمیل </label>
                <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
                <label class="col-md text-right"> سن  </label>
                <input type="number" name="age" class="form-control"><br>
        <button type="button" class="btn btn-primary">ثبت نام</button>
        </div>

    </form>
                </div>
            </div>
    </div>
</body>
</html>