<html>

<a href="admin_dashboard.php" class="button">Go to Dashboard</a>

	<!-- Some basic CSS to make the anchor look like a button -->
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


require 'init.php'; // Assuming the deleteProduct function is in this file

$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// Check if the person is not an admin
if ($role != "admin") {
    header("Location: user_dashboard.php");
    exit; // Ensure no further code is executed after redirection
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prekes_id'])) {
    $prekes_id = $_POST['prekes_id'];
    $result = deleteProduct($prekes_id);
    echo $result;

} else {
    echo "Invalid request.";
}

