<?php

$nameErr = $familyErr = $emailErr = $ageErr ="";

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['name'])) {
        $nameErr = " * فیلد نام نمی تواند خالی باشد ";
    } else {
        $name = test_input($_POST['name']);
    }
    if (empty($_POST['family'])) {
        $familyErr = " * فیلد نام خانوادگی نمی تواند خالی باشد";
    } else {
        $family = test_input($_POST['family']);
    }
    if (empty($_POST['email'])) {
        $emailErr = " * فیلد ایمیل نمی تواند خالی باشد";
    } else {
        $email = test_input($_POST['email']);
    }
    if (empty($_POST['age'])) {
        $ageErr = " * فیلد سن نمی تواند خالی باشد ";
    } else {
        $age = $_POST['age'];
    }

//    include_once './database.php';
    include 'DB.php';
    $database = new DB('localhost' , 'root' , '' , 'customers');
    $conn = new mysqli('localhost' , 'root' , '' , 'customers');
    $database->connect();

    if (isset($name) && isset($family) && isset($email) && isset($age)) {

        $database->insert($name,$family,$email,$age);

        $stmt = $conn->prepare("INSERT INTO users(name, family, email,age) VALUES (?,?,?,?)");

//        $id = (int)$_GET['id'];

        $stmt->bind_param('sssi', $name, $family, $email, $age);

        $stmt->execute();

        if ($conn->affected_rows == true) {

//            echo "<script>alert();
//             window.location.href = '/projects';
//               </script>";
            session_start();
            $_SESSION['msg'] = '*اطلاعات کاربر با موفقیت ثبت شد*';
            header('location: /projects');
            exit;
        }


        $stmt->close();
        $conn->close();
    }
}


?>


<html dir="rtl">
<head>
    <title style="text-align: center">صفحه ورود کاربران</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .error{
            color: red;
           text-align: left;
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

        <div class="page-header">
            <h5 class="col-md text-center">صفحه ورود کاربران</h5><br>
        </div>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

                <label class="col-md text-right"><span class="error">*</span>  نام </label>
                <input type="text" name="name" class="form-control">
                    <span class="error"><?php echo $nameErr; ?></span>
                    <br>

                <label class="col-md text-right"><span class="error">*</span> نام خانوادگی </label>
                <input type="text" name="family" class="form-control">
                    <span class="error"><?php echo $familyErr; ?></span>
                    <br>

                <label class="col-md text-right" ><span class="error">*</span>ایمیل </label>
                <input type="email" name="email" class="form-control">
                    <span class="error"><?php echo $emailErr; ?></span>
                    <br>

                <label class="col-md text-right"><span class="error">*</span> سن </label>
                <input type="number" name="age" class="form-control">
                    <span class="error"><?php echo $ageErr; ?></span><br>
                    <br>

        <button type="submit" name="submit" class="btn btn-primary">ثبت نام</button>

    </form>
            </div>
    </div>


</body>
</html>