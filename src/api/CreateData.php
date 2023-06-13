<?php

namespace api;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once 'Database.php';

class Create
{
    public function createHotel($name, $description, $img, $location, $rating)
    {
        $conn = new Database();
        $query = "INSERT INTO Hotels (name, description, img, location, rating) VALUES ('$name', '$description', '$img','$location', '$rating')";
        mysqli_query($conn->getConnection(), $query);
        return $query;
    }

    public function createLocation($name) {
        $conn = new Database();
        $query = "INSERT INTO Locations (position) VALUES ('$name')";
        mysqli_query($conn->getConnection(), $query);
        return 'Адрес создан успешно';
    }

    public function createPromotion($discount_type, $discount_title, $discount_description, $discount_value, $end_date, $direction, $client_category) {
        $conn = new Database();
        if ($end_date !== '') {
            $query = "INSERT INTO Discounts (discount_type, discount_title, discount_description, discount_value, end_date, direction, client_category) 
                                                                 VALUES ('$discount_type', 
                                                                 '$discount_title', '$discount_description', '$discount_value', 
                                                                 '$end_date', '$direction', '$client_category')";
        } else {
            $query = "INSERT INTO Discounts (discount_type, discount_title, discount_description, discount_value, direction, client_category) 
                                                                 VALUES ('$discount_type', 
                                                                 '$discount_title', '$discount_description', '$discount_value', 
                                                                 '$direction', '$client_category')";
        }
        mysqli_query($conn->getConnection(), $query);
        return 'Отель создан успешно';
    }

    public function createService($title,$description,$price) {
        $conn = new Database();
        $query = "INSERT INTO Services (title, description, price) 
                    VALUES ('$title','$description','$price')";
        mysqli_query($conn->getConnection(), $query);
        return $query;
    }

    public function createTour($title,$description,$img,$departure,$destination,$date,$duration,$price,$hotel_id) {
        $conn = new Database();
        $query = "INSERT INTO Tours (title, description, img, departure, destination, date, duration, price, hotel_id) 
                    VALUES ('$title','$description','$img','$departure','$destination','$date','$duration','$price','$hotel_id')";
        mysqli_query($conn->getConnection(), $query);
        return 'Тур создан';
    }

    public function createReview($id_user,$user_name,$title,$description,$rating) {
        $conn = new Database();
        $query = "INSERT INTO Reviews (id_user, user_name, title, description, date, score)
        VALUES ('$id_user', '$user_name', '$title', '$description', NOW(), '$rating')";
        mysqli_query($conn->getConnection(), $query);

        return 'Отзыв оставлен';

    }
}
