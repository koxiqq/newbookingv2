<?php
namespace Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \Models\Database;

class Hotel extends Model
{
    protected $table = "hotels";
    protected $primaryKey ="hotel_Id";
    protected $fillable = array('hotel_Name', 'admin_Id', 'location', 'pictures_Folder', 'hotel_Info');
    public $timestamps = false;


    public function articles() {
        return $this->hasMany('\Models\Rooms');
    }
}