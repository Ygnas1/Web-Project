<?php
require 'auth.php';
require 'init.php';

$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// Check if the person is not an admin
if ($role != "admin") {
    header("Location: user_dashboard.php");
    exit; // Ensure no further code is executed after redirection
}
$db = getDB();
$product = null;

// Check if the product ID is passed
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prekes_id'])) {
    $prekesId = $_POST['prekes_id'];

    // Fetch the product data from the database
    $stmt = $db->prepare("SELECT * FROM products WHERE prekes_id = :id");
    $stmt->execute([':id' => $prekesId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Handle the form submission for updating product details
    $prekesId = $_POST['prekes_id'];
    $kategorija = $_POST['prekes_kategorija'];
    $modelis = $_POST['modelis'];
    $gamintojas = $_POST['gamintojas'];
    $sandely = $_POST['sandely'];

    $stmt = $db->prepare("UPDATE products SET prekes_kategorija = :kategorija, modelis = :modelis, gamintojas = :gamintojas, sandely = :sandely WHERE prekes_id = :id");
    $stmt->execute([':kategorija' => $kategorija, ':modelis' => $modelis, ':gamintojas' => $gamintojas, ':sandely' => $sandely, ':id' => $prekesId]);

    header("Location: admin_dashboard.php"); // Redirect back to the products page
    exit();
}

// Check if product data is available for editing
if ($product === null) {
    echo "<p>Product not found or invalid product ID.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin: 15px 0 5px;
        }
        input[type="text"], input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4a69bd;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #6a89cc;
        }
    </style>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="post">
        <input type="hidden" name="prekes_id" value="<?= htmlspecialchars($product['prekes_id']) ?>">
        <label for="prekes_kategorija">Category:</label>
        <input type="text" id="prekes_kategorija" name="prekes_kategorija" value="<?= htmlspecialchars($product['prekes_kategorija']) ?>" required><br>
        <label for="modelis">Model:</label>
        <input type="text" id="modelis" name="modelis" value="<?= htmlspecialchars($product['modelis']) ?>" required><br>
        <label for="gamintojas">Manufacturer:</label>
        <input type="text" id="gamintojas" name="gamintojas" value="<?= htmlspecialchars($product['gamintojas']) ?>" required><br>
        <label for="sandely">Stock:</label>
        <input type="number" id="sandely" name="sandely" value="<?= htmlspecialchars($product['sandely']) ?>" required><br>
        <input type="submit" name="update" value="Update Product">
    </form>
</body>
</html>
