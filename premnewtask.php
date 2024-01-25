<?php
session_start();

include("db/connection.php");
include("db/functions.php");

$user_data = check_login($con);
if($_SERVER['REQUEST_METHOD'] == "POST"){

  $id = $user_data['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $category = $_POST['category'];
  $date = $_POST['date'];
  $status = 1;
  $priority = (int)$_POST['priority'];

    if(!empty($title) && !empty($description)){
        $query = "insert into tasks (UserID, Title, Description, Category, Date, Status, Priority) values ('$id', '$title', '$description', '$category', '$date', '$status', '$priority')";
        mysqli_query($con, $query);
        header("Location: mainpremium.php");
        die;
    }
    else{?>
    <script> alert('Please enter valid info') </script>
    <?php
	}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="styles/premnew.css" />
    <!-- <link rel="stylesheet" href="styles/color.css?version1" /> -->
    <link rel="stylesheet" href="themeChanger.css?version1" />
    <title>My website</title>
</head>
<body>
<div class="sidebar">
      <div class="profile" id="sticky">
      <div class="namepart">
        <h2>TaskMate</h2>
      </div>
      <ul>
      <li><a href="mainpremium.php" class="selected_one" onclick="toggle()"><i class="fa fa-home" aria-hidden="true"></i></a></li>
<li><a href="premnewtask.php" onclick="toggle()"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
<li><a href="reports.php" onclick="toggle()"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>
<li><a href="premmanageacc.php" onclick="toggle()"><i class="fa fa-user" aria-hidden="true"></i></a></li>
<li><a href="front.html" onclick="toggle()"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
      </ul>

        <div class="toggle" onclick="toggle()"></div>
    </div>
</div>
<h4><?php echo $user_data['FirstName'].' '.$user_data['LastName']; ?></h4>
  <div class="wrapper">
    <div class="sidespace">
      <label class="sidespace-text">New task</label>
    </div>
    <div class="form-box">
      <form method="post">
        <div class="input-box">
          <input  type="text" required name="title" value="">
          <label for="title">Title</label>
        </div>
        <div class="input-box">
          <input  type="text" required name="description" value="">
          <label for="description">Description</label>
        </div>
    
    <br> <select name="category" id="category" required>
        <option value="" disabled selected hidden>Category</option>
        <option value="reading">Reading</option>
        <option value="sports">Sports</option>
        <option value="nutrition">Nutrition</option>
        <option value="entertainment">Entertainment</option>
        <option value="home">Home</option>
        <option value="finance">Finance</option>
        <option value="social">Social</option>
        <option value="outdoor">Outdoor</option>
        <option value="health">Health</option>
        <option value="art">Art</option>
        <option value="meditation">Meditation</option>
        <option value="study">Study</option>
     </select><br><br>
    <label> Date </label> <input type="date" name="date" class="date" value = "<?php echo date('Y-m-d') ?>"><br><br>
    <select required name="priority" id="priority" value="">
      <option value="" disabled selected hidden>Priority</option>
      <option value="1"> Low</option>
      <option value="2"> Mid</option>
      <option value="3"> High</option>
    </select> 
    <br><br>
	  <button class="btn" type="submit" class="btn">Register</button> 
  </div> 
  </div>
  </form>
</div>
  </body>
</html>
<script src="scripts/stylemain.js"></script>
<script src="theme.js"></script>