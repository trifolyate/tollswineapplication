<?php

// Database credentials
$host = 'us-cdbr-east-06.cleardb.net';
$username = 'b34e5df2471635';
$password = '6ffed3a5';
$database = 'heroku_eb7517145b609d1';

// Create a new MySQLi instance
$mysqli = new mysqli($host, $username, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Connection successful
echo 'Connected to the database!';

// You can now perform database operations using the $mysqli object

// Close the connection when you're done
$mysqli->close();
?>
