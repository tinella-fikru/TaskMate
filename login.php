<?php
session_start();

include("db/connection.php");
include("db/functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $user_name = $_POST['user_name'];
	$password = $_POST['password'];

	if(!empty($user_name) && !empty($password)){
		$query = "select * from users where UserName = '$user_name' limit 1";
		$result = mysqli_query($con, $query);

		if($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
			if($user_data['Password'] === $password){
				$_SESSION['id'] = $user_data['id'];
        $newid = $user_data['id'];
        $query0 = "select * from premium_accounts where ID = '$newid'";
        $result0 = mysqli_query($con, $query0);
        if($result0 && mysqli_num_rows($result0) > 0){
          header("Location: mainpremium.php");
          die;
        }
        else{
          header("Location: main.php");
          die;
        }
				
			}
      else{?>
        <script>alert('Wrong username or password')</script>
       <?php
			}
		}
		else{
			echo "Please enter some valid information!";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/login.css?version3" />
  <title>Document</title>
</head>
<body class="login_body">
  <header class="login_header">
    <nav>
      <h2>TASKMATE</h2>
      <ul>
        <li><a href="front.html">Home</a></li>
        <li><a href="signup.php">Sign up</a></li>
      </ul>
    </nav>
  </header> 
<div class="wrapper">
  <div class="form-box">
   <h2>Login</h2>
   <form method="post">
    <div class="input-box">
    <input type="text" required name="user_name" value="">
    <label for="userName">UserName</label>
    </div>
    <div class="input-box">
    <input type="password" required name="password" value="">
    <label for="pwd">Password</label>
</div>
<div>
<button class="btn" type="submit" class="btn">Login</button>
</div>
<div class="passforgot">
  <button><a href="getpass.php">Forgot password?</a></button>
</div>

</div>
    
</form>
</div>
</div> 
</body>
</html>
