<?php
require 'classes/DB.php';

if(isset($_POST['login'])){

	$email = $_POST['loginid'];
 	$pass = $_POST['password'];

	if($user = DB::query("SELECT * FROM users WHERE email=:email AND password=:pass",array(':email'=>$email,':pass'=>sha1($pass)))){

		echo '<script>alert("valid user")</script>';
		$cstrong = true;
		$token = bin2hex(openssl_random_pseudo_bytes(64,$cstrong));

		DB::query("INSERT INTO login_tokens VALUES(NULL,:token,:user_id)",array(':token'=>sha1($token),':user_id'=>$user[0]['id']));
		
		setcookie('BUEM' , $token , time()+3600 * 24 * 7 , '/' , NULL , NULL , true);

		header('location:userhome.php');

	} else {

		echo "<script>alert('User not found')</script>";
	}
}

?> 