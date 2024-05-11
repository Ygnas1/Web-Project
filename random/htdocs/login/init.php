<?php
session_start();

// Setup a PDO connection (this example assumes you are using MySQL)
$db = new PDO("mysql:host=localhost;dbname=login_sample_db", "user_name", "password");

function getdb() {
    global $db;
    return $db;
}

function deleteProduct($prekes_id) {
    $db = getDB();
    try {
        $stmt = $db->prepare("DELETE FROM products WHERE prekes_id = :id");
        $stmt->bindParam(':id', $prekes_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "Product deleted successfully.";
        } else {
            return "Product not found or already deleted.";
        }
    } catch (PDOException $e) {
        return "Error deleting product: " . $e->getMessage();
    }
}