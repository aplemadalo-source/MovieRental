<?php
// Include database connection
include '../connect.php';

// Initialize variables for messages
$message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $release_year = $_POST['release_year'];
    $stock = $_POST['stock'];
    $rental_price = $_POST['rental_price'];

    // Simple validation
    if (empty($title) || empty($genre) || empty($release_year) || empty($stock) || empty($rental_price)) {
        $message = "All fields are required!";
    } else {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO movies (title, genre, release_year, stock, rental_price) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiii", $title, $genre, $release_year, $stock, $rental_price);

        if ($stmt->execute()) {
            $message = "Movie added successfully ✅";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="create.css">
    <title>Add Movie</title>

</head>
<body>
    <center>
    <h1>Add New Movie</h1>

    <?php if($message) { echo "<p>$message</p>"; } ?>

    <form method="POST" action="">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Genre:</label><br>
        <input type="text" name="genre" required><br><br>

        <label>Release Year:</label><br>
        <input type="number" name="release_year" required><br><br>

        <label>Stock:</label><br>
        <input type="number" name="stock" required><br><br>

        <label>Rental Price:</label><br>
        <input type="number" name="rental_price" step="0.01" required><br><br>

        <button type="submit">Add Movie</button>
    </form>

    <p><a href="read.php" class="link1">View All Movies</a></p>
    </center>
</body>
</html>