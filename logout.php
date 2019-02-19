<?php
	
if(isset($_COOKIE['BUEM'])){
	
	require 'classes/DB.php';

	setcookie('BUEM' , 0 , time()-3600 , '/' , NULL , NULL , TRUE);
	DB::query("DELETE FROM login_tokens WHERE token=':token'",array(':token'=>sha1($_COOKIE['BUEM'])));
	header('location:/');
}

?>