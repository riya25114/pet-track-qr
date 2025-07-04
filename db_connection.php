<!-- a common while which can be included everywhere that holds the connection to the database. -->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pettrackqr_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// else {
//   echo "Database connected successfully!";
// }
?>