<?php


function request($field){

    return isset($_REQUEST['field']) && $_REQUEST['field'] != "" ? $_REQUEST['field'] : null;
}

//function has_error($field){
//
//    global $errors;
//    return isset($errors['field']);
//
//}
//function get_error($field){
//
//    global $errors;
//    return has_error($field) ? $errors['field'] : null;
//}
//
//$errors =[];

if ($_SERVER['REQUEST_METHOD'] = 'POST') {

//    $name = isset($_POST['name']) ? $_POST['name'] : null;
//    $family = isset($_POST['family']) ? $_POST['family'] : null;
//    $email = isset($_POST['email']) ? $_POST['email'] : null;
//    $age = isset($_POST['age']) ? $_POST['age'] : null;


    $name = request('name');
    $family = request('family');
    $email = request('email');
    $age = request('age');


//    if (is_null($name)) {
//
//       $errors['name'] = 'فیلد نام نمی تواند خالی باشد';
//    }
//    if (is_null('$family')) {
//
//        echo $errors['family'] = 'فیلد نام خانوادگی نمی تواند خالی باشد';
//    }
//    if (is_null($email)) {
//
//        $errors['email'] = 'فیلد ایمیل نمی تواند خالی باشد';
//    }
//    if (is_null($age)) {
//
//        $errors['age'] = 'فیلد سن نمی تواند خالی باشد';
//    }
    if (!is_null($name) && !is_null($family) && !is_null($email) && !is_null($age)) {

        echo 'حساب کاربری با موفقیت ایجاد شد';


//        include './database.php';


        $link = mysqli_connect('localhost:3306' , 'root' , '');

        if (! $link){

            echo 'could not connected : ' . mysqli_connect_errno();
            exit;
        }

        mysqli_select_db($link , 'customers');


        $statement =prepare($link , "INSERT INTO users (name , family , email , age) VALUES (? ,? , ? , ? )");

        $statement->bind_param($link ,'sssi' , $_POST['name'] , $_POST['family'] , $_POST['email'] , $_POST['age']);

        if ($result = $statement->execute()) {

//            var_dump($statement->affected_rows());

            echo 'insert query run successfully';
        } else {
            echo 'error : ' . mysqli_error();
        }

//        $result = $statement->get_result();


        if ($statement->affected_rows()){

            header("location: /projects/ ");
            return;
        }

        $statement->close();
//        $conn->close();

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

    <form  action="/projects/user-page.php" method="post">
        <div class="form-group">
                <label class="col-md text-right">  نام </label>
                <input type="text" name="name" class="form-control">
<!--            --><?php //if (has_error('name')){?>
<!--                <span>--><?//= get_error('name'); ?><!--</span><br>-->
<!--            --><?php //} ?>
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