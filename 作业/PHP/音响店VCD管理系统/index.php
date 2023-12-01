<?php
include_once("conn.php");

if (isset($_POST['ok1'])) {
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    // 使用mysqli连接数据库
    $conn = new mysqli("your_host", "your_username", "your_password", "your_database");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 防止 SQL 注入攻击
    $userid = mysqli_real_escape_string($conn, $userid);
    $password = mysqli_real_escape_string($conn, $password);

    // 查询用户信息
    $query = "SELECT * FROM user WHERE id='$userid' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // 登录成功
        session_start();
        $_SESSION['id'] = $userid;
        header("Location: admin.php");
    } else {
        // 登录失败
        echo "登录失败，请检查用户名和密码";
    }

    $conn->close();
}

if (isset($_POST['ok2'])) {
    // 注册逻辑
    // 你的注册代码
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>音响店VCD管理系统</title>
    <link href="style/style.css" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #Login_Register {
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
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div id="Login_Register">
        <h2>音响店VCD管理系统</h2>
        <form action="login.php" method="post">
            用户名：<input type="text" name="userid" placeholder="请输入用户id"><br>
            密&nbsp;&nbsp;&nbsp;&nbsp;码：<input type="password" name="password" placeholder="请输入密码"><br>
            <button type="submit" name="ok1">登录</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" name="ok2">注册</button>
        </form>
    </div>
</body>
</html>

