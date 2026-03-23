<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "movierental";

$conn = new mysqli($host, $username, $passwd, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Rental</title>
</head>
<body>
    <h1>Hello World!</h1>
</body>
</html>