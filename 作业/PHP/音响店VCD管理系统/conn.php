<?php
$host = 'localhost';
$dbname = 'vcd';
$user = 'root';
$pwd = 'noclose';

$conn = new mysqli($host, $user, $pwd, $dbname);

if ($conn->connect_error) {
    die("数据库连接错误: " . $conn->connect_error);
}

// 设置字符集为utf8
$conn->set_charset('utf8');
?>
