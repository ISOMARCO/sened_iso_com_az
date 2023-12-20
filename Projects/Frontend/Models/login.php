<?php 
class loginM extends Model 
{
	public static function login($email,$pass)
	{
		return DB::where("user_email",$email)->where("user_pass",$pass)->users();
	}
}