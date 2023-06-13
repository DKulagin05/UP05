<?php

use api\User;

require_once './User.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$user = new User();
$name = $entityBodyReg['name'];
$phone = $entityBodyReg['phone'];
$category = $entityBodyReg['category'];
$password = $entityBodyReg['password'];
$birthday = $entityBodyReg['birthday'];
$admin = $entityBodyReg['admin'];
$result = $user->createUser($name,$phone,$category,$password,$birthday,$admin);
echo json_encode($result);