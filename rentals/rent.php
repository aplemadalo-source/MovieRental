<?php
include '../connect.php';

$message = "";

// Customers
$customers = $conn->query("SELECT customer_id, name FROM customers");

// 🎬 MOVIE OPTIONS (you can edit this anytime)
$movies = [
    "Avengers: Endgame",
    "Spider-Man: No Way Home",
    "Batman: The Dark Knight",
    "Fast & Furious 10",
    "John Wick 4",
    "Interstellar",
    "Inception"
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $movie_title = $_POST['movie_title'];
    $rent_date = $_POST['rent_date'];

    if (empty($customer_id) || empty($movie_title) || empty($rent_date)) {
        $message = "All fields are required!";
    } else {
        $stmt = $conn->prepare("
            INSERT INTO rentals (customer_id, movie_title, rent_date)
            VALUES (?, ?, ?)
        ");
        $stmt->bind_param("iss", $customer_id, $movie_title, $rent_date);

        if ($stmt->execute()) {
            header("Location: rentals_list.php");
            exit;
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rent Movie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<!-- NAVIGATION -->
<div style="display:flex; justify-content:space-between; align-items:center;">
    <h1>🎬 Rent Movie</h1>
    <a href="rentals_list.php">📋 View Rentals</a>
</div>

<?php if($message) echo "<p>$message</p>"; ?>

<form method="POST">

    <label>Customer</label>
    <select name="customer_id" required>
        <option value="">Select Customer</option>
        <?php while($row = $customers->fetch_assoc()) { ?>
            <option value="<?= $row['customer_id'] ?>">
                <?= $row['name'] ?>
            </option>
        <?php } ?>
    </select>

    <label>Movie Title</label>
    <select name="movie_title" required>
        <option value="">Select Movie</option>
        <?php foreach ($movies as $movie) { ?>
            <option value="<?= $movie ?>"><?= $movie ?></option>
        <?php } ?>
    </select>

    <label>Rent Date</label>
    <input type="date" name="rent_date" required>

    <button type="submit">🎟 Rent Movie</button>

</form>

</div>

</body>
</html>