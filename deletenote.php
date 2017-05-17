<?php
include 'global.php';

$id = isset($_POST['noteID']) ? $_POST['noteID'] : '';


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM notes WHERE id = $id";
//$sql = "SELECT id, name, email, password FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if($result ==1){
  //session_start();
  //$_SESSION['signed_in'] = 1;
  echo "delete note success";
}else{
  echo "Something went wrong with delete notes";
}



$conn->close();
?>
