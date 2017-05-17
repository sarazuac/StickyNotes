<?php
include 'global.php';

$noteID = isset($_GET['noteID']) ? $_GET['noteID'] : '';
session_start();
$createdby = $_SESSION['email'];

 if($noteID !=''){
   $noteID = " AND id = " . $noteID;
}
// echo $createdby ;
// echo $title;
// echo $body;
//echo $noteID;


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM notes WHERE createdby = '$createdby'". $noteID;
//$sql = "SELECT id, name, email, password FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $arr = array();
    while($row = $result->fetch_assoc()) {
      $arr[] = $row;
      //echo "id: " . $row["id"]. " - Name: " . $row["title"]. " " . $row["body"]. " " .$row["createdby"];

    }
    $data = array('Notes' =>$arr);
    print json_encode($data);
}else{
  echo "List notes failed";
}//if







$conn->close();
?>
