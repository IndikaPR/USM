<?php
require_once('include/connection.php');

session_start();
$userName =$_SESSION["username"];
$firstName =$_SESSION["firstname"];
$userEmail =$_SESSION["useremail"];
$lastName =$_SESSION["lastname"];
$userAddress =$_SESSION["address"];
$userID =$_SESSION["userID"];
$int_value = (int) $userID;

    if(isset($_POST['update'])){

          $name = $_POST["name"];
          $email = $_POST["email"];
          $password = $_POST["password"];
          $firstname = $_POST["firstname"];
          $lastname = $_POST["lastname"];
          $address = $_POST["address"];
      
          $sql = "UPDATE user_information SET user_name='$name', first_name = '$firstname', last_name = '$lastname', user_address = '$address', user_email='$email', user_password='$password' WHERE user_id='$int_value'";
      
          $result = mysqli_query($connection, $sql);
      
          if ($result) {
            echo "<script> 
                        alert('User information update succesfully');
                        window.location.href = 'login.php';
                      </script>";
            exit();
          } else {
            echo "Error updating user information: " . mysqli_error($connection);
          }

    }

mysqli_close($connection);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Update</title>

  <style>
    body {
  font-family: Arial, sans-serif;
}

h1 {
  text-align: center;
}

form {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
  width: 90%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
}

input[type="submit"] {
  background-color: #4caf50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #3e8e41;
}

  </style>
</head>
<body>
<h1>Update User Information</h1>
    <form method="post" action="update.php" enctype="multipart/form-data">
        <label for="name">Add user name: </label>
        <input type="text" id="name" name="name" value="<?php echo $userName ?>" required>

      <label for="name">Add first name: </label>
      <input type="text" id="name" name="firstname" value="<?php echo $firstName ?>" required>

      <label for="name">Add last name: </label>
      <input type="text" id="name" name="lastname" value="<?php echo $lastName ?>" required>

      <label for="name">Add new address: </label>
      <input type="text" id="name" name="address" value="<?php echo $userAddress ?>" required>

      <label for="email">Add new email: </label>
      <input type="email" id="email" name="email" value="<?php echo $userEmail ?>" required>

      <label for="password">Add new password:</label>
      <input type="password" id="password" name="password" required>

      <input type="submit" value="Update" name="update">


      
    </form>
</body>
</html>