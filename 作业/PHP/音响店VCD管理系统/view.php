<?php
include_once('header.php');
include_once("conn.php");

$query = "SELECT * FROM audio_info";
$stmt = $conn->query($query);

$arr = array();
$arr2 = array();
$query2 = "SELECT audio_id, return_date FROM rental_list";
$stmt2 = $conn->query($query2);

foreach ($stmt2 as $row) {
    if (strtotime($row['return_date']) > time()) { // Still borrowed
        array_push($arr, $row['audio_id']);
    } else { // Overdue
        array_push($arr2, $row['audio_id']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>音响店VCD管理系统</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #FanYe {
            width: 80%;
            margin: 50px auto;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        .status-issued {
            color: #f0770c;
            font-weight: bold;
        }

        .status-overdue {
            color: #d43f3a;
            font-weight: bold;
        }

        .status-available {
            color: greenyellow;
            font-weight: bold;
        }

        td>a {
            color: blue;
            text-decoration: none;
        }

        td>a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div id="FanYe">
        <h2>音频详情</h2>
        <a href="addAudio.php" style='color:red'>添加</a>
        <table>
            <tr>
                <th>音频ID</th>
                <th>标题</th>
                <th>艺术家</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <?php
            foreach ($stmt as $row) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['artist']}</td>";

                if (in_array($row['id'], $arr)) {
                    echo "<td class='status-issued'>借出</td>";
                } else if (in_array($row['id'], $arr2)) {
                    echo "<td class='status-overdue'>逾期未归</td>";
                } else {
                    echo "<td class='status-available'>在库</td>";
                }

                $id = $row['id'];
                echo "<td>" . "<a href='audio_detail.php?audio_id=$id' style='color: blue;'>详情</a>" . "&nbsp&nbsp&nbsp
                <a href='edit_audio.php?audio_id=$id' style='color: blue;'>修改</a>" . "&nbsp&nbsp&nbsp
                <a href='delete_audio.php?audio_id=$id' style='color: blue;'>删除</a>" . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>