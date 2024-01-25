<?php
session_start();

include("db/connection.php");
include("db/functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
<link rel="stylesheet" href="styles/main.css?version32" />
<link rel="stylesheet" href="styles/color.css?version2" />

<title>Home page</title>
</head>
<body>
<div class="whole">
  <div class="sidebar">
    <div class="profile" id="sticky">
      <div class="namepart"><h4>TaskMate</h4></div>
        <ul>
          <li><a href="main.php" onclick="toggle()"><i class="fa fa-home" aria-hidden="true"></i></a></li>
          <li><a href="newtask.php" onclick="toggle()"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
          <li><a href="manageacc.php" onclick="toggle()"><i class="fa fa-user" aria-hidden="true"></i></a></li>
          <li><a href="front.html" onclick=" toggle()"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
        </ul>

      <div class="toggle" onclick="toggle()"></div>
    </div>
  </div>


  <div class="mainpart" id="mainpart">
    <div onclick="location.href='./Payment/premium.php'" class="prem_button"><button>premium</button></div>
  <div class="container">
  <div class="cal">
  <div class="goto-today">
  <div><button class="today-btn" onclick="location.href='main.php'">Today</button></div>
  <form method="post">
    <div class="goto">
    <input type="date" placeholder="yyyy-mm-dd" maxlength="10" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="date-input" name="date-input" required/>
    <button class="goto-btn" name="goto-btn" type="submit">Go</button>
    </div>
  </form>
  </div> 

  <div class="event-date"><?php echo date('l M, d Y'); ?></div>
  <div><h3><?php echo $user_data['FirstName'].' '.$user_data['LastName']; ?></h3></div>
  </div>


  </div>

  <div class="maindisp">
    <div class="events">
      <?php
      $id = $user_data['id'];
      $currentDate = date('Y-m-d');
      $bool = false;
      if(isset($_POST['goto-btn'])){
        $id = $user_data['id'];
        $ndate = date($_POST['date-input']);
        $t1 = strtotime(date($_POST['date-input']));
        $t2 = date('l M, d Y',$t1);
        $bool = true;
        ?>
          <script>
            var value = " <?= $t2 ?>";
            const eventdate = document.querySelector(".event-date");
            eventdate.innerHTML = value; 
          </script>
        <?php $query = "select * from tasks where UserID = '$id' and Date = '$ndate' order by Status, Priority desc";
        $run_query = mysqli_query($con, $query);
        if(mysqli_num_rows($run_query) > 0){
          foreach($run_query as $row2){
            $class = 'task-display';
            if($row2['Priority'] == 1){
              $class = 'task-display-green';
            }
            else if($row2['Priority'] == 2){
              $class = 'task-display-yellow';
            }
            else if($row2['Priority'] == 3){
              $class = 'task-display-red';
            }
            else{
              $class = 'task-display';
            }

            $sdes = 'pending';
        if($row2['Status'] == 1){
          $sdes = 'Pending';
        }
        else if($row2['Status'] == 2){
          $sdes = 'On progress';
        }
        else if($row2['Status'] == 3){
          $sdes = 'Completed';
        }
          ?>
          <div class="task-display <?php echo $class; ?>" >
            <div class="title-div"><?= $row2['Title']; ?></div>
            <div class="nec-btns">
            <div class="stat-prog" onclick="location.href='editstat.php?id=<?= $row2['TaskID']; ?>';"><?php echo $sdes; ?></div>
            <div class="edit-btn"><button onclick="location.href='edittask.php?id=<?= $row2['TaskID']; ?>';"><i class="fa-solid fa-pen"></i></button></div>
            <div class="del-btn"><button onclick="location.href='deletetask.php?id=<?= $row2['TaskID']; ?>';"><i class="fa fa-trash" aria-hidden="true"></i></button></div>
          </div>
        </div>
        <?php
        }
        }
        else{
        echo "No tasks pending...";
        ?></div><?php
        }
      }

    if(isset($_POST['filter-btn'])){
        $pri = $_POST['priority'];
        $stat = $_POST['status'];
        $bool = true;
        ?>
        <?php 
        
        $qu = "select * from tasks where UserID = '$id' and Date = '$currentDate' and Priority = '$pri' and Status = '$stat' order by Status, Priority desc";
        $run_qu = mysqli_query($con, $qu);
        if(mysqli_num_rows($run_qu) > 0){
          foreach($run_qu as $row3){
            $class = 'task-display';
            if($row3['Priority'] == 1){
              $class = 'task-display-green';
            }
            else if($row3['Priority'] == 2){
              $class = 'task-display-yellow';
            }
            else if($row3['Priority'] == 3){
              $class = 'task-display-red';
            }

            $sdes = 'pending';
        if($row3['Status'] == 1){
          $sdes = 'Pending';
        }
        else if($row3['Status'] == 2){
          $sdes = 'On progress';
        }
        else if($row3['Status'] == 3){
          $sdes = 'Completed';
        }
          ?>
          <div class="task-display <?php echo $class; ?>" >
            <div class="title-div"><?= $row3['Title']; ?></div>
            <div class="nec-btns">
              <div class="stat-prog"><?php echo $sdes; ?></div>
              <div class="edit-btn"><button onclick="location.href='edittask.php?id=<?= $row3['TaskID']; ?>';"><i class="fa-solid fa-pen"></i></button></div>
              <div class="del-btn"><button onclick="location.href='deletetask.php?id=<?= $row3['TaskID']; ?>';"><i class="fa fa-trash" aria-hidden="true"></i></button></div>
            </div>
          </div>
        <?php
        }
        }
        else{
        echo "No tasks pending...";
        ?></div><?php
        }
      }

      
      if($bool == false){
      $query2 = "select * from tasks where UserID = '$id' and Date='$currentDate' order by Status, Priority desc";
      $run_query = mysqli_query($con, $query2);
      if(mysqli_num_rows($run_query) > 0){
      foreach($run_query as $row2){
        $class = 'task-display';
        if($row2['Priority'] == 1){
          $class = 'task-display-green';
        }
        else if($row2['Priority'] == 2){
          $class = 'task-display-yellow';
        }
        else if($row2['Priority'] == 3){
          $class = 'task-display-red';
        }

        $sdes = 'pending';
        if($row2['Status'] == 1){
          $sdes = 'Pending';
        }
        else if($row2['Status'] == 2){
          $sdes = 'On progress';
        }
        else if($row2['Status'] == 3){
          $sdes = 'Completed';
        }
      ?>
      <div class="task-display <?php echo $class; ?>" >
          
        <div class="title-div"><?= $row2['Title']; ?></div>
        <div class="nec-btns">
          <div class="stat-prog"><?php echo $sdes; ?></div>
          <div class="edit-btn"><button onclick="location.href='edittask.php?id=<?= $row2['TaskID']; ?>';"><i class="fa-solid fa-pen"></i></button></div>
          <div class="del-btn"><button onclick="location.href='deletetask.php?id=<?= $row2['TaskID']; ?>';"><i class="fa fa-trash" aria-hidden="true"></i></button></div>
        </div>
      </div>
      <?php
      }
      }
      else{
      echo "No tasks pending...";
      ?></div><?php
      }
      }
      ?>
    </div>
  </div>
</div>
</body>
</html>
<script src="scripts/stylemain.js"></script>
<!-- <script src="Notification/script.js"></script> -->

<!-- <script src="script.js"></script> -->
