<?php
session_start();

require_once "../classes/db.php";
require_once "../classes/user.php";

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new db();
    $pdo = $db->connect();
    $user = new User($pdo);

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $role = $_POST['role'];

    $_SESSION['fullname'] = $fullname;
    $_SESSION['email'] = $email;

    $error = $user->register($fullname, $email, $pwd, $role);

    if (empty($error)) {
        header('Location: ../pages/sign_in.php');
        exit;
    } else {
        $_SESSION['error'] = $error;
        header('Location: ../pages/register.php');
        exit;
    }
}

?>
