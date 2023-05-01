<?php 

// connection with database
$connection = mysqli_connect('localhost', 'root', '', 'user_management_system');

//checking the connection
if(mysqli_connect_errno()){
  die('Databse Connection Failed' . mysqli_connect_error());
};

?>