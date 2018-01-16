<?php
$servername = "localhost";
$username = "dev";
$password = "ghbdtn";
$dbname = "mydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

echo "Connected successfully\n\n";

// Create database
$sql = "CREATE TABLE posts (
    id int(11) NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    content text NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);";

if (mysqli_query($conn, $sql)) {
    echo "Table posts created successfully\n\n";

} else {
    printf("Error creating table: %s\n", mysqli_error($conn));
}

mysqli_close($conn);
?>