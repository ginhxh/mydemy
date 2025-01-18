<?php
session_start();
require_once "../classes/db.php";
require_once "../classes/user.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new db();
    $pdo = $db->connect();
    $user = new User($pdo);

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $error = $user->sign_in($email, $pwd);

    if ($error === true) {
        $user = $_SESSION['user'];
      
if($user['role']==='admin'){   header('Location: ../pages/dash.php');
    exit;}
    else if($user['role']==='student'){   header('Location: ../pages/std.php');
        exit;}
        else if($user['role']==='teacher'){   header('Location: ../tech/dash.php');
            exit;} 


     
    } else {
        $_SESSION['error'] = $error;
        header('Location: ../pages/sign_in.php');
        exit;
    }
}
