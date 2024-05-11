<?php
require 'auth.php'; // Ensure this file contains isAdmin() function
require 'init.php'; // Your database connection setup

$db = getDB();

// Fetch all products from the database
$stmt = $db->prepare("SELECT * FROM products ORDER BY prekes_id DESC");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <a href="logout.php">Logout</a>
    <title>Product Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f3;
            color: #333;
        }
        h1 {
            background-color: #4a69bd;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin: 0;
            font-size: 24px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #6a89cc;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #e2e2e2;
        }
        p {
            text-align: center;
            font-size: 16px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h1>Product Dashboard</h1>

    <!-- Check if there are products to display -->
    <?php if (empty($products)): ?>
        <p>No products found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Model</th>
                    <th>Manufacturer</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['prekes_id']) ?></td>
                    <td><?= htmlspecialchars($product['prekes_kategorija']) ?></td>
                    <td><?= htmlspecialchars($product['modelis']) ?></td>
                    <td><?= htmlspecialchars($product['gamintojas']) ?></td>
                    <td><?= htmlspecialchars($product['sandely']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
