<?php
include '../connect.php';

$message = "";

// Get customers for dropdown
$customers = $conn->query("SELECT customer_id, name FROM customers");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $movie_title = $_POST['movie_title'];
    $rent_date = $_POST['rent_date'];

    if (empty($customer_id) || empty($movie_title) || empty($rent_date)) {
        $message = "All fields are required!";
    } else {
        $stmt = $conn->prepare("INSERT INTO rentals (customer_id, movie_title, rent_date) VALUES (?, ?, ?)");
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

<h1>Rent a Movie</h1>

<?php if($message) echo "<p>$message</p>"; ?>

<form method="POST">

    <label>Customer:</label>
    <select name="customer_id" required>
        <option value="">Select Customer</option>
        <?php while($row = $customers->fetch_assoc()) { ?>
            <option value="<?= $row['customer_id'] ?>">
                <?= $row['name'] ?>
            </option>
        <?php } ?>
    </select>

    <label>Movie Title:</label>
    <input type="text" name="movie_title" required>

    <label>Rent Date:</label>
    <input type="date" name="rent_date" required>

    <button type="submit">Rent Movie</button>

</form>

<a href="rentals_list.php">View Rentals</a>

</div>

</body>
</html>