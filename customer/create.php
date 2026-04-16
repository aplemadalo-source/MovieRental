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
            header("Location: read.php");
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
    <title>Add Customer</title>
</head>
    <link rel="stylesheet" href="style.css">
<body>

<h1>Add Customer</h1>
<?php if($message) echo "<p>$message</p>"; ?>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Phone: <input type="text" name="phone"><br><br>

    Type:
    <select name="customer_type">
        <option value="walk-in">Walk-in</option>
        <option value="online">Online</option>
    </select><br><br>

    <button type="submit">Add</button>
</form>

<a href="read.php">View Customers</a>

</body>
</html>