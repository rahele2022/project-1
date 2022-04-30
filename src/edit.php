    <?php

        if (!isset($_GET['id'])) {

            header("location: /projects");
            return;
        }


        include './database.php';

        $stmt = $conn->prepare("select * from users where id = ?");

        $id = (int)$_GET['id'];
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {

            header("location: /projects/");
            return;
        }

       $user = $result->fetch_assoc();

//    if (isset($user['name']) && isset($user['family']) && isset($user['email']) && isset($user['age']) && isset($_POST['update_button'])) {
//
//        $stmt = $conn->prepare("update users set name = ? , family = ? , email = ? , age = ? where id = ?");
//
//        $id = (int)$_GET['id'];
//
//        $stmt->bind_param('sssii', $user['name'], $user['family'], $user['email'], $user['age'], $user['id']);
//
//        $stmt->execute();
//
//        if ($conn->affected_rows == true) {
//
//            header('location: /projects');
//            exit;
//        }
//
//    }


    $nameErr = $familyErr = $emailErr = $ageErr ="";

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (empty($_POST['name'])) {
            $nameErr = "* فیلد نام نمی تواند خالی باشد";
        } else {
            $name = test_input($_POST['name']);
        }
        if (empty($_POST['family'])) {
            $familyErr = " * فیلد نام خانوادگی نمی تواند خالی باشد";
        } else {
            $family = test_input($_POST['family']);
        }
        if (empty($_POST['email'])) {
            $emailErr = " * فیلد ایمیل نمی تواند خالی باشد ";
        } else {
            $email = test_input($_POST['email']);
        }
//        if (!filter_var($email , FILTER_VALIDATE_EMAIL)){
//
//            $emailErr ="فرمت ایمیل صحیح نمی باشد";
//        }
        if (empty($_POST['age'])) {
            $ageErr = " * فیلد سن نمی تواند خالی باشد ";
        } else {
            $age = test_input($_POST['age']);
        }


//    if (isset($_POST['update_button']) && !is_null($user)) {

        if (isset($name) && isset($family) && isset($email) && isset($age)) {

            $stmt = $conn->prepare("update users set name = ? , family = ? , email = ? , age = ? where id = ?");

            $id = (int)$_GET['id'];

            $stmt->bind_param('sssii', $name, $family, $email, $age, $user['id']);

            $stmt->execute();

            if ($conn->affected_rows == true) {

                echo "<script type='text/javascript'>alert('*اطلاعات کاربر با موفقیت ویرایش شد*');
                 window.location.href = '/projects';
                   </script>";
//            session_start();
//            $_SESSION['edit'] = '*اطلاعات کاربر با موفقیت ویرایش شد*';
//                sleep(2);
//            header('location: /projects');
//            exit;
            }
            $stmt->close();
            $conn->close();
        }
    }



    ?>

    <html dir="rtl">
    <head>
        <title>ویرایش اطلاعات کاربران</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            .error{
                color: red;
                text-align: center;
            }
            .form{
                text-align: center;
                margin-left: 35%;
                margin-right: 35%;
                width: 30%;

            }
        </style>
    </head>
    <body>

    <div class="container mt-3">
        <div class="form">
            <h8 class="error"><?php
                    if (isset($_SESSION['edit'])){
                        echo $_SESSION['edit'];
                        unset($_SESSION['edit']);
                    } ?></h8><br><br>
            <div class="page-header">
                    <h5> ویرایش اطلاعات کاربران</h5>
                </div>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?id=<?= $user['id'] ?>" method="post">


            <label class="col-md text-right" > نام </label>
            <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>">
            <span class="error"><?php echo $nameErr;?></span>
            <br>

            <label class="col-md text-right"> نام خانوادگی </label>
            <input type="text" name="family" class="form-control" value="<?= $user['family'] ?>">
            <span class="error"><?php echo $familyErr; ?></span>
            <br>

            <label class="col-md text-right"> ایمیل </label>
            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>">
            <span class="error"><?php echo $emailErr; ?></span>
            <br>

            <label class="col-md text-right" > سن  </label><br>
            <input type="number" name="age" class="form-control"  value="<?= $user['age'] ?>">
            <span class="error"><?php echo $ageErr; ?></span><br>
            <br>
        <button type="submit" name="update_button" class="btn btn-primary">ثبت ویرایش</button>

    </form>


        </div>
    </div>

    </body>
    </html>
