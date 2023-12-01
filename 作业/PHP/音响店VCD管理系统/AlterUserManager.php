<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>音响店VCD管理系统</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #alter {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 10px;
            font-size: 1.2em;
        }

        input {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 80%;
            box-sizing: border-box;
            font-size: 1em;
        }

        button {
            padding: 10px;
            margin-top: 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.2em;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            margin-top: 20px;
        }

        .success {
            color: #008000;
        }

        .error {
            color: #ff0000;
        }
    </style>
</head>
<body>
    <?php
    include_once('header.php');
    include_once("conn.php");

    $userid = $_GET['user_id'];

    // 查询用户信息
    $query = "SELECT * FROM user WHERE id='$userid'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentID = $row['id'];
        $currentName = $row['name'];

        echo "<div id='alter'>";
        echo "<h3>用户ID：{$currentID}</h3>";
        echo "<h4>修改信息</h4>";
        echo "<form action='' method='post'>";
        echo "<label for='name'>姓名：</label>";
        echo "<input type='text' name='name' id='name' value='{$currentName}'><br>";
        echo "<button type='submit' name='ok'>提交修改信息</button>";
        echo "</form></div>";

        if (isset($_POST['ok'])) {
            $newName = $_POST['name'];

            // 更新用户信息
            $query2 = "UPDATE user 
                    SET `name` = '$newName' 
                    WHERE id='$userid'";
            $result2 = $conn->query($query2);

            echo "<div class='message'>";
            if ($result2) {
                echo "<p class='success'>修改用户信息成功</p>";
            } else {
                echo "<p class='error'>修改用户信息失败</p>";
            }
            echo "</div>";
        }
    } else {
        echo "<h2 class='error'>未找到用户信息</h2>";
    }
    ?>
</body>
</html>
