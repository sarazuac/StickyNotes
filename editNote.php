<?php
include 'global.php';

$id = isset($_POST['noteID']) ? $_POST['noteID'] : '';
$title = isset($_POST['title']) ? $_POST['title'] : '';
$body = isset($_POST['body']) ? $_POST['body'] : '';

echo $id;
echo $title;
echo $body;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE notes SET title = '$title' , body = '$body', updated_at = CURRENT_TIMESTAMP() WHERE id = $id";
//$sql = "SELECT id, name, email, password FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if($result ==1){
  //session_start();
  //$_SESSION['signed_in'] = 1;
  echo "update note success";
}else{
  echo "Something went wrong with edit notes";
}



$conn->close();
?>
