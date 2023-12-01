<?php
session_start();
include("conn.php");

if (isset($_POST['ok1'])) {
    $userid = $_POST['userid'];
    $password =$_POST['password'];

    // 防止 SQL 注入攻击
    $userid = mysqli_real_escape_string($conn, $userid);
    $password = mysqli_real_escape_string($conn, $password);

    // 查询用户信息
    echo $userid;
    echo $password;
    $query = "SELECT * FROM user WHERE id='$userid' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // 登录成功
        date_default_timezone_set('PRC'); // 设置默认时区
        $nowTime = date('Y-m-d H:i:s', time());
        $updatetime = "UPDATE user SET last_login_time = '$nowTime' WHERE id=$userid";
        $conn->query($updatetime);

        $_SESSION['id'] = $userid;
        header("Location: admin.php");
    } else {
        // 登录失败
        echo "账号或密码错误，请重新输入！";
    }

    $conn->close();
}

if (isset($_POST['ok2'])) {
    // 注册逻辑
    header("Location: register.php");
}
?>
