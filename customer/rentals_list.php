<?php
include '../connect.php';

$result = $conn->query("
    SELECT rentals.*, customers.name 
    FROM rentals 
    JOIN customers ON rentals.customer_id = customers.customer_id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rentals</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h1>Movie Rentals</h1>

<a href="rent_movie.php">+ Rent Movie</a>

<table>
<tr>
    <th>ID</th>
    <th>Customer</th>
    <th>Movie</th>
    <th>Rent Date</th>
    <th>Status</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['rental_id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['movie_title'] ?></td>
    <td><?= $row['rent_date'] ?></td>
    <td><?= $row['status'] ?></td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>