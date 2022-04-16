<?php

$link = mysqli_connect('localhost:3306' , 'root' , '');

    if (! $link){

    echo 'could not connect : ' . mysqli_connect_error();
    exit;
}
    mysqli_select_db($link , 'customers');

    $SQL = " select * from users ORDER BY id";

    if ($result = mysqli_query($link , $SQL)){

//       while ( $user = mysqli_fetch_assoc($result)) {
//
//           var_dump($user);
//       }

    }else{

        echo 'error is : ' . mysqli_error($link);
        exit;
    }


?>

<html dir = "rtl">
<head>
    <title>لیست کاربران</title>
    </style>
</head>
<body>
    <h3>لیست کاربران</h3>
    <table >
        <thead>

            <tr>
                <th>سن</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>ایمیل</th>
                <th>اقدامات</th>
            </tr>

        </thead>
        <tbody>
            <?php while ( $user = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $user['age'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['family'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <button onclick="document.location = '/projects/edit.php?id=<?= $user['id']?>'">ویرایش  </button>
                </td>
                <td>
                    <button onclick="document.location = '/projects/delete.php/?id=<?= $user['id']?>'"> حذف </button>
                </td>


            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>
