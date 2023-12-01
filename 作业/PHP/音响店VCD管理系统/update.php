<?php
include_once("conn.php");

if (isset($_POST['ok'])) {
    $num = $_POST['operation'];
    $userid = $_POST['userid'];
    $audio_id = $_POST['audio_id']; // 修改为音频ID

    if ($num == 0) { // 租赁操作
        $time = time();
        $rental_date = date("Y-m-d", $time);
        $return_date = date("Y-m-d", strtotime("+3 months"));

        $query = "INSERT INTO rental_list (audio_id, user_id, rental_date, return_date) 
                  VALUES ('$audio_id', '$userid', '$rental_date', '$return_date')";
        $conn->query($query);
    } else { // 归还操作
        $query = "DELETE FROM rental_list WHERE audio_id='$audio_id' AND user_id='$userid'";
        $conn->query($query);
    }

    header("Location:userborrowInf.php?user_id=$userid");
}

if (isset($_POST['ok2'])) {
    header("Location:borrowmanager.php");
}
?>
