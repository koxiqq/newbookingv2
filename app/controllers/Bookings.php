<?php


namespace Controllers;

use Illuminate\Routing\Controller;
use Models\Booking;

class Bookings
{
    private static $fillable = array('hotel_Id', 'room_Id', 'need_Breakfast', 'email', 'phone_Number', 'count_Of_Persons', 'names_Of_Persons', 'check_In_Date', 'check_In_Time', 'eviction_Date', 'price');

    private static function get_Assoc($params, $hotel_Id, $room_Id, $need_Breakfast, $email, $phone_Number, $count_Of_Persons, $names_Of_Persons, $check_In_Date, $check_In_Time, $eviction_Date, $price = 0)
    {
        $assoc = array();
        foreach ($params as $param) {
            $assoc[$param] = $$param;
        }
        return $assoc;
    }

    public static function create_booking($hotel_Id, $room_Id, $need_Breakfast, $email, $phone_Number, $count_Of_Persons, $names_Of_Persons, $check_In_Date, $check_In_Time, $eviction_Date, $price = 0)
    {
        $arr = self::get_Assoc(self::$fillable, $hotel_Id, $room_Id, $need_Breakfast, $email, $phone_Number, $count_Of_Persons, $names_Of_Persons, $check_In_Date, $check_In_Time, $eviction_Date, $price);
        if (!$arr['price']) {
            $arr['price'] = ($arr['need_Breakfast'] ? rooms::get_room($arr['room_Id'])['price_W_Breakfast'] : rooms::get_room($arr['room_Id'])['price_Wo_Breakfast']) *
                intval(self::get_duration($check_In_Date, $eviction_Date));
        }
        $booking = Booking::create($arr);
        return $booking;
    }

    public static function show_bookings($hotel_Id)
    {//выводит все комнаты , которые находятся в отеле с hotel_Id
        $bookings = Booking::where('hotel_Id', $hotel_Id)->get();
        return $bookings;
    }

    public static function get_booking($id)
    {
        $booking = Booking::findOrFail($id);
        return $booking;
    }

    public static function update($booking_Id, $data)
    {
        $booking = Booking::find($booking_Id);
        foreach ($data as $pole => $val) {
            if ($pole == 'booking_Id') continue;
            $booking->$pole = $val;
        }
        return $booking->save();
    }

    public static function delete($booking_Id)
    {
        return Booking::destroy($booking_Id);
    }

    public static function get_full_count($room_Id, $check_In_Date, $eviction_Date)
    {
        return Booking::where([['room_Id', '=', $room_Id],
            ['check_In_Date', '<=', $eviction_Date],
            ['eviction_Date', '>=', $check_In_Date]])->count();
    }

    private static function get_duration($date_from, $date_till)
    {
        $date_from = explode('-', $date_from);
        $date_till = explode('-', $date_till);

        $time_from = mktime(0, 0, 0, $date_from[1], $date_from[2], $date_from[0]);
        $time_till = mktime(0, 0, 0, $date_till[1], $date_till[2], $date_till[0]);

        $diff = ($time_till - $time_from) / 60 / 60 / 24;
        return $diff;
    }
}