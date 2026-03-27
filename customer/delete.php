<?php
include '../connect.php';

if (!isset($_GET['id'])) die("Customer ID not specified");
$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM customers WHERE customer_id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $stmt->close();
    header("Location: read.php");
    exit;
} else {
    echo "Error deleting customer: " . $stmt->error;
    $stmt->close();
}
?>