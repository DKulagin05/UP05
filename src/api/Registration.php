<?php

use api\User;

require_once './User.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$user = new User();
$name = $entityBodyReg['username'];
$password = $entityBodyReg['password'];
$birthday = $entityBodyReg['birthdate'];
$phone = $entityBodyReg['phone'];
$result = $user->registration($name,$phone,$password,$birthday);
echo json_encode($result);