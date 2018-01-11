<?php
$servername = "localhost";
$username = "dev";
$password = "ghbdtn";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully\n\n";
mysqli_close($conn);
?>