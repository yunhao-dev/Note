<?php include_once('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>音响店VCD管理系统 - 租赁管理</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #Lease_Management {
            width: 90%;
            max-width: 400px;
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

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
            font-size: 1.2em;
        }

        input {
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 80%;
            box-sizing: border-box;
            font-size: 1em;
        }

        h3, .radio-group {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        .radio-item {
            margin-right: 20px;
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
    </style>
</head>
<body>
    <div id="Lease_Management">
        <h2>租赁管理</h2>
        <form action="update.php" method="post">
            <label for="userid">用户ID：</label>
            <input type="text" name="userid" id="userid" placeholder="请输入用户ID"><br>
            <label for="bookid">VCD号：</label>
            <input type="text" name="audio_id" id="audio_id" placeholder="请输入VCD号"><br>
            <h3>操作：</h3>
            <div class="radio-group">
                <div class="radio-item">
                    <input type="radio" name="operation" value="0" id="rent" checked>
                    <label for="rent">租借</label>
                </div>
                <div class="radio-item">
                    <input type="radio" name="operation" value="1" id="return">
                    <label for="return">归还</label>
                </div>
            </div>
            <button type="submit" name="ok">确定</button>
            <button type="reset" name="ok2">重置</button>
        </form>
    </div>
</body>
</html>
