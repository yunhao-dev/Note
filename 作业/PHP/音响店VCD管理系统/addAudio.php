<?php
include_once('header.php');
include_once("conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];
    $releaseDate = $_POST['release_date'];
    $price = $_POST['price'];
    $audioFormat = $_POST['audio_format'];
    $description = $_POST['description'];


    $query = "INSERT INTO audio_info (title, artist, genre, release_date, price, audio_format, description) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssdss", $title, $artist, $genre, $releaseDate, $price, $audioFormat, $description);
    
    if ($stmt->execute()) {
        echo "<h2 style='text-align: center;'>音响信息添加成功</h2>";
    } else {
        echo "<h2 style='text-align: center;'>音响信息添加失败</h2>";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>音响店VCD管理系统 - 添加音响信息</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
            background-color: #4caf50;
            margin-top: 10px;
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
            <h2>添加音响信息</h2>
            &nbsp;&nbsp;标题：<input type="text" name="title" required><br>
            &nbsp;&nbsp;艺术家：<input type="text" name="artist" required><br>
            &nbsp;&nbsp;流派：<input type="text" name="genre" required><br>
            &nbsp;&nbsp;发行日期：<input type="date" name="release_date" required><br>
            &nbsp;&nbsp;价格：<input type="number" name="price" step="0.01" required><br>
            &nbsp;&nbsp;音频格式：<input type="text" name="audio_format" required><br>
            &nbsp;&nbsp;描述：<textarea name="description"></textarea><br>
            <button type="submit" name="ok1">提交</button>
            <button type="reset" name="ok2">重置</button><br>
        </form>
        <a href="view.php">返回主页</a>
    </div>
</body>
</html>
