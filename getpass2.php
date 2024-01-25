 e<?php
session_start();

include("db/connection.php");
include("db/functions.php");

$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $id = $user_data['id'];
  $ans = $_POST['Ans'];
  if(!empty($ans) && $user_data['SecAnswer'] == $ans){
    $pass = $user_data['Password'];
    ?>
    <script>
      var pass = " <?= $pass ?>";
      alert('Your password is' + pass)
    </script>

<?php
    
		}
    else{?>
        <script>alert('Incorrect answer')</script>
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
      <h2> Security question </h2>
      <form method="post">
        <div class="input-box">
          <input type="text" required name="Ans" value="">
          <label for="Que"><?php if ($user_data['SecQuestion'] == 'pet') echo 'What is your pets name?'; ?></label>
          <label for="Que"><?php if ($user_data['SecQuestion'] == 'high school') echo 'Which high school did you go to?'; ?></label>
          <label for="Que"><?php if ($user_data['SecQuestion'] == 'color') echo 'What is your favorite color?'; ?></label>
          <label for="Que"><?php if ($user_data['SecQuestion'] == 'occupation') echo 'What is your occupation?'; ?></label>
          <label for="Que"><?php if ($user_data['SecQuestion'] == 'mother') echo 'What is your mothers name?'; ?></label>
          <label for="Que"><?php if ($user_data['SecQuestion'] == 'spouse') echo 'What is the name of your spouse?'; ?></label>
        </div>
        <button class="btn" type="submit">Send</button>
      </form>
    </div>
  </div>
</body>
</html>
