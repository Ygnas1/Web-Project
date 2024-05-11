<?php
session_start();
require 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Checkina ar jau egzistuoja useris
    $checkUser = $conn->prepare("SELECT * FROM users WHERE user_name=?");
    $checkUser->bind_param("s", $username);
    $checkUser->execute();
    $checkUser->store_result();

    if ($checkUser->num_rows > 0) {
        $error = 'Username already exists!';
    } else {
        // Hashina passa pries metatnt i databasea
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Imeta nauja useri i databasea
        $sql = $conn->prepare("INSERT INTO users (user_name, password, role) VALUES (?,?,?)");
        $sql->bind_param("sss", $username, $hashed_password, $role);
        if ($sql->execute()) {
            header("location: login.php"); // Redirectina i login pagea
            exit;
        } else {
            $error = 'Failed to register user.';
        }

        $sql->close();
    }
    $checkUser->close();
    $conn->close();
}
//NUO CIA DESIGN(IRRELEVANT)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .input-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="password"], select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #5c67f2;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        .login-button:hover {
            background-color: #5058e2;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="signup.php" method="POST">
            <h2>Sign Up</h2>
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="viewer">Viewer</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="login-button">Sign Up</button>
        </form>
    </div>
</body>
</html>
