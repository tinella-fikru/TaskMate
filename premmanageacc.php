<?php
session_start();

include("db/connection.php");
include("db/functions.php");

$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == "POST"){
$id = $user_data['id']; 
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$user_name = $_POST['user_name'];
$password = $_POST['password'];
$sec_q = $_POST['secQ'];
$sec_a = $_POST['secA'];
if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($phone) && !empty($user_name) && !empty($password) && !empty($sec_q) && !empty($sec_a)){
		$query = "update users set FirstName='$first_name', LastName='$last_name', Email='$email', Phone='$phone', UserName='$user_name', Password='$password', SecQuestion='$sec_q', SecAnswer='$sec_a' where id='$id';";
	  mysqli_query($con, $query);
		header("Location: mainpremium.php");
		die;
	}
	else{
		echo "Please enter valid info";
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
    <link rel="stylesheet" href="styles/premanage.css?version1" />
    <link rel="stylesheet" href="themeChanger.css?version1 "/>
    <title>Manage account</title>
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
      <label class="sidespace-text">Account details</label>
    </div>
  <div class="form-box">
    <form method="post">
      <div class="input-box">
<input type="text" required name="first_name" value="<?php echo $user_data['FirstName']; ?>">
        <label for="firstName">First Name</label>
      </div>
      
      <div class="input-box">
        <input  type="text" required name="last_name" value="<?php echo $user_data['LastName']; ?>">
        <label for="lastName">Last Name</label>
      </div>
      <div class="input-box">
        <input  type="email" required name="email" value="<?php echo $user_data['Email']; ?>">
        <label for="email">Email</label>
      </div>
      <div class="input-box">
        <input placeholder="+251" type="tel" maxlength="13" name="phone" id="phone" pattern="[+][0-9]{12}"  value="<?php echo $user_data['Phone']; ?>">
        <label for="phoneNumber">Phone Number</label>
      </div>
      <div class="input-box">
        <input  type="text" required name="user_name" value="<?php echo $user_data['UserName']; ?>">
        <label for="userName">User Name</label>
      </div>
      <div class="input-box">
        <input  type="text" required name="password" value="<?php echo $user_data['Password']; ?>">
        <label for="pwd">Password</label>
      </div>
      <select name="secQ" id="secQ" required>
            <optgroup label="Security questions">
            <option value="pet" <?php if ($user_data['SecQuestion'] == 'pet') echo 'selected="selected"'?> >What is your pets name?</option>
            <option value="high school" <?php if ($user_data['SecQuestion'] == 'high school') echo 'selected="selected"'?> >Which high school did you go to?</option>
            <option value="color" <?php if ($user_data['SecQuestion'] == 'color') echo 'selected="selected"'?> >What is your favorite color?</option>
            <option value="job" <?php if ($user_data['SecQuestion'] == 'job') echo 'selected="selected"'?> >What is your occupation?</option>
            <option value="mother" <?php if ($user_data['SecQuestion'] == 'mother') echo 'selected="selected"'?> >What is your mothers name?</option>
            <option value="spouse" <?php if ($user_data['SecQuestion'] == 'spouse') echo 'selected="selected"'?> >What is the name of your spouse?</option>
            </optgroup>
          </select>

          <div class="input-box">
            <input  type="text" required name="secA" value="<?php echo $user_data['SecAnswer']; ?>">
            <label for="secA">Security Answer</label>
          </div>
      <button class="btn" type="submit">Update</button>
    </form>
  </div>
  </div>
</body>
</html>
<script src="scripts/stylemain.js"></script>
<script src="theme.js"></script>