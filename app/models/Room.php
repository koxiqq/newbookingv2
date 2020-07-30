<?php


namespace Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \Models\Database;

class Room extends Model
{
    protected $table = "rooms";
    protected $primaryKey ="room_Id";
    protected $fillable = array('hotel_Id', 'room_Name', 'room_Count', 'room_Cap', 'breakfast', 'price_Wo_Breakfast', 'price_W_Breakfast', 'room_Add_Info','room_Pic');
    public $timestamps = false;
}