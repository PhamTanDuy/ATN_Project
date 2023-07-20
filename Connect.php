<?php
// Thong tin ket noi MySQL
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'ant_project';

// Ket noi den MySQL
$conn = mysqli_connect($hostname, $username, $password, $database);

// Kiem tra ket noi
if(!$conn){
    die('Error connect to MySQL: ' . mysqli_connect_error());
}

echo 'Successfully connected to MySQL!';

