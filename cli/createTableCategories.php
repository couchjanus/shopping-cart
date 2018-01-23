<?php

$servername = "localhost";
$username = "dev";
$password = "ghbdtn";
$dbname = "mydb";

// Create TABLE categories
$sql = "CREATE TABLE categories (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    status tinyint(1) NOT NULL,
    PRIMARY KEY (id)
);";

/* проверка соединения */
try {
    $connection = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
    echo "Connected successfully\n";
    $connection->query($sql);
    echo "Table Created successfully\n";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "\n";
    die();
} finally {
    // код, который будет выполнен при любом раскладе
    $connection = null;
}
?>