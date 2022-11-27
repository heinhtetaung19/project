<?php

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

if ($email === "hha19@gmail.com" and $password === "hha") {
    $_SESSION['user'] = ['username' => 'Michael'];
    header('location: ../profile.php');
} else {
    header('location: ../index.php?incorrect=1');
}