<?php
include '../connect.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $customer_type = $_POST['customer_type'];

    if (empty($name) || empty($email) || empty($customer_type)) {
        $message = "Name, Email and Type are required!";
    } else {
        $stmt = $conn->prepare("INSERT INTO customers (name, email, phone, customer_type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $customer_type);

        if ($stmt->execute()) {
            $message = "Customer added successfully ✅";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <center>
<head>
    <meta charset="UTF-8">
    <title>Add Customer</title>
    <link rel="stylesheet" href="create.css">
</head>
<body>
<h1>Add New Customer</h1>
<?php if($message) echo "<p>$message</p>"; ?>

<form method="POST" action="">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone"><br><br>

    <label class="form-label">Customer Type:</label><br>
    <select name="customer_type" required>
        <option value="walk-in">Walk-in</option>
        <option value="online">Online</option>
    </select><br><br>

    <button type="submit">Add Customer</button>
</form>
</center>
<p><a href="read.php" class="back-link">View All Customers</a></p>

</body>
</html>
