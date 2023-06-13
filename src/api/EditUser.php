<?php
use api\User;

require_once './User.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$user = new User();
$id_user = $entityBodyReg['id_user'];
$name = $entityBodyReg['name'];
$phone = $entityBodyReg['phone'];
$birthday = $entityBodyReg['birthday'];
$result = $user->EditUser($id_user,$name,$phone,$birthday);
echo json_encode($result);