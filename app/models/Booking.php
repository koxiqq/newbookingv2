<?php


namespace Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \Models\Database;

class Booking extends Model
{
    protected $table = "bookings";
    protected $primaryKey ="booking_Id";
    protected $fillable = array( 'hotel_Id', 'room_Id','need_Breakfast','email','phone_Number','count_Of_Persons','names_Of_Persons', 'check_In_Date','check_In_Time','eviction_Date', 'price');
    public $timestamps = false;

}