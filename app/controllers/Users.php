<?php

namespace Controllers;

use Illuminate\Routing\Controller;
use Models\User;

class Users {
    private static $fillable= array('name' , 'email', 'password', 'surname', 'phone_Number' , 'priv');

    public static  function  get_Assoc($params,$name , $email, $password, $surname, $phone_Number , $priv){
        $assoc = array();
        foreach ($params as $param){
            $assoc[$param]=$$param;
        }
        return $assoc;
    }
	public static function create_user ($name , $email, $password, $surname, $phone_Number , $priv) {
		$arr = Users::get_Assoc(users::$fillable,$name , $email, $password, $surname, $phone_Number , $priv);
		$user = User::create($arr);
		return $user;
	}
	public static function show_users () {
		$users = User::all();
		return $users;
	}
	public static  function  get_user($id){
	    return User::findOrFail($id);
    }
    public static function update($user_Id,$data){
        $user=User::find($user_Id);
        foreach ($data as $pole=>$val ) {
            if($pole=='user_Id') continue;
            $user->$pole=$val;
        }
        return $user->save();
    }
    public static function delete($user_Id){
	    return User::destroy($user_Id);
    }
}