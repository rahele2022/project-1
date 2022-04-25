<?php

$nameErr = $familyErr = $emailErr = $ageErr = "";

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['name'])) {
        $nameErr = "فیلد نام نمی تواند خالی باشد";
    } else {
        $name = test_input($_POST['name']);
    }
    if (empty($_POST['family'])) {
        $familyErr = "فیلد نام خانوادگی نمی تواند خالی باشد";
    } else {
        $family = test_input($_POST['family']);
    }
    if (empty($_POST['email'])) {
        $emailErr = "فیلد ایمیل نمی تواند خالی باشد";
    } else {
        $email = test_input($_POST['email']);
    }
    if (empty($_POST['age'])) {
        $ageErr = "فیلد سن نمی تواند خالی باشد";
    } else {
        $age = $_POST['age'];
    }

    include_once './database.php';

    if (!is_null($name) && !is_null($family) && !is_null($email) && !is_null($age)) {

        $stmt = $conn->prepare("INSERT INTO users(name, family, email,age) VALUES (?,?,?,?)");

        $id = (int)$_GET['id'];

        $stmt->bind_param('sssi', $name, $family, $email, $age);

        $stmt->execute();

        if ($conn->affected_rows == true) {

            header("location: /projects");
            return;
        }

        $stmt->close();
        $conn->close();
    }
}


?>


<html dir = "rtl">
<head>
    <title>صفحه ورود کاربران</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .error{ color: red; }
    </style>
</head>
<body>

    <div class="container mt-3">
            <div class="row">
                <div class="col-md-20">
        <div class="page-header">
            <h5 class="col-md text-right">صفحه ورود کاربران</h5>
        </div>
<!--                    <form action="" method="post">-->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="form-group">
                <label class="col-md text-right">  نام </label>
                <input type="text" name="name" class="form-control">
                    <span class="error">* <?php echo $nameErr; ?></span>
                    <br>

        </div>
        <div class="form-group">
                <label class="col-md text-right" > نام خانوادگی </label>
                <input type="text" name="family" class="form-control">
                    <span class="error">*<?php echo $familyErr; ?></span>
                    <br>

        </div>
        <div class="form-group">
                <label class="col-md text-right" > ایمیل </label>
                <input type="email" name="email" class="form-control">
                    <span class="error"><?php echo $emailErr; ?></span>
                    <br>

        </div>
        <div class="form-group">
                <label class="col-md text-right"> سن  </label>
                <input type="number" name="age" class="form-control"><br>
                    <span class="error"><?php echo $ageErr; ?></span>
                    <br>

        <button type="submit" name="submit" class="btn btn-primary">ثبت نام</button>
        </div>

    </form>
                </div>
            </div>
    </div>


</body>
</html>