<?php 

session_start();

if(!isset($_SESSION['admin'])){

	header('location:/admin');
}

require '../classes/DB.php';

$status = "";
if($users = DB::query("SELECT * FROM users",array())){
	$status = 'Success';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Users lists</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/helvatica.css">
	<link rel="stylesheet" href="../fonts/montez.css">
	<style>
		*{margin:0; padding: 0; box-sizing: border-box;font-family: sans-serif;}
		div.header-logo{
		width:100%;
		height:60px;
		background: -webkit-linear-gradient(left, #1e3648 0%, #4980a7 100%);
		color:white;
		position:relative;
		}
		div.header-logo header{
		font-family:montez;
		font-size:30px;
		line-height: 30px;
		position:absolute;
		top:15px;
		left:40px;
		}
		body{width:100%;position: relative;}
		.wrap{width:100%;}
		.lo{position: absolute;top:25px;right:30px;transform: translateY(-35%);text-decoration:none;color:white;background-color:#254155;padding:7px;border-radius:3px;}
		.users{
			padding:20px;
		}
		.users .usr-list{
			background:rgba(0,0,0,0.05);
		}
		.title{width:100%;position: relative;background:#315671;color:white;font-size: 1.5em;border-radius:5px 5px 0 0 ; margin:10px 0 ;}
		.col{display: inline-block;width:20%;text-align:center;margin:10px 6.49%;}
		.name{text-align:left;}
		

	</style>
</head>
<body>
	<?php require_once '../hdlogo.php'; ?>
<div class="wrap">
	<a href="/admin/index.php?lo=true" class="lo">Logout</a>
	<div class="users">
		<div class="usr-list">
			<div class="title">
				<div class="col">NAME</div>
				<div class="col">CREATED ON</div>
				<div class="col">TOTAL POSTS</div>
			</div>
			<?php

			if(isset($status)){
				foreach ($users as $user) {
					$post = DB::query("SELECT * FROM posts WHERE user_id=:user_id",array(':user_id'=>$user['id']));
					$created_at = explode(' ', $user['created_at']);
					$date = $created_at[0];
					$time = $created_at[1];

					echo '<div class="col name">'.$user['fname'].' '.$user['lname'].'</div>
					<div class="col">'.$date.' at '.$time.'</div>
					<div class="col">'.count($post).'</div>';

				}
			}

			?>
		</div>
	</div>
</div>
</body>
</html>