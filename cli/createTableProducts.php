<?php

$servername = "localhost";
$username = "dev";
$password = "ghbdtn";
$dbname = "mydb";

// Create TABLE products
$sql = "CREATE TABLE products (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    status tinyint(1) NOT NULL,
    category_id int(11) UNSIGNED DEFAULT NULL,
    price float UNSIGNED NOT NULL,
    brand varchar(255) NOT NULL,
    description text NOT NULL,
    is_new tinyint(1) NOT NULL DEFAULT '1',
    is_recommended tinyint(1) NOT NULL DEFAULT '0',
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