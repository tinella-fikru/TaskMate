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
    $query = "delete from tasks where TaskID='$tid'";
    mysqli_query($con, $query);
}

      header("Location: main.php");
      die;
?>
