<?php
include '../connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>All Customers</title>
    <link rel="stylesheet" href="read.css">
</head>
<body>
<h1>All Customers</h1>
<p><a class="add-new" href="create.php">Add New Customer</a></p>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Type</th>
        <th>Actions</th>
    </tr>

<?php
$result = $conn->query("SELECT * FROM customers");
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
                <a href='delete.php?id={$row['customer_id']}' onclick=\"return confirm('Are you sure?')\">Delete</a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No customers found</td></tr>";
}
?>
</table>
</body>
</html>