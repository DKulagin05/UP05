<?php

use api\User;

require_once './User.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$user = new User();
$id_user = $entityBodyReg['id_user'];
$id_tour = $entityBodyReg['id_tour'];
$date = new DateTime(); // Создание объекта DateTime с текущей датой и временем
$date->modify('+5 days'); // Добавление 5 дней к дате
$newDate = $date->format('Y-m-d'); // Форматирование даты в нужный формат (например, 'Y-m-d')

$result = $user->JoinTour($id_user,$id_tour,$newDate);

echo json_encode($result);