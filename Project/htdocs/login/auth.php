<?php
require 'db.php';

function authenticate($user_name, $password) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM users WHERE user_name = :user_name");
    $stmt->execute([':user_name' => $user_name]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}

function isAdmin() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}

function isViewer() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'viewer';
}