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
$sql = "CREATE TABLE guestbook (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(25) NOT NULL,
    email varchar(30) NOT NULL,
    comment text NOT NULL,
    appended_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);";

if (mysqli_query($conn, $sql)) {
    echo "Table guetbook created successfully\n\n";

} else {
    printf("Error creating table: %s\n", mysqli_error($conn));
}

mysqli_close($conn);
?>