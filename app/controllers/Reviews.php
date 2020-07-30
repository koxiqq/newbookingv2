<?php


namespace Controllers;

use Illuminate\Routing\Controller;
use Models\Review;

class Reviews
{

    private static $fillable= array('hotel_Id', 'name', 'review_Text', 'review_Grade' );

    public static  function  get_Assoc($params,$hotel_Id, $name, $review_Text, $review_Grade ){
        $assoc = array();
        foreach ($params as $param){
            $assoc[$param]=$$param;
        }
        return $assoc;
    }

    public static function create_review ($hotel_Id, $name, $review_Text, $review_Grade) {
        $arr=self::get_Assoc(self::$fillable,$hotel_Id, $name, $review_Text, $review_Grade);
        $review = Review::create($arr);
        return $review;
    }
    public static function show_review ($hotel_Id) {//выводит все отели которые принадлежат пользователю с user_Id
        $review = Review::where('hotel_Id',$hotel_Id)->get();
        return $review;
    }
    public static  function  get_review($id){
        return Review::findOrFail($id);
    }
    public static function update($review_Id, $data){
        $review=Review::find($review_Id);
        foreach ($data as $pole=>$val ) {
            if($pole=='review_Id') continue;
            $review->$pole=$val;
        }
        return $review->save();
    }
    public static function delete($review_Id){
        return Review::destroy($review_Id);
    }
}