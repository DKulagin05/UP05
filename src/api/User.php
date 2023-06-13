<?php

namespace api;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once 'Database.php';

class User
{
    public function createUser($name,$phone,$category,$password,$birthday,$admin)
    {
        $conn = new Database();
        $query = "INSERT INTO Clients (client_name, client_phone, client_category_id, password, birthday, admin) VALUES ('$name', '$phone','$category', '$password', '$birthday', '$admin')";
        mysqli_query($conn->getConnection(), $query);
        return 'Успешная регистрация';
    }
    public function registration($name,$phone,$password,$birthday) {
        $validate = $this->RegValidate($name,$phone,$password,$birthday);
        if ($validate === true) {
            $conn = new Database();
            $query = "INSERT INTO Clients (client_name, client_phone, password, birthday) VALUES ('$name', '$phone', '$password', '$birthday')";
            mysqli_query($conn->getConnection(), $query);
            return 'Успешная регистрация';
        } else {
            return $validate;
        }
    }
    public function login($phone,$password) {
        $validate = $this->LogValidate($phone,$password);
        if ($validate === true) {
            $conn = new Database();
            $query = "SELECT * FROM Clients WHERE client_phone = '$phone' and password = '$password'";
            $result = mysqli_query($conn->getConnection(), $query);
            $data = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
                mysqli_close($conn->getConnection());
                return $data;
            } else {
                mysqli_close($conn->getConnection());
                return 'Пользователя с таким номером не существует';
            }
        } else {
            return $validate;
        }
    }

    public function EditCategory($id_user,$id_category) {
        $conn = new Database();
        $query = "UPDATE Clients SET client_category_id = $id_category WHERE client_id = $id_user;";
        $result = mysqli_query($conn->getConnection(), $query);
        return $query;
    }

    public function EditUser($id_user,$name,$phone,$birthday) {
        $conn = new Database();
        $query = "UPDATE Clients
                    SET client_name = '$name', client_phone = '$phone', birthday = '$birthday'
                    WHERE client_id = $id_user;";
        $result = mysqli_query($conn->getConnection(), $query);
        return 'Данные успешно изменены';
    }

    public function JoinTour($id_user, $id_tour, $end_date) {
        $conn = new Database();

        // Получаем информацию о клиенте
        $clientQuery = "SELECT client_category_id FROM Clients WHERE client_id = '$id_user'";
        $clientResult = mysqli_query($conn->getConnection(), $clientQuery);
        $clientData = mysqli_fetch_assoc($clientResult);
        $clientCategory = $clientData['client_category_id'];

        // Получаем информацию о туре
        $tourQuery = "SELECT price FROM Tours WHERE id = '$id_tour'";
        $tourResult = mysqli_query($conn->getConnection(), $tourQuery);
        $tourData = mysqli_fetch_assoc($tourResult);
        $tourPrice = $tourData['price'];

        // Применяем скидку в зависимости от категории клиента
        if ($clientCategory === '2') {
            // Применить скидку 10%
            $discountedPrice = $tourPrice - ($tourPrice * 0.1);
        } else if ($clientCategory === '3') {
            // Применить скидку 20%
            $discountedPrice = $tourPrice - ($tourPrice * 0.2);
        } else if ($clientCategory === '4') {
            // Применить скидку 30%
            $discountedPrice = $tourPrice - ($tourPrice * 0.3);
        } else {
            // Без скидки
            $discountedPrice = $tourPrice;
        }

        $query = "INSERT INTO UserTours (id_user, id_tour, end_date, total_price) VALUES ('$id_user', '$id_tour', '$end_date', '$discountedPrice')";
        $result = mysqli_query($conn->getConnection(), $query);

        return 'Вы успешно записались на тур';
    }

    public function GetUserTours($id_user) {
        $conn = new Database();
        $query = "SELECT id_tour, end_date, total_price FROM UserTours WHERE id_user = $id_user";
        $result = mysqli_query($conn->getConnection(), $query);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id_tour = $row['id_tour'];
                $query2 = "SELECT * FROM Tours WHERE id = $id_tour";
                $result2 = mysqli_query($conn->getConnection(), $query2);
                if (mysqli_num_rows($result2) > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        $row2['end_date'] = $row['end_date']; // Добавляем свойство 'end_date'
                        $row2['total_price'] = $row['total_price']; // Добавляем свойство 'end_date'
                        $data[] = $row2;
                    }
                }
            }
            mysqli_close($conn->getConnection());
        }
        return $data;
    }

    private function LogValidate($phone,$password) {
        if ($phone === null || $phone === '') {
            return 'Проблема с именем';
        } else if ($password === null || $password === '') {
            return 'Проблема с паролем';
        } else {
            return true;
        }
    }
    private function RegValidate($name,$phone,$password,$birthday) {
        if ($name === null || $name === '') {
            return 'Проблема с именем';
        } else if ($password === null || $password === '') {
            return 'Проблема с паролем';
        } else if ($birthday === null || $birthday === '') {
            return 'Проблема с датой';
        } else if ($phone === null || $phone === '') {
            return 'Проблема с телефоном';
        } else {
            $conn = new Database();
            // Проверяем, существует ли пользователь с таким же телефоном
            $query = "SELECT * FROM Clients WHERE client_phone = '$phone'";
            $result = mysqli_query($conn->getConnection(), $query);

            if (mysqli_num_rows($result) > 0) {
                return 'Пользователь с таким номером уже существует';
            } else {
                return true;
            }
        }
    }
}
