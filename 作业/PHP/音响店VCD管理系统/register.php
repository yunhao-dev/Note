<?php
include_once("conn.php");

// 检查用户是否已登录
if (isset($_SESSION['id'])) {
    header("Location: admin.php"); // 如果已登录，则重定向到主页
    exit();
}

if (isset($_POST['ok1'])) {
    $name = $_POST['name'];
    $id = $_POST['userid'];
    $password = md5($_POST['password']);
    $time = date('Y-m-d h:i:s', time());

    // 防止 SQL 注入攻击
    $id = mysqli_real_escape_string($conn, $id);
    $password = mysqli_real_escape_string($conn, $password);

    // 检查用户ID是否已存在
    $query = "SELECT * FROM user WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h4>账号已存在，请重新输入账号！</h4>";
    } else {
        // 插入新用户到用户表
        $query2 = "INSERT INTO user(id, password, name, status, admin, last_login_time) VALUES (?, ?, ?, 1, 0, ?)";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("isss", $id, $password, $name, $time);
        $stmt2->execute();

        if ($stmt2->affected_rows > 0) {
            $_SESSION['id'] = $id;
            header('Location: admin.php');
            exit();
        } else {
            echo "<h4>账号信息有误，请重新输入账号！</h4>";
        }
    }

    $stmt->close();
    $stmt2->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>音响店VCD管理系统注册模块</title>
    <link href="style/style.css" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #register {
            background-color: #fff;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 48%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"] {
            float: left;
        }

        button[type="reset"] {
            float: right;
            background-color: #f44336;
        }

        button:hover {
            background-color: #45a049;
        }

        h4 {
            color: #d43f3a;
        }

        a {
            display: block;
            text-align: right;
            margin-top: 10px;
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div id="register">
        <form action="" method="post">
            <h2>音响店VCD管理系统用户账号注册</h2>
            &nbsp;&nbsp;用户名&nbsp;：<input type="text" name="name" placeholder="请输入用户名"><br>
            &nbsp;&nbsp;用户ID&nbsp;：<input type="text" name="userid" placeholder="请输入用户id"><br>
            设置密码：<input type="password" name="password" placeholder="请输入密码"><br>
            <button type="submit" name="ok1">提交</button>
            <button type="reset" name="ok2">重置</button><br>
        </form>
        <a href="index.php">返回登录界面</a>
    </div>
</body>
</html>
