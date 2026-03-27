<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie Rental</title>
</head>
<body>
    <h1>Movie Rental System</h1>
    <p>
        <?php
        if ($conn) {
            echo "Database connected successfully";
        }
        ?>
    </p>
</body>
</html>