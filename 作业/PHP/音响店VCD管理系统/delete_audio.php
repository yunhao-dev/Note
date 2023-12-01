<?php
include_once('header.php');
include_once("conn.php");

// 检查是否传递了音频ID
if (isset($_GET['audio_id'])) {
    $audio_id = $_GET['audio_id'];

    // 查询数据库获取音响信息
    $query = "SELECT * FROM audio_info WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $audio_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $audio = $result->fetch_assoc();
    } else {
        echo "未找到音响信息";
        exit;
    }

    // 处理删除音响信息的操作
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $deleteQuery = "DELETE FROM audio_info WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $audio_id);

        if ($deleteStmt->execute()) {
            echo "<h2 style='text-align: center;'>音响信息删除成功</h2>";
            header("Location: view.php");
            exit;
        } else {
            echo "<h2 style='text-align: center;'>音响信息删除失败</h2>";
        }

        $deleteStmt->close();
    }
} else {
    echo "缺少音频ID参数";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>音响店VCD管理系统 - 删除音响信息</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #register {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            padding: 20px;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        p {
            margin-bottom: 20px;
            color: #666;
        }

        form>button,
        a {
            display: inline-block;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        form>button {
            background-color: #d9534f;
        }

        form>button:hover {
            background-color: #c9302c;
        }

        form>a {
            background-color: #5bc0de;
            margin-left: 10px;
        }

        form>a:hover {
            background-color: #46b8da;
        }
    </style>
</head>

<body>
    <div id="register">
        <form action="" method="post">
            <h2>删除音响信息</h2>
            <p>确认删除音响信息：<strong>
                    <?php echo $audio['title']; ?>
                </strong>？</p>
            <button type="submit" name="delete">删除</button>
            <a href="view.php">取消</a>
        </form>
    </div>
</body>

</html>