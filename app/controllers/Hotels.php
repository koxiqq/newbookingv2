<?php


namespace Controllers;

use Illuminate\Routing\Controller;
use Models\hotel;

class Hotels
{
    private static $fillable= array('hotel_Name', 'admin_Id', 'location', 'pictures_Folder', 'hotel_Info');

    public static  function  get_Assoc($params,$hotel_Name, $admin_Id, $location, $pictures_Folder, $hotel_Info){
        $assoc = array();
        foreach ($params as $param){
            $assoc[$param]=$$param;
        }
        return $assoc;
    }

    public static function create_hotel ($hotel_Name, $admin_Id, $location, $pictures_Folder, $hotel_Info) {
    $arr=self::get_Assoc(self::$fillable,$hotel_Name, $admin_Id, $location, $pictures_Folder, $hotel_Info);
    $hotel = Hotel::create($arr);
    return $hotel;
}
    public static function show_hotels ($user_Id) {//выводит все отели которые принадлежат пользователю с user_Id
        $hotels = Hotel::where('admin_Id',$user_Id)->get();
        return $hotels;
    }
    public static  function  get_hotel($id){
        return Hotel::findOrFail($id);
    }
    public static function update($hotel_Id,$data){
        $hotel=Hotel::find($hotel_Id);
        foreach ($data as $pole=>$val ) {
            if($pole=='hotel_Id') continue;
            $hotel->$pole=$val;
        }
        return $hotel->save();
    }
    public static function delete($hotel_Id){
        return Hotel::destroy($hotel_Id);
    }

}