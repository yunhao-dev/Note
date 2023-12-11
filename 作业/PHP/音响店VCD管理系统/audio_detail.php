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

        #AudioDetails {
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

        div {
            text-align: left;
        }

        label {
            font-weight: bold;
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
    <div id="AudioDetails">
        <h2>音频详细信息</h2>
        <div>
            <label for="title">标题:</label>
            <span id="title">歌曲标题</span>
        </div>
        <div>
            <label for="artist">艺术家:</label>
            <span id="artist">艺术家名称</span>
        </div>
        <div>
            <label for="genre">流派:</label>
            <span id="genre">流派类型</span>
        </div>
        <div>
            <label for="release_date">发行日期:</label>
            <span id="release_date">2022-01-01</span>
        </div>
        <div>
            <label for="price">价格:</label>
            <span id="price">$9.99</span>
        </div>
        <div>
            <label for="audio_format">音频格式:</label>
            <span id="audio_format">MP3</span>
        </div>
        <div>
            <label for="description">描述:</label>
            <span id="description">音频描述</span>
        </div>
        <button type="button" onclick="goBack()">返回</button>
    </div>

    <script>
        // JavaScript function to go back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
