<?php

session_start();

if(isset($_GET['lo'])){
	if($_GET['lo'] == 'true'){
		session_destroy();
	}
}
if(isset($_SESSION['admin'])){
	header('location:users_list.php');
}

require '../classes/DB.php';

if(isset($_POST['login'])){

	$username = sha1($_POST['username']);
	$password = sha1($_POST['password']);

	if(DB::query("SELECT * FROM admin WHERE username=:username AND password=:password",array(':username'=>$username,':password'=>$password))){

		$_SESSION['admin'] = md5($username);
		header('location:users_list.php');

	}else{
		die('invalid username or password');
	}

}

?>
<html>
<head>
	<title>SM-ADMIN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/helvatica.css">
	<link rel="stylesheet" href="../fonts/montez.css">
	<style>
		*{margin:0; padding: 0; box-sizing: border-box;}
		div.header-logo{
		width:100%;
		height:80px;
		background: -webkit-linear-gradient(left, #1e3648 0%, #4980a7 100%);
		color:white;
		position:relative;
		}
		div.header-logo header{
		font-family:montez;
		font-size:50px;
		line-height: 50px;
		position:absolute;
		top:15px;
		left:40px;
		}
		.clearfix{
			box-shadow:0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
		}
		.login{
			width:400px;
			position: absolute;
			top:45%;
			left:50%;
			transform: translate(-50%,-50%);
			background:rgba(0,0,0,0.08);
			padding:20px 10px;
			border-radius:5px;
		}
		.login .frm{
			position: relative;
		}
		.login .frm form div{
			width:100%;
		}
		.login .frm form input{
			width:350px;
			font-size:1.2em;
			padding:10px;
			display: block;
			border: none;
			border-radius:3px;
			margin:20px auto;
			box-shadow:0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
		}
		.login .frm form input[type=submit]{
			background:#345c78;
			color:white;
		}


	</style>
</head>

<body>
	<?php require_once '../hdlogo.php'; ?>
	
	<div class="login clearfix">
		<div class="frm">
			<form action="index.php" method="post">
				<div><input type="text" placeholder=" Username" name="username"></div>
				<div><input type="password" placeholder=" Password" name="password"></div>
				<div><input type="submit" name="login" value="Login"></div>
			</form>
		</div>
	</div>

</body>
</html>