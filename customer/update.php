<?php
include '../connect.php';
$message = "";

if (!isset($_GET['id'])) die("Customer ID not specified");
$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM customers WHERE customer_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();
$stmt->close();

if (!$customer) die("Customer not found");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $customer_type = $_POST['customer_type'];

    $stmt = $conn->prepare("UPDATE customers SET name=?, email=?, phone=?, customer_type=? WHERE customer_id=?");
    $stmt->bind_param("ssssi", $name, $email, $phone, $customer_type, $id);

    if ($stmt->execute()) {
        $message = "Customer updated successfully ✅";
        $customer['name'] = $name;
        $customer['email'] = $email;
        $customer['phone'] = $phone;
        $customer['customer_type'] = $customer_type;
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>
</head>
<body>
<h1>Edit Customer</h1>
<p><a href="read.php">Back to All Customers</a></p>

<?php if($message) echo "<p>$message</p>"; ?>

<form method="POST" action="">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($customer['name']) ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($customer['email']) ?>" required><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" value="<?= htmlspecialchars($customer['phone']) ?>"><br><br>

    <label>Customer Type:</label><br>
    <select name="customer_type" required>
        <option value="walk-in" <?= $customer['customer_type']=='walk-in'?'selected':'' ?>>Walk-in</option>
        <option value="online" <?= $customer['customer_type']=='online'?'selected':'' ?>>Online</option>
    </select><br><br>

    <button type="submit">Update Customer</button>
</form>
</body>
</html>