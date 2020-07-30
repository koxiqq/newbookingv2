<?php

require "config.php";
require "vendor/autoload.php";
use Illuminate\Support\Facades\DB;
use Models\Database;
use Controllers\Hotels;
use Controllers\Reviews;
use Controllers\Users;
use Controllers\Rooms;
use Controllers\Bookings;

header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

$dt = new Database();
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
$method = $_SERVER['REQUEST_METHOD'];
$f = fopen('php://input', 'r');
$data = json_decode(stream_get_contents($f));
$tab_Name=strtolower(explode("?",$requestUri[1])[0]);
$id=$requestUri[2];
$data=get_data_from_json($data);
switch ($tab_Name){
    case 'users':
        switch ($method){
            case 'GET':
                echo json_encode($id?Users::get_user($id):Users::show_users());
                break;
            case 'POST':
                echo json_encode(Users::create_user($data['name'],$data['email'],$data['password'],$data['surname'],$data['phone_Number'],$data['priv']));
                break;
            case'PUT':
                echo json_encode(Users::update($id,$data));
                break;
            case'DELETE':
                echo json_encode(Users::delete($id));
        }
        break;
    case 'bookings':
        switch ($method){
            case 'GET':
                echo json_encode($id?Bookings::get_booking($id):Bookings::show_bookings($data['hotel_Id']));
                break;
            case 'POST':
                echo json_encode(Bookings::create_booking($data['hotel_Id'], $data['room_Id'], $data['need_Breakfast'], $data['email'], $data['phone_Number'], $data['count_Of_Persons'],$data['names_Of_Persons'], $data['check_In_Date'],$data['check_In_Time'],$data['eviction_Date'], $data['price']));
                break;
            case'PUT':
                echo json_encode(Bookings::update($id,$data));
                break;
            case'DELETE':
                echo json_encode(Bookings::delete($id));
        }
        break;
    case 'hotels':
        switch ($method){
            case 'GET':
                echo json_encode($id?Hotels::get_hotel($id):Hotels::show_hotels($data['user_Id']));
                break;
            case 'POST':
                echo json_encode(Hotels::create_hotel( $data['hotel_Name'],$data['user_Id'],$data['location'],$data['hotel_Name'],$data['hotel_Info']));
                break;
            case'PUT':
                echo json_encode(Hotels::update($id,$data));
                break;
            case'DELETE':
                echo json_encode(Hotels::delete($id));
        }
        break;
    case 'reviews':
        switch ($method){
            case 'GET':
                echo json_encode($id?Reviews::get_review($id):Reviews::show_review($data['hotel_Id']));
                break;
            case 'POST':
                echo json_encode(Reviews::create_review($data['hotel_Id'],$data['name'],$data['review_Text'],$data['review_Grade']));
                break;
            case'PUT':
                echo json_encode(Reviews::update($id,$data));
                break;
            case'DELETE':
                echo json_encode(Reviews::delete($id));
        }
        break;
    case 'rooms':
        switch ($method){
            case 'GET':
                echo json_encode($id?Rooms::get_room($id,$data['check_In_Date'],$data['eviction_Date']):Rooms::show_rooms($data['hotel_Id']));
                break;
            case 'POST':
                echo json_encode(Rooms::create_room($data['hotel_Id'], $data['room_Name'], $data['room_Count'],$data[ 'room_Cap'],$data[ 'breakfast'], $data['price_Wo_Breakfast'], $data['price_W_Breakfast'], $data['room_Add_Info'],$data['room_Pic']));
                break;
            case'PUT':
                echo json_encode(Rooms::update($id,$data));
                break;
            case'DELETE':
                echo json_encode(Rooms::delete($id));
        }
        break;
    default:
        echo     json_encode("table not found");
}

function get_data_from_json($json_data){
    $data= array();
    if($json_data) {
        foreach ($json_data as $key => $value) {
            $data[$key] = $value;
        }
        return $data;
    }
}