<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: sign_in.php');
    exit;
}

$user = $_SESSION['user'];

echo "Welcome, " . htmlspecialchars($user['username']) . "<br>";
echo "Your role is: " . htmlspecialchars($user['role']) . "<br>";
echo "Registered on: " . htmlspecialchars($user['date_reg']) . "<br>";
echo "ban status: " . htmlspecialchars($user['ban']) . "<br>";
echo "Registered on: " . htmlspecialchars($user['date_reg']) . "<br>";
