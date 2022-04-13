<?php


if (! isset($_GET['id'])) {

    header("location: /projects");
    return;
}

$link = mysqli_connect('localhost:3306' , 'root' , '');

if (! $link){

    echo 'could not connected : ' . mysqli_connect_errno();
    exit;
}

mysqli_select_db($link , 'customers');

$stmt = mysqli_prepare($link , "select * from users where id = ?");

$id = (int) $_GET['id'];
mysqli_stmt_bind_param($stmt , 'i' , $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

// var_dump($result);

if ($result -> num_rows == 0){

    header("location: /projects/");
    return;
}
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && ! is_null($user)){

    $stmt = mysqli_prepare($link , "update users set name = ? , family = ? , email = ? , age = ? where id = ?");
    mysqli_stmt_bind_param($stmt , 'sssii' , $_POST['name'] , $_POST['family'] , $_POST['email'] , $_POST['age'] , $user['id']);
    mysqli_stmt_execute($stmt);

    if (mysqli_affected_rows($link)){

        header("location: /projects");
        return;
    }
}



?>

<html dir = "rtl">
<head>
    <title>ویرایش اطلاعات کاربران</title>
</head>
<body>
<h3>ویرایش اطلاعات</h3>
<form action="/projects/edit.php?id=<?= $user['id'] ?>" method="post">
    <label > نام :</label>
    <input type="text" name="name" value="<?= $user['name'] ?>"><br><br>
    <label > نام خانوادگی :</label>
    <input type="text" name="family" value="<?= $user['family'] ?>"><br><br>
    <label > ایمیل :</label>
    <input type="email" name="email" value="<?= $user['email'] ?>"><br><br>
    <label > سن : </label>
    <input type="number" name="age" value="<?= $user['age'] ?>"><br><br>
    <button>ثبت ویرایش</button>

</form>
</body>
</html>
