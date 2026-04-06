<?php
include '../connect.php';

$message = "";

// Get movie ID from URL
if (!isset($_GET['id'])) {
    die("Movie ID not specified");
}

$id = $_GET['id'];

// Fetch movie details
$stmt = $conn->prepare("SELECT * FROM movies WHERE movie_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();
$stmt->close();

if (!$movie) {
    die("Movie not found");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $release_year = $_POST['release_year'];
    $stock = $_POST['stock'];
    $rental_price = $_POST['rental_price'];
    $image = $_FILES['image']['name'];

    $stmt = $conn->prepare("UPDATE movies SET title=?, genre=?, release_year=?, stock=?, rental_price=?, image=? WHERE movie_id=?");
    $stmt->bind_param("ssiiisi", $title, $genre, $release_year, $stock, $rental_price, $image, $id);

    if ($stmt->execute()) {
        $message = "Movie updated successfully ✅";
        // Refresh movie data
        $movie['title'] = $title;
        $movie['genre'] = $genre;
        $movie['release_year'] = $release_year;
        $movie['stock'] = $stock;
        $movie['rental_price'] = $rental_price;
        $movie['image'] = $image;
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>Edit Movie</title>
    <link rel="stylesheet" href="update.css">

 <center>
</head>
<body>
    <h1>Edit Movie</h1>
    <p><a href="read.php" class="back-link">Back to All Movies</a></p>

    <?php if($message) { echo "<p>$message</p>"; } ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($movie['title']) ?>" required><br><br>

        <label>Genre:</label><br>
        <input type="text" name="genre" value="<?= htmlspecialchars($movie['genre']) ?>" required><br><br>

        <label>Release Year:</label><br>
        <input type="number" name="release_year" value="<?= $movie['release_year'] ?>" required><br><br>

        <label>Stock:</label><br>
        <input type="number" name="stock" value="<?= $movie['stock'] ?>" required><br><br>

        <label>Rental Price:</label><br>
        <input type="number" name="rental_price" step="0.01" value="<?= $movie['rental_price'] ?>" required><br><br>

        <label>Image:</label><br>
        <input type="file" name="image" accept="image/*"><br><br>

        <button type="submit">Update Movie</button>

    </form>
</body>
</center>   
</html>