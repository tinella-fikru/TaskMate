<?php
session_start();

include("db/connection.php");
include("db/functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $email = $_POST['email'];
	
	if(!empty($email)){
		$query = "select * from users where Email = '$email' limit 1";
		$result = mysqli_query($con, $query);
		if($result && mysqli_num_rows($result) > 0){
      $user_data = mysqli_fetch_assoc($result);
      $_SESSION['id'] = $user_data['id'];
			header("Location: getpass2.php");
			die;
    }
  }
  else{?>
    <script>alert('Email not in system')</script>
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
    <link rel="stylesheet" href="styles/newTask.css?version3" />
    <title>My website</title>
</head> 
<body>
<header class="login_header">
    <nav>
      <h2>TASKMATE</h2>
      <ul>
        <li><a href="front.html">Home</a></li>
        <li><a href="login.php">Log in</a></li>
      </ul>
    </nav>
  </header> 

  <div class="wrapper">
    <div class="form-box">
      <h2> Get password </h2>
      <form method="post">
        <div class="input-box">
          <input  type="email" required name="email" value="">
          <label for="Email">Email</label>
        </div>
        <button class="btn" type="submit">Send</button>
      </form>
    </div>
  </div>
</body>
</html>
