<html>

<a href="admin_dashboard.php" class="button">Go to Dashboard</a>

	<style>
		.button {
			display: inline-block;
			padding: 10px 15px;
			margin: 5px;
			background-color: #007BFF; /* Bootstrap primary blue */
			color: white;
			text-decoration: none; /* Removes underline */
			border-radius: 5px; /* Rounded corners */
			text-align: center;
		}
	
		.button:hover {
			background-color: #0056b3; /* Darker blue on hover */
		}
	</style>

<?php


require 'init.php'; 
// init.php yra deleto funkcija tai isimetam ja i delete_product.php file
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// Checkina ar adminas
if ($role != "admin") {
    header("Location: user_dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prekes_id'])) {
    $prekes_id = $_POST['prekes_id'];
    $result = deleteProduct($prekes_id);
    echo $result;

} else {
    echo "Invalid request.";
}

