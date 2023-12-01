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
            background-color: #f4f4f4;
        }

        #header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }

        li {
            display: inline-block;
            margin-right: 20px;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        h4 {
            margin: 0;
            font-size: 16px;
            margin-top: 10px;
        }

        a.logout {
            color: #ff4500;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="header">
        <h1>音响店VCD管理系统</h1>
        <ul>
            <li><a href="admin.php">主页</a></li>
            <li><a href="view.php">VCD管理</a></li>
            <li><a href="usermanager.php">用户管理</a></li>
            <li><a href="borrowmanager.php">租赁管理</a></li>
        </ul>
        <h4>
            <?php
                session_start();
                echo "用户：" . $_SESSION['id'];
            ?>
        </h4>
        <a class="logout" href="index.php">退出</a>
    </div>
</body>
</html>
