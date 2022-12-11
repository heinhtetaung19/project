<?php

include("vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\Auth;

$usersTable = new UsersTable(new MySQL);
// echo "<pre>";
// var_dump($table);

$users = $usersTable->getAll();
// echo "<pre>";
// var_dump($all); exit();
// echo "</pre> <br>";

$auth = Auth::check();
// echo "<pre>";
// print_r($auth); exit();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    
    <div class="container">

        <div style="float: right;">
            <a href="profile.php">Profile</a>
            <a href="_actions/logout.php">Logout</a>
        </div>

        <h1 class="h2 my-5">
            Manage Users 
            <span class="badge bg-danger">
                <?= count($users) ?>
            </span>
        </h1>

        <table class="table table-dark table-hover table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>

            <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->phone ?></td>
                    <td>
                       <?php if ($user->value === 1): ?>
                            <span class="badge bg-primary">
                                <?= "$user->role" ?>
                            </span>
                        <?php elseif ($user->value === 2): ?>
                            <span class="badge bg-success">
                                <?= $user->role ?>
                            </span>
                        <?php else: ?>
                            <span class="badge bg-danger">
                                <?= $user->role ?>
                            </span>
                        <?php endif ?>
                    </td>

                    <td>
                        <?php if ($auth->value > 1) : ?>
                            <div class=" btn-group dropdown">
                                <a href="#" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                                    Change Role
                                </a>

                                <div class=" dropdown-menu dropdown-menu-dark">
                                   <a href="_actions/role.php?id=<?= $user->id ?> &role=1" class="dropdown-item">User</a>
                                   <a href="_actions/role.php?id=<?= $user->id ?> &role=2" class="dropdown-item">Manager</a>
                                   <a href="_actions/role.php?id=<?= $user->id ?> &role=3" class="dropdown-item">Admin</a>
                                </div>

                                <?php if($user->suspended): ?>
                                    <a href="_actions/unsuspend.php?id=<?= $user->id ?>" class="btn btn-sm btn-danger">
                                    Suspended</a>
                                <?php else : ?>
                                    <a href="_actions/suspend.php?id=<?= $user->id ?>" class="btn btn-sm btn-outline-success">Active</a>
                                <?php endif ?>

                                <?php if ($user->id !== $auth->id): ?>
                                    <a href="_actions/delete.php?id=<?= $user->id ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                <?php endif ?>
                            </div>
                        <?php endif ?>
                        
                    </td>
                </tr>
            <?php endforeach ?>
        </table>

    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>