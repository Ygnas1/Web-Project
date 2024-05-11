<?php
require 'auth.php'; 
require 'init.php'; 

$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;


if ($role != "admin") {
    header("Location: user_dashboard.php");
    exit; 
}
$db = getDB();

// Fetchina is dabataseo prekes ir atributes
$stmt = $db->prepare("SELECT * FROM products ORDER BY prekes_id DESC");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <a href="logout.php">Logout</a>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        .button {
            padding: 8px 16px;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .edit-btn {
            background-color: #f39c12;
        }
        .delete-btn {
            background-color: #e74c3c;
        }
        .delete-btn:hover, .edit-btn:hover {
            opacity: 0.9;
        }
        p {
            text-align: center;
            font-size: 16px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <a href="add_product.php" class="button edit-btn">Add New Product</a>

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
                    <th>Edit</th>
                    <th>Delete</th>
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
                    <td>
                        <form action="edit_product.php" method="post">
                            <input type="hidden" name="prekes_id" value="<?= $product['prekes_id'] ?>">
                            <button type="submit" class="button edit-btn">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form action="delete_product.php" method="post">
                            <input type="hidden" name="prekes_id" value="<?= $product['prekes_id'] ?>">
                            <button type="submit" class="button delete-btn" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
