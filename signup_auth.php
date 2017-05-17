<?php
include 'global.php';

$name = $_POST["name"];
$email = $_POST["email"];
$uPassword = $_POST["password"];
$_SESSION['signed_in']  = 0;


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$uPassword')";
//$sql = "SELECT id, name, email, password FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if($result ==1){
  session_start();
  $_SESSION['signed_in'] = 1;
  $_SESSION['email'] = $email;
  echo "1";
}else{
  echo "0";
}



$conn->close();
?>
