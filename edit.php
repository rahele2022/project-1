<?php


if (!isset($_GET['id'])) {

    header("location: /projects");
    return;
}

include './database.php';


$stmt = $conn->prepare("select * from users where id = ?");

$id = (int) $_GET['id'];
 $stmt->bind_param('i' , $id);

 $stmt->execute();

$result = $stmt->get_result();


if ($result -> num_rows == 0){

    header("location: /projects/");
    return;
}
$user = $result->fetch_assoc();

if ( isset($_POST['update_button'])  && ! is_null($user)){

    $stmt=$conn->prepare("update users set name = ? , family = ? , email = ? , age = ? where id = ?");

    $id = (int) $_GET['id'];

    $stmt->bind_param('sssii' , $_REQUEST['name'] , $_REQUEST['family'] , $_REQUEST['email'] , $_REQUEST['age'] , $user['id']);
    $stmt->execute();

    if ($conn->affected_rows == true){

        header("location: /projects");
        return;
    }
}



?>

<html dir = "rtl">
<head>
    <title>ویرایش اطلاعات کاربران</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-20">
            <div class="page-header">
                <h5> ویرایش اطلاعات کاربران</h5>
            </div>

<form action="/projects/edit.php?id=<?= $user['id'] ?>" method="post">

    <div class="form-group">
        <label class="col-md text-right" > نام </label>
        <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>"><br>
    </div>
    <div class="form-group">
        <label class="col-md text-right"> نام خانوادگی </label>
        <input type="text" name="family" class="form-control" value="<?= $user['family'] ?>"><br>
    </div>
    <div class="form-group">
        <label class="col-md text-right"> ایمیل </label>
        <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>"><br>
    </div>
    <div class="form-group">
        <label class="col-md text-right" > سن  </label>
        <input type="number" name="age" class="form-control"  value="<?= $user['age'] ?>"><br>
    </div>
    <button type="submit" name="update_button" class="btn btn-primary">ثبت ویرایش</button>

</form>
        </div>
    </div>
</div>

</body>
</html>
