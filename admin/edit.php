<?php include("../config/db.php"); ?>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM movies WHERE id=$id");
$row = $result->fetch_assoc();

if(isset($_POST['update'])) {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];

    $conn->query("UPDATE movies 
                  SET title='$title', genre='$genre', year='$year' 
                  WHERE id=$id");

    header("Location: ../dashboard/index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Movie</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h1>Edit Movie</h1>

    <div class="card">
        <form method="POST">
            <input type="text" name="title" value="<?= $row['title'] ?>" required>
            <input type="text" name="genre" value="<?= $row['genre'] ?>" required>
            <input type="number" name="year" value="<?= $row['year'] ?>" required>

            <button name="update">Update</button>
        </form>
    </div>
</div>

</body>
</html>