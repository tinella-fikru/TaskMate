<?php
session_start();

include("db/connection.php");
include("db/functions.php");

$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($_GET["id"])){
      header("Location: main.php");
      die;
    }

    $tid = $_GET["id"];
    $query0 = "select * from tasks where TaskID='$tid' limit 1";
    $result0 = mysqli_query($con, $query0);

    if($result0 && mysqli_num_rows($result0) > 0){
      $task_data = mysqli_fetch_assoc($result0);
    }

    if($task_data['Status'] == 1){
        $query = "update tasks set Status='2' where TaskID='$tid'";
        mysqli_query($con, $query);
    }
    else if($task_data['Status'] == 2){
        $query = "update tasks set Status='3' where TaskID='$tid'";
        mysqli_query($con, $query);
    }
    else if($task_data['Status'] == 3){
        $query = "update tasks set Status='1' where TaskID='$tid'";
        mysqli_query($con, $query);
    }   
}
      header("Location: main.php");
      die;
?>
