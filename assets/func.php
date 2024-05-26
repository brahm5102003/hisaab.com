<?php
// session_start();
// session_unset();
// 1. functio for find user detail by user_id

function getuser($u)
{
    include 'conn.php';
    $sql_fetc_user_data=mysqli_query($conn,"SELECT * FROM `logindata` WHERE `log_id`='$u'");
    $user_data=mysqli_fetch_assoc($sql_fetc_user_data);
    return $user_data;
}


?>