<?php
$host = 'localhost'; // or the IP address of the MySQL server
$port = '3307'; // the port number
$username = 'root';
$password = '';
$database = 'htvga';

// Create connection
$mysqli = new mysqli($host, $username, $password, $database, $port);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 

?>