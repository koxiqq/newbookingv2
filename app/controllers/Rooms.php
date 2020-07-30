<?php


namespace Controllers;

use Illuminate\Routing\Controller;
use  Models\Room;

class Rooms
{
    private static $fillable= array('hotel_Id', 'room_Name', 'room_Count', 'room_Cap', 'breakfast', 'price_Wo_Breakfast', 'price_W_Breakfast', 'room_Add_Info','room_Pic');

    public static  function  get_Assoc($params,$hotel_Id, $room_Name, $room_Count, $room_Cap, $breakfast, $price_Wo_Breakfast, $price_W_Breakfast, $room_Add_Info,$room_Pic){
        $assoc = array();
        foreach ($params as $param){
            $assoc[$param]=$$param;
        }
        return $assoc;
    }

    public static function create_room ($hotel_Id, $room_Name, $room_Count, $room_Cap, $breakfast, $price_Wo_Breakfast, $price_W_Breakfast, $room_Add_Info,$room_Pic) {
        $arr=self::get_Assoc(self::$fillable,$hotel_Id, $room_Name, $room_Count, $room_Cap, $breakfast, $price_Wo_Breakfast, $price_W_Breakfast, $room_Add_Info,$room_Pic);
        $room = Room::create($arr);
        return $room;
    }
    public static function show_rooms ($hotel_Id) {//выводит все комнаты , которые находятся в отеле с hotel_Id
        $rooms = Room::where('hotel_Id',$hotel_Id)->get();
        return $rooms;
    }
    public static  function  get_room($id,$check_In_Date=0,$eviction_Date=0){
        $room =Room::findOrFail($id);
        if($check_In_Date && $eviction_Date) $room['free_Count']=self::get_free_count($id,$check_In_Date,$eviction_Date);
        return $room;
    }
    public static function update($room_Id,$data){
        $room=Room::find($room_Id);
        foreach ($data as $pole=>$val ) {
            if($pole=='room_Id') continue;
            $room->$pole=$val;
        }
        return $room->save();
    }
    public static function delete($room_Id){
        return Room::destroy($room_Id);
    }
    private static function get_free_count($room_Id, $check_In_Date, $eviction_Date){
    return Room::findOrFail($room_Id)['room_Count']-Bookings::get_full_count($room_Id, $check_In_Date, $eviction_Date);
    }

}