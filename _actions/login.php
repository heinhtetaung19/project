<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

$table = new UsersTable(new MySQL);

$email = $_POST['email'];
$password = md5($_POST['password']);

$user = $table->findByEmailAndPassword($email, $password);

// echo '<pre>';
// print_r($user); exit();
// echo '</pre>';

if ($user) {
    session_start();
    $_SESSION['user'] = $user;
    HTTP::redirect('/profile.php');
} else {
    HTTP::redirect("/index.php", "incorrect=login");

}


