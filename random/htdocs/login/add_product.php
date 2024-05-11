<?php
require 'auth.php';
require 'init.php';

$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// Check if the person is not an admin
if ($role != "admin") {
    header("Location: user_dashboard.php");
    exit; // Ensure no further code is executed after redirection
}
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = getDB();
    $kategorija = $_POST['prekes_kategorija'];
    $modelis = $_POST['modelis'];
    $gamintojas = $_POST['gamintojas'];
    $sandely = $_POST['sandely'];

    $stmt = $db->prepare("INSERT INTO products (prekes_kategorija, modelis, gamintojas, sandely) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$kategorija, $modelis, $gamintojas, $sandely])) {
        $message = "New product added successfully!";
    } else {
        $message = "Failed to add product.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f3;
            color: #333;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #4a69bd;
        }
        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4a69bd;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #6a89cc;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
        p {
            text-align: center;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Add New Product</h1>
    <p><?= $message ?></p>
    <form action="add_product.php" method="post">
        <input type="text" name="prekes_kategorija" placeholder="Category" required>
        <input type="text" name="modelis" placeholder="Model" required>
        <input type="text" name="gamintojas" placeholder="Manufacturer" required>
        <input type="number" name="sandely" placeholder="Stock" required>
        <button type="submit">Add Product</button>
    </form>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
