<?php
session_start();

include("db/connection.php");
include("db/functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
  $phone = $_POST['phone'];
	$user_name = $_POST['user_name'];
  $password = $_POST['password'];
  $sec_q = $_POST['secQ'];
  $sec_a = $_POST['secA'];

	if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($phone) && !empty($user_name) && !empty($password) && !empty($sec_q) && !empty($sec_a)){
		$query = "insert into users (FirstName, LastName, Email, Phone, UserName, Password, SecQuestion, SecAnswer) values ('$first_name', '$last_name', '$email', '$phone', '$user_name', '$password', '$sec_q', '$sec_a')";
	  mysqli_query($con, $query);
		header("Location: login.php");
		die;
	}
	else{
	?>
  <script> alert('Please enter necessary input') </script>
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
  <link rel="stylesheet" href="styles/signup.css?version4" />
  <title>Document</title>
</head>
<body>
  <header>
    <nav>
      <h2>TASKMATE</h2>
      <ul>
        <li><a href="front.html">Home</a></li>
        <li><a href="login.php">Log In</a></li>
      </ul>
    </nav>
  </header>
  <div class="wrapper">
    <div class="form-box">
      <h2>Register</h2>
        <form method="post">
          <div class="input-box">
            <input  type="text" required name="first_name" value="">
            <label for="firstName">First Name</label>
          </div>
          <div class="input-box">
            <input  type="text" required name="last_name" value="">
            <label for="lastName">Last Name</label>
          </div>
          <div class="input-box">
            <input  type="email" required name="email" value="">
            <label for="email">Email</label>
          </div>
          <div class="input-box">
            <input placeholder="+251" type="tel" maxlength="13" name="phone" id="phone" pattern="[+][0-9]{12}"  value="">
            <label for="phoneNumber">Phone Number</label>
          </div>
          <div class="input-box">
            <input  type="text" required name="user_name" value="">
            <label for="userName">User Name</label>
          </div>
          <div class="input-box">
            <input  type="password" required name="password" value="">
            <label for="pwd">Password</label>
          </div>
          <select name="secQ" id="secQ" required>
            <optgroup label="Security questions">
            <option value="pet">What is your pets name?</option>
            <option value="high school">Which high school did you go to?</option>
            <option value="color">What is your favorite color?</option>
            <option value="job">What is your occupation?</option>
            <option value="mother">What is your mothers name?</option>
            <option value="spouse">What is the name of your spouse?</option>
            </optgroup>
          </select>

          <div class="input-box">
            <input  type="text" required name="secA" value="">
            <label for="secA">Security Answer</label>
          </div>


          <button class="btn" type="submit" class="btn">Register</button>
        </form>
    </div>
  </div>
</body>
</html>

