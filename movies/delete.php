<?php
include '../connect.php';

 
// Check if movie ID is provided
if (!isset($_GET['id'])) {
    die("Movie ID not specified.");
}

$id = $_GET['id'];

// Delete movie using prepared statement
$stmt = $conn->prepare("DELETE FROM movies WHERE movie_id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $stmt->close();
    // Redirect back to read.php after deletion
    header("Location: read.php");
    exit;
} else {
    echo "Error deleting movie: " . $stmt->error;
    $stmt->close();
}
?>