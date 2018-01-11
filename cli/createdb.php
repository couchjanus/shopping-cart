<?php
$servername = "localhost";
$username = "dev";
$password = "ghbdtn";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

echo "Connected successfully\n\n";

// Create database
$sql = "CREATE DATABASE mydb";

if (mysqli_query($conn, $sql)) {
    echo "Database created successfully\n\n";

} else {
    // echo "Error creating database: " . mysqli_error($conn);
    printf("Error creating database: %s\n", mysqli_error($conn));
}

mysqli_close($conn);
?>