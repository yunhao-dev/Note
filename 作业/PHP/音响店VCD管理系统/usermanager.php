<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>音响店VCD管理系统</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #FanYe {
            width: 80%;
            margin: 50px auto;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        .status-issued {
            color: #f0770c;
            font-weight: bold;
        }

        .status-overdue {
            color: #d43f3a;
            font-weight: bold;
        }

        .status-available {
            color: greenyellow;
            font-weight: bold;
        }

        td>a {
            color: blue;
            text-decoration: none;
        }

        td>a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    include_once('header.php');
    include_once("conn.php");

    $userid = $_SESSION['id'];
    $flag = 0;

    $queryUser = "SELECT * FROM user WHERE id = '$userid'";
    $st = $conn->query($queryUser);

    foreach ($st as $row) {
        if ($row['admin'] == 1) {
            $flag = 1;
        }
    }

    if ($flag == 0) {
        echo "<h1 style='margin: 200px auto;text-align: center;'>你不具有此权限！</h1>";
    } else {
        $query = "SELECT * FROM user";
        $stmt = $conn->query($query);

        echo "<table border='1px gray solid' width='600px' align='center' cellpadding='0' cellspacing='0'>";
        echo "<caption><h2>用户管理界面</h2></caption>";
        echo "<tr style='line-height: 40px;'><th>用户ID</th><th>姓名</th><th>最后登录时间</th><th>操作</th></tr>";

        foreach ($stmt as $row) {
            if ($row['admin'] != 1) {
                echo "<tr style='text-align: center;line-height: 40px'>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['last_login_time'] . "</td>";

                $id = $row['id'];
                echo "<td>" . "<a href='userborrowInf.php?user_id=$id' style='color: blue;'>详情</a>" . "&nbsp&nbsp&nbsp
                <a href='AlterUserManager.php?user_id=$id' style='color: blue;'>修改</a>" . "&nbsp&nbsp&nbsp
                <a href='deleteUser.php?user_id=$id' style='color: blue;'>删除</a>" . "</td>";
                echo "</tr>";
            }
        }

        echo "</table>";
    }
    ?>
</body>

</html>