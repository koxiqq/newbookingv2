<?php


namespace Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \Models\Database;

class Review
{
    protected $table = "reviews";
    protected $primaryKey ="review_Id";
    protected $fillable = array('hotel_Id', 'name', 'review_Text', 'review_Grade' );
    public $timestamps = false;
}