<?php
include '../connect.php';

$result = $conn->query("SELECT * FROM customers");

if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Customers</title>
</head>
    <link rel="stylesheet" href="style.css">
<body>

<h1>All Customers</h1>
<a href="create.php">Add New</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Type</th>
    <th>Action</th>
</tr>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['customer_id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['customer_type']}</td>
            <td>
                <a href='update.php?id={$row['customer_id']}'>Edit</a> |
                <a href='delete.php?id={$row['customer_id']}'>Delete</a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No data found</td></tr>";
}
?>

</table>

</body>
</html>