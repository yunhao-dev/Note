<?php
include_once("header.php");
include_once("conn.php");

$id = $_GET['user_id'];

// 删除用户
$query = "DELETE FROM user WHERE id='$id'";
$result = $conn->query($query);

// 删除用户相关的租赁信息
$query2 = "DELETE FROM rental_list WHERE user_id='$id'";
$result2 = $conn->query($query2);

if ($result && $result2) {
    echo "<h2 style='text-align: center; margin-top: 150px;'>删除成功！</h2>";
} else {
    echo "<h2 style='text-align: center; margin-top: 150px;'>删除失败！</h2>";
}

?>
