<?php
include 'global.php';

$email = $_GET["email"];
$uPassword = $_GET["password"];
$_SESSION['signed_in']  = 0;


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, email, password FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

    $password_sql = "SELECT password FROM users WHERE email = '$email'";
    $password_result = $conn->query($password_sql);

    if ($password_result->num_rows > 0) {
        // output data of each row

        while($row = $result->fetch_assoc()) {

            if($row["password"] == $uPassword){
              session_start();
              $_SESSION['signed_in']  = 1;
              $_SESSION['email']  = $email;

              echo "1";

            }else{
              echo "3";
            }

        }
    }//if


} else {
    echo "2";
}





//
// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["email"]. " " .$row["password"];
//     }
// } else {
//     echo "0 results";
// }
$conn->close();
?>
