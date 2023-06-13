<?php

use api\User;

require_once './User.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$user = new User();
$phone = $entityBodyReg['phone'];
$password = $entityBodyReg['password'];
$result = $user->login($phone,$password);
echo json_encode($result);