<?php 
  require_once('include/connection.php');

  if(isset($_POST["SignUp"])) {

    // &_Files = get all informations of the file which user upload
    $fileName = $_FILES['userprofile']['name'];
    $fileTmpName = $_FILES['userprofile']['tmp_name']; //file temporary location
    $fileSize = $_FILES['userprofile']['size'];
    $fileError = $_FILES['userprofile']['error'];
    $fileType = $_FILES['userprofile']['type'];

    //separate extension from the file name
    $fileExt = explode('.', $fileName);

    //convert file extension to lowercase 
    $fileActualExt = strtolower($fileExt['1']);

    //file type that we allowed
    $allowed = array('jpg', 'jpeg', 'png');

    //validation
    // check if the extension is inside of that array
    if(in_array($fileActualExt, $allowed)){
      // check if the file have any errors
      if($fileError === 0 ){
        //check the file size
        if($fileSize < 1000000){
          //create unique id name to avoid file override
          // 'uniqid'  function create random number
          $fileNewName = uniqid('',true).".".$fileActualExt;

          //actual file upload destionation
          $fileDest = 'uploads/'. $fileNewName;

          // move file from the temporary location to actual location
          move_uploaded_file($fileTmpName, $fileDest);

          header("Location: profile.php?upload=success");

        }else{
          echo "File is too big";
        };

      }else{
        echo "There is an error";
      };

    }else {
      echo "You cannot upload this type of file";
    };

    // Assign variable 
    $userName = $_POST['username'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $userAddress = $_POST['address'];
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];

    //$userProfile = $_post['userprofile'];

    $sql = "INSERT INTO user_information (user_name, first_name, last_name, user_address, user_email, user_password, user_profile) VALUES ('$userName','$firstName', '$lastName', '$userAddress', '$userEmail', '$userPassword', '$fileNewName')";


    $result = mysqli_query($connection, $sql);


    // Check result successfully registered
    if($result){
      echo "<script> 
              alert('Successfully Registered');
              window.location.href = 'login.php';
            </script>";
      exit();
    } else {
      echo "<script> alert('Unsuccessfully Registered');</script>";
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

    <title>Sign up</title>
  </head>
  <body>
    <div class="container">
      <form name="myform" action="signup.php" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
        <label for="profile">Profile Picture</label>
        <input type="file" name="userprofile" required />

        <label for="username">Username:</label>
        <input type="text" name="username" />

        <label for="firstname">First Name:</label>
        <input type="text" name="firstname"/>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname"/>

        <label for="address">Address:</label>
        <textarea class="address" name="address" rows="4" cols="35"></textarea>

        <label for="email">Email:</label>
        <input type="email" name="email"/>

        <label for="password">Password:</label>
        <input type="password" name="password" />

        <input type="submit" name="SignUp"/>
      </form>
    </div>

    <script>  
        function validateform(){  
          // validate input fields and password
          var username=document.myform.username.value;  
          var password=document.myform.password.value;

          var firstname=document.myform.firstname.value;  
          var lastname=document.myform.lastname.value;  
            
          var address=document.myform.address.value;   
            
          if ((username==null || username=="") && (firstname==null || firstname=="") && (lastname==null || lastname=="") && (address==null || address=="") ){  
            alert("Fields can't be blank");  
            return false;  
          }else if(password.length<6){  
            alert("Password must be at least 6 characters long.");  
            return false;  
          }

          //validate email  
          var email=document.myform.email.value;  
          var atposition=email.indexOf("@");  
          var dotposition=email.lastIndexOf(".");  
          if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
            alert("Please enter a valid e-mail address \n atpostion:"+atposition+"\n dotposition:"+dotposition);  
            return false;  
            }  
        }      
        
    </script>
  </body>
</html>