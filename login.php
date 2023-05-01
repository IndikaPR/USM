<?php 
require_once('include/connection.php');

if(isset($_POST["Login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $success = mysqli_query($connection, "SELECT * FROM user_information WHERE user_name= '$username' AND user_password = '$password'");

    if(mysqli_num_rows($success) > 0) {
        $user_info = mysqli_fetch_assoc($success); // get user info

        // header("Location: profile.php?username=" . urlencode(base64_encode($user_info['user_name'])) . "&email=" . urlencode($user_info['user_email']) . "&userid=" . urlencode($user_info['user_id']) . "&userimage=$user_info['user_profile'])");

        header("Location: profile.php?username=" . urlencode(base64_encode($user_info['user_name'])). "&firstname=" . urlencode($user_info['first_name']). "&lastname=" . urlencode($user_info['last_name']). "&address=" . urlencode($user_info['user_address']) . "&email=" . urlencode($user_info['user_email']) . "&userid=" . urlencode($user_info['user_id']) . "&userimage=" . $user_info['user_profile']);


        //header("Location: profile.php?username={$user_info['user_name']}&email={$user_info['user_email']}&userid={$user_info['user_id']}"); // pass user information as query parameter


        exit();
    } else {
        //echo "<script> alert('Unsuccessfully Registered');</script>";
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/style.css" />

    <title>Login Page</title>
  </head>
  <body>
    <div class="container">
      <form action="login.php" method="post" class="container--1">
        <div class="input-type">
          <label for="username">Username:</label>
          <input type="text" name="username" required />

          <label for="password">Password:</label>
          <input type="password" name="password" required />
        </div>
        <div>
          <input type="submit" name="Login" value="Login" />
        </div>
      </form>

      <form action="signup.php" method="post">
        <div>
          You have already registered? 
          <input type="submit" name="signup" value="Signup" />
        </div>
      </form>
    </div>
  </body>
</html>
