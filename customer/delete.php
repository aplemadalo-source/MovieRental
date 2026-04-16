<?php
include '../connect.php';

if (!isset($_GET['id'])) {
    die("ID missing");
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM customers WHERE customer_id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: read.php");
    exit;
} else {
    echo "Delete Error: " . $stmt->error;
}
?>