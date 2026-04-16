<?php
include '../connect.php';

if (!isset($_GET['id'])) die("ID missing");

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM customers WHERE customer_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) die("Not found");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $type = $_POST['customer_type'];

    $stmt = $conn->prepare("UPDATE customers SET name=?, email=?, phone=?, customer_type=? WHERE customer_id=?");
    $stmt->bind_param("ssssi", $name, $email, $phone, $type, $id);

    if ($stmt->execute()) {
        header("Location: read.php");
        exit;
    } else {
        echo "Update Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <link rel="stylesheet" href="style.css">

<h1>Edit Customer</h1>

<form method="POST">
    Name: <input type="text" name="name" value="<?= $data['name'] ?>"><br><br>
    Email: <input type="email" name="email" value="<?= $data['email'] ?>"><br><br>
    Phone: <input type="text" name="phone" value="<?= $data['phone'] ?>"><br><br>

    Type:
    <select name="customer_type">
        <option value="walk-in" <?= $data['customer_type']=="walk-in"?"selected":"" ?>>Walk-in</option>
        <option value="online" <?= $data['customer_type']=="online"?"selected":"" ?>>Online</option>
    </select><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>