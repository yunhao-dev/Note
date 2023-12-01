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

    // 处理修改音响信息的表单提交
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $artist = $_POST['artist'];
        $genre = $_POST['genre'];
        $releaseDate = $_POST['release_date'];
        $price = $_POST['price'];
        $audioFormat = $_POST['audio_format'];
        $description = $_POST['description'];

        // 验证和清理输入

        // 更新数据库中的音响信息
        $updateQuery = "UPDATE audio_info 
                        SET title=?, artist=?, genre=?, release_date=?, price=?, audio_format=?, description=? 
                        WHERE id=?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ssssdssi", $title, $artist, $genre, $releaseDate, $price, $audioFormat, $description, $audio_id);

        if ($updateStmt->execute()) {
            echo "<h2 style='text-align: center;'>音响信息修改成功</h2>";
        } else {
            echo "<h2 style='text-align: center;'>音响信息修改失败</h2>";
        }

        $updateStmt->close();
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
    <title>音响店VCD管理系统 - 修改音响信息</title>
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
        }

        form {
            display: flex;
            flex-direction: column;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        input, textarea {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
        }

        button {
            margin-top: 10px;
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #333;
        }

        a:hover {
            color: #4caf50;
        }
    </style>
</head>
<body>
    <div id="register">
        <form action="" method="post">
            <h2>修改音响信息</h2>
            &nbsp;&nbsp;标题：<input type="text" name="title" value="<?php echo $audio['title']; ?>" required><br>
            &nbsp;&nbsp;艺术家：<input type="text" name="artist" value="<?php echo $audio['artist']; ?>" required><br>
            &nbsp;&nbsp;流派：<input type="text" name="genre" value="<?php echo $audio['genre']; ?>" required><br>
            &nbsp;&nbsp;发行日期：<input type="date" name="release_date" value="<?php echo $audio['release_date']; ?>" required><br>
            &nbsp;&nbsp;价格：<input type="number" name="price" step="0.01" value="<?php echo $audio['price']; ?>" required><br>
            &nbsp;&nbsp;音频格式：<input type="text" name="audio_format" value="<?php echo $audio['audio_format']; ?>" required><br>
            &nbsp;&nbsp;描述：<textarea name="description"><?php echo $audio['description']; ?></textarea><br>
            <button type="submit" name="ok1">提交</button>
            <button type="reset" name="ok2">重置</button><br>
        </form>
        <a href="view.php">返回主页</a>
    </div>
</body>
</html>
