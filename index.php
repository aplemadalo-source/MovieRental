<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie Rental Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="index.css">
</head>
<body>

<div class="container">

    <h1>🎬 Movie Rental System</h1>

    <!-- DASHBOARD CARDS -->
    <div class="dashboard">

        <div class="card">
            <h2>🎬 Movies</h2>
            <p>Manage movie list</p>
            <a href="movies/read.php"><button>View Movies</button></a>
        </div>

        <div class="card">
            <h2>👤 Customers</h2>
            <p>Manage customers</p>
            <a href="customers/read.php"><button>View Customers</button></a>
        </div>

        <div class="card">
            <h2>📦 Rentals</h2>
            <p>Track rentals</p>
            <a href="#"><button>Coming Soon</button></a>
        </div>

        <div class="card">
            <h2>💳 Payments</h2>
            <p>Manage payments</p>
            <a href="#"><button>Coming Soon</button></a>
        </div>

    </div>

</div>

</body>
</html>