<?php



include_once './database.php';

    $SQL = " select * from users ORDER BY id";

    if ($result = mysqli_query($conn ,$SQL)){

//       while ( $user = mysqli_fetch_assoc($result)) {
//
//           var_dump($user);
//       }

    }else{

        echo 'error is : ' . mysqli_error();
        exit;
    }



?>

<html dir = "rtl">
<head>
    <meta charset="UTF-8">
    <style>
        .error{
            color: red;
            text-align: center;
        }
        .button {
            background-color: green;
            border: none;
            color: white;
            padding: 5px 15px;
            font-size: 16px;
            border-radius: 4px;
            text-align: justify-all;

                }
        .button1 {
            float: left;
        }
        .button2 {
            background-color: dodgerblue;
            padding: 3px 8px;

        }
        .button3 {
            background-color: red;
            padding: 3px 15px;

        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-10">
                <h6 class="error"><?php session_start();
                    if (isset($_SESSION['msg'])){
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    } ?></h6>
                <div class="page-header">
                <h2>لیست کاربران</h2>

        <button class="button button1" onclick="document . location = '/projects/user-page.php'">افزودن کاربر جدید</button>
                </div>


        <table class="table">
        <thead>

            <tr>
                <th scope="col">#</th>
                <th scope="col">نام</th>
                <th scope="col">نام خانوادگی</th>
                <th scope="col">ایمیل</th>
                <th scope="col">اقدامات</th>
            </tr>

        </thead>
        <tbody>
            <?php while ( $user = $result->fetch_assoc()) { ?>
            <tr>
<!--                <td>--><?//= $user['age'] ?><!--</td>-->
                <th scope="row"><?= $user['age']?></th>
                <td><?= $user['name'] ?></td>
                <td><?= $user['family'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <button class="button button2" onclick="document.location = '/projects/edit.php?id=<?= $user['id']?>'">ویرایش  </button>
                </td>
                <td>
                    <button class="button button3" onclick="document.location = '/projects/delete.php/?id=<?= $user['id']?>'"> حذف </button>
                </td>


            </tr>
            <?php } ?>
        </tbody>
    </table>
            </div>
        </div>
    </div>

</body>

</html>
