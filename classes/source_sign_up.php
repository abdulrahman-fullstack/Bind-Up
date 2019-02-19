<?php

require 'classes/DB.php';

if(isset($_POST['submit'])){
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$dob = "{$year}-{$month}-{$day}";
	$dob = date("Y-m-d" , strtotime($dob));
	$gender = $_POST['gender'];
	$ph_num = $_POST['ph_num'];
	$email = $_POST['email'];
	$pass = $_POST['password'];

	if(!DB::query("SELECT * FROM users WHERE email=:email ",array(':email'=>$email))){

		DB::query("INSERT INTO `users` VALUES (NULL,:fname,:lname,:dob,:gender,:ph_num,:email,:pass,'default.png',NOW())",array(':fname'=>$fname,':lname'=>$lname,':dob'=>$dob,':gender'=>$gender,':ph_num'=>$ph_num,':email'=>$email,':pass'=>sha1($pass)));

		$user_id = DB::query("SELECT id FROM users WHERE email=:email ",array(':email'=>$email))[0]['id'];
		$cstrong = true;
		$token = bin2hex(openssl_random_pseudo_bytes(64,$cstrong));

		DB::query("INSERT INTO login_tokens VALUES(NULL,:token,:user_id)",array(':token'=>sha1($token),':user_id'=>$user_id));
		setcookie('BUEM' , $token , time()+3600 * 24 * 7 , '/' , NULL , NULL , true);

		header('location:userhome.php');
		
	} else{
		echo "<script>alert('Email already exist try another')</script>";
	}
}

?>
