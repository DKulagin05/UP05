<?php
use api\User;

require_once './User.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$user = new User();
$user_id = $entityBodyReg['id_user'];
$result = $user->GetUserTours($user_id);
header('Content-Type: application/json');
echo json_encode($result);
