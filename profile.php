<?php 
require_once('include/connection.php');

if(isset($_GET["username"]) && isset($_GET["email"]) && isset($_GET["userid"]) && isset($_GET["firstname"]) && isset($_GET["lastname"]) && isset($_GET["address"])) {
  $user_info = [
    "user_name" => base64_decode(urldecode($_GET["username"])),
    "user_email" => urldecode($_GET["email"]),
    "user_id" => urldecode($_GET["userid"]),
    "first_name" => urldecode($_GET["firstname"]),
    "last_name" => urldecode($_GET["lastname"]),
    "user_address" => urldecode($_GET["address"]),
    "user_image" => $_GET["userimage"]
  ];
} else {
  header("Location: login.php"); 
}

// get user ID
$user_id = $user_info["user_id"];
$user_name = $user_info["user_name"];
$user_email = $user_info["user_email"];
$first_name = $user_info["first_name"];
$last_name = $user_info["last_name"];
$user_address = $user_info["user_address"];

// start the session
session_start();

// Set session variable for user id
$_SESSION["userID"] = $user_id;
$_SESSION["username"] = $user_name;
$_SESSION["useremail"] = $user_email;
$_SESSION["firstname"] = $first_name;
$_SESSION["lastname"] = $last_name;
$_SESSION["address"] = $user_address;


//echo session variable
// echo $_SESSION["userID"];
// echo $_SESSION["username"];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./css/style.css" /> -->
    <title>Profile Page</title>

    <style>
.container {
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #fff;
}

.header-1{
  text-align: center;
}

.profile-container {
  max-width: 500px;
  margin: 100px auto;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.paragraph-1{
  font-size: 18px;
}

.image {
  display: block;
  margin: 0 auto;
  width: 200px; 
  height: 200px; 
  border-radius: 50%; 
  /* hide any part of the image outside the border */
  overflow: hidden; 
}

.image img {
  display: block;
  width: 100%;
  height: 100%;
  /*make sure the entire image is visible inside the border */
  object-fit: cover; 
}


    </style>
  </head>
  <body>
    <div class="container profile-container ">
      <h1 class='header-1'; >Welcome <?php echo ucfirst($user_info['user_name']) ; ?></h1>

      <div class="image"><?php echo '<img src="uploads/' . $user_info["user_image"] . '" />'; ?></div>
      
      <p class='paragraph-1'; >Your Name: <?php echo ucfirst($user_info['user_name']) ; ?></p>
      <p class='paragraph-1'; >First Name: <?php echo ucfirst($user_info['first_name']) ; ?></p>
      <p class='paragraph-1'; >Last Name: <?php echo ucfirst($user_info['last_name']) ; ?></p>
      <p class='paragraph-1'; >Address: <?php echo ucfirst($user_info['user_address']) ; ?></p>
      <p class='paragraph-1';>User ID: 000<?php echo $user_info['user_id']; ?></p>
      <p class='paragraph-1';>Your Email: <?php echo $user_info['user_email']; ?></p>

      <form action="update.php" method="get">
        <input type="submit" name="update" value="UPDATE PROFILE"/>
      </form>
    </div>
  </body>

</html>

<?php mysqli_close($connection); ?>
