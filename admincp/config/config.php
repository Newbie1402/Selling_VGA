<?php
$host = 'mysql'; // Sử dụng tên service trong docker-compose
$port = '3306'; // Port mặc định bên trong container MySQL là 3306
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