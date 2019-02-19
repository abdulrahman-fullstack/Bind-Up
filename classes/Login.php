<?php 

class Login{
	public static function isLoggedIn(){
		if(isset($_COOKIE['BUEM'])){
			
			if($user_token = DB::query("SELECT * FROM login_tokens WHERE token=:token ",array(':token'=>sha1($_COOKIE['BUEM'])))){
				
				$user = DB::query("SELECT * FROM users WHERE id=:user_id ",array(':user_id'=>$user_token[0]['user_id']));
				
				return $user[0];
			}

			return false;
		}
	}
}

?>