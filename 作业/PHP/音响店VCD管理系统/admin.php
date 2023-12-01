<?php
include_once('header.php');
include_once("conn.php");

// 检查用户是否已登录
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // 如果未登录，则重定向到登录页面
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>音响店VCD管理系统</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #userinfo {
            width: 70%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        h3 {
            margin-top: 10px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a.button:hover {
            background-color: #2980b9;
        }

        .action-link {
            float: right;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div id="userinfo">
        <h2>个人信息</h2>
        <?php
        $id = $_SESSION['id'];
        $query = "SELECT * FROM user WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            echo "<div style='text-align: center;'>";
            echo "<h3>用户ID: {$row['id']}</h3>";
            echo "<h3>用户姓名: {$row['name']}</h3>";
            echo "<h3>用户状态: " . ($row['status'] == 1 ? '正常' : '挂失') . "</h3>";
            echo "</div>";
        }
        echo "<div class='action-link'><a href='AlterUserManager.php?user_id=$id' class='button'>修改个人信息</a></div>";
        ?>

        <?php
        $query = "SELECT audio_id, title, rental_date, return_date 
                FROM rental_list r
                JOIN audio_info a ON r.audio_id = a.id
                WHERE r.user_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<table>";
        echo "<caption><h2>个人租赁信息界面</h2></caption>";
        echo "<tr><th>VCD号</th><th>VCD名称</th><th>租赁时间</th><th>应还时间</th><th>详情</th></tr>";

        $currentTimestamp = time();
        $currentDate = date("Y-m-d", $currentTimestamp);
        $currentDateTimestamp = strtotime($currentDate);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['audio_id']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['rental_date']}</td>";
            echo "<td>{$row['return_date']}</td>";

            $returnDateTimestamp = strtotime($row['return_date']);

            if ($currentDateTimestamp <= $returnDateTimestamp) {
                echo "<td><span class='normal'>正常</span></td>";
            } else {
                echo "<td><a href='borrowmanager.php' class='overdue button'>逾期</a></td>";
            }
            echo "</tr>";
        }
        echo "</table>"
            ?>
    </div>
</body>

</html>