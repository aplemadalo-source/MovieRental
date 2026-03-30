<?php
include '../connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="UTF-8">
    <title>All Movies</title>
    <link rel="stylesheet" href="read.css">
    
</head>
<body>
    <h1>All Movies</h1>
    <p><a href="create.php" class="add-new">Add New Movie</a></p>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Genre</th>
            <th>Release Year</th>
            <th>Stock</th>
            <th>Rental Price</th>
            <th>Actions</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM movies");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['movie_id']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['genre']}</td>
                        <td>{$row['release_year']}</td>
                        <td>{$row['stock']}</td>
                        <td>{$row['rental_price']}</td>
                        <td>
                            <a href='update.php?id={$row['movie_id']}'>Edit</a> | 
                            <a href='delete.php?id={$row['movie_id']}' onclick=\"return confirm('Are you sure?')\">Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No movies found</td></tr>";
        }
        ?>
    </table>
</body>
</html>