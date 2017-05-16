<?php
include 'global.php';

$createdby = isset($_POST['email']) ? $_POST['email'] : '';
$title = isset($_POST['note_title_create']) ? $_POST['note_title_create'] : '';
$body = isset($_POST['note_body_create']) ? $_POST['note_body_create'] : '';

echo $createdby ;
echo $title;
echo $body;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO notes (createdby, title, body) VALUES ('$createdby', '$title', '$body')";
//$sql = "SELECT id, name, email, password FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if($result ==1){
  //session_start();
  //$_SESSION['signed_in'] = 1;
  echo "create note success";
}else{
  echo "Something went wrong with notes";
}



$conn->close();
?>
<script>
window.location ="index.php";
</script>
