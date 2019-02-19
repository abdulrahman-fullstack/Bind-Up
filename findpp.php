<?php

if(!isset($_COOKIE['BUEM'])){
	 header('location:/');
} else{

	require 'classes/DB.php';
	require 'classes/Login.php';

	if(!DB::query("SELECT * FROM login_tokens WHERE token=:token",array(':token'=>sha1($_COOKIE['BUEM'])))){

		header('location:/');
	}
}

$logged_user = Login::isLoggedIn();

if(!$users = DB::query("SELECT users.img,users.id,users.fname,users.lname FROM users 
					WHERE users.id NOT IN (SELECT followers.user_id FROM users,followers 
					WHERE followers.follower_id=:logged_user )
					AND users.id!=:logged_user  ORDER BY id DESC LIMIT 30 ",array(':logged_user'=>$logged_user['id']))){

	$msg = "You are following everyone";

}

?>

<html>
<head>
	<title>BindUp</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/uh.css">
	<link rel="stylesheet" href="css/fpp.css">
	<!-- <link rel="stylesheet" href="css/font-awesome.css"> -->
	<link rel="stylesheet" href="fonts/montez.css">
	<link rel="stylesheet" href="css/helvatica.css">
</head>
<body>
<div class="wrap">
	<div class="hdr-wrap">
	<div class="header">

		<header><a href="/">BindUp</a></header>

		<!-- <input type="search-people" class="search" placeholder=" search people"> -->

		<ul class="nav">

			<li class="menu" > Menu
				<span class="menu-down">&#9660;</span>
			</li>
			

		</ul>

		<div class="sub-menu" >
			<ul class="hanging-sub-menu">
				<li><a href="profile.php" class="menu-it">Profile</a></li>
				<li><a href="logout.php" class="menu-it">Logout</a></li>
			</ul>
		</div>

	</div>
	</div>
	
	<div class="spo">
		<div class="side-pane">
			<div class="timelinecc cont-changer">
				<span></span><a href="userhome.php">Timeline</a>
			</div>
			<div class="hubscc cont-changer">
				<span></span><a href="chats.php">Chats</a>
			</div>
			<div class="followscc cont-changer">
				<span></span><a href="followings.php">Followings</a>
			</div>
			<div class="followscc cont-changer">
				<span></span><a href="followers.php">Followers</a>
			</div>
			<div class="findppscc cont-changer cur">
				<span class="active"></span><a href="findpp.php">Find People</a>
			</div>
		</div>
	</div>
	
	<div class="global-cont">
		<div class="cont-block">
			<div class="content">
				<div class="peoples">
					<?php

					if(isset($msg)){
						echo '<div class="msg clearfix" >'.$msg.'</div>';
					} else {

						foreach($users as $user){

							$follow = DB::query("SELECT * FROM followers 
									WHERE user_id=:user_id AND follower_id=:follower_id",
									array(':user_id'=>$user['id'],':follower_id'=>$logged_user['id'])) ? 'Unfollow' : 'Follow' ;

							echo '<div class="people">
									<div class="name">
									<img src="./images/'.$user[
										'img'].'" alt="'.$user['fname'].'">
										<a href="profile.php?id='.$user['id'].'">'.$user['fname'].' '.$user['lname'].'</a>
									</div>
									<div class="flw-cont">
										<input type="button" value="'.$follow.'" class="'.$follow.' follow-btn" data-uid="'.$user['id'].'">
									</div>
								</div>';
						}

					}

					?>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="js/jquery-3.2.1.js"></script>
<script>

( function () {

	var vis = true;

	$('li.menu').on('click' , function(e){

		var arrow = $('div.header > ul.nav > li.menu > span.menu-down'),
			hng_men = $('div.header > div.sub-menu');
			$(this).toggleClass('active');
			arrow_action(arrow);
			hanging_sub_menu_toggle(hng_men);
	});

	var zofmenu = $('div.header > div.sub-menu , div.header > ul.nav > li.menu ').css('z-index');

	$(window).on('mouseup',function(e){

		var tar = $(e.target),
			menu_div = $('div.header > div.sub-menu');

		if( ( tar.css('z-index') == 'auto' || tar.css('z-index') < zofmenu ) && !(tar.hasClass('menu-it')) ){

			var hng_men = $('div.header > div.sub-menu');

			if(hng_men.css('display') === 'block'){
				var arrow = $('div.header > ul.nav > li.menu > span.menu-down');

				hng_men.slideUp(150);
				arrow_action(arrow);
				$('li.menu').toggleClass('active');
			}
		}
	});

	function hanging_sub_menu_toggle(hng_men){

		hng_men.slideToggle(150);
	}

	function  arrow_action(arrow){
		if(!vis){
			arrow.addClass('arrow-down').removeClass('arrow-up');
			vis = true;
		}
		else{
			arrow.addClass('arrow-up').removeClass('arrow-down');
			vis = false;
		}
	}

})();

		
(function(){

	var follow = $('.follow-btn'), action;

	follow.on('click' , function(){
		action = $(this).val()=='Follow' ? 'follow' : 'unfollow' ;
		var self = $(this);
		// console.log(self.data('uid'));
		$.ajax({
			url:'users/actions.php',
			method:'post',
			data:{follow:action,user_id:self.data('uid'),follower_id:<?php echo Login::isLoggedIn()['id'] ?>},
			success:function(result){
				self.val(result);
				self.css('opacity', 1);
				self.hasClass('Unfollow') ? self.removeClass('Unfollow').addClass('Follow') : self.removeClass('Follow').addClass('Unfollow') ;
			}
		});
		self.css('opacity', 0.2);
	});

})();


</script>
</body>
</html>
