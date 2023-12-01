<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>音响店VCD管理系统</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #Login_Register {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
        }

        input {
            padding: 8px;
            margin: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        h3 {
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #borrowMan label {
            margin: 0 5px; /* 添加一些间距 */
        }

        button {
            padding: 10px;
            margin-top: 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div id="Login_Register">
        <h2>租赁管理</h2>
        <form action="" method="post">
            用户ID：<input type="text" name="userid" placeholder="请输入用户id"><br><br>
            VCD号：<input type="text" name="bookid" placeholder="请输入VCD号"><br><br>
            <h3 id="borrowMan">
                操作：
                <label for="rent"><input type="radio" name="operation" value="0" id="rent" checked>租借</label>
                <label for="return"><input type="radio" name="operation" value="1" id="return">归还</label>
            </h3>
            <button type="submit" name="ok">确定</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="reset" name="ok2">重置</button>
        </form>
    </div>
</body>
</html>
