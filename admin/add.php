<?php include("../config/db.php"); ?>

<?php
if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];

    $conn->query("INSERT INTO movies (title, genre, year) 
                  VALUES ('$title', '$genre', '$year')");

    header("Location: ../dashboard/index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Movie</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h1>Add Movie</h1>

    <div class="card">
        <form method="POST">
            <input type="text" name="title" placeholder="Title" required>
            <input type="text" name="genre" placeholder="Genre" required>
            <input type="number" name="year" placeholder="Year" required>

            <button name="submit">Save</button>
        </form>
    </div>
</div>

</body>
</html>