<?php include("../config/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h1>Movie Dashboard</h1>
    <a href="../add/add.php">Add Movie</a>

    <div class="card">
        <table border="1" width="100%">
            <tr>
                <th>Title</th>
                <th>Genre</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>

            <?php
            $result = $conn->query("SELECT * FROM movies");

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['title']}</td>
                    <td>{$row['genre']}</td>
                    <td>{$row['year']}</td>
                    <td>
                        <a href='../edit/edit.php?id={$row['id']}'>Edit</a>
                        <a href='../delete/delete.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>