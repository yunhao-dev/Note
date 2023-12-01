<?php
include_once("header.php");
include_once("conn.php");

$id = $_GET['user_id'];

$query = "SELECT r.audio_id, a.title, r.rental_date, r.return_date 
            FROM rental_list r
            JOIN audio_info a ON r.audio_id = a.id
            WHERE r.user_id='$id'";
$stmt = $conn->query($query);

echo "<table border='1px gray solid' width='600px' align='center' style='margin-top: 120px;' cellpadding='0' cellspacing='0'>";
echo "<caption><h2>用户租赁信息界面</h2></caption>";
echo "<tr style='line-height: 40px;'><th>音频ID</th><th>音频名称</th><th>租赁时间</th><th>应还时间</th><th>详情</th></tr>";

$currentTimestamp = time();
$currentDate = date("Y-m-d", $currentTimestamp);
$currentDateTimestamp = strtotime($currentDate);

foreach ($stmt as $row) {
    echo "<tr style='text-align: center;line-height: 40px'>";
    echo "<td>" . $row['audio_id'] . "</td>";
    echo "<td>" . $row['title'] . "</td>";
    echo "<td>" . $row['rental_date'] . "</td>";
    echo "<td>" . $row['return_date'] . "</td>";
    $returnDateTimestamp = strtotime($row['return_date']);

    if ($currentDateTimestamp <= $returnDateTimestamp) {
        echo "<td><span style='color: #5cb85c'>正常</span></td>";
    } else {
        echo "<td><a href='borrowmanager.php' style='color: #d43f3a;text-decoration: none;'>逾期</a></td>";
    }

    echo "</tr>";
}

echo "</table>";
?>
