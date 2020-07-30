<?php
namespace Models;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \Models\Database;

class User extends Model {
    protected $table = "users";
    protected $primaryKey ="user_Id";
    protected $fillable = array('name' , 'email', 'password', 'surname', 'phone_Number' , 'priv');
    public $timestamps = false;


    public function articles() {
        return $this->hasMany('\Models\Hotels');
    }
}
 