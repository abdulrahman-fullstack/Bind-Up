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

$conv = "";

if(DB::query("SELECT * FROM conversation WHERE user1=:logged_user OR user2=:logged_user ORDER BY id DESC" ,array(':logged_user'=>$logged_user['id'],':logged_user'=>$logged_user['id']))){

	$convs = DB::query("SELECT * FROM conversation WHERE user1=:logged_user OR user2=:logged_user ORDER BY id DESC" ,array(':logged_user'=>$logged_user['id'],':logged_user'=>$logged_user['id']));
}

?>

<html>
<head>
	<title>BindUp</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/chats.css">
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
			<div class="hubscc cont-changer cur">
				<span class="active"></span><a href="chats.php">Chats</a>
			</div>
			<div class="followscc cont-changer">
				<span></span><a href="followings.php">Followings</a>
			</div>
			<div class="followscc cont-changer">
				<span></span><a href="followers.php">Followers</a>
			</div>
			<div class="findppscc cont-changer">
				<span></span><a href="findpp.php">Find People</a>
			</div>
		</div>
	</div>
	
	<div class="global-cont">
		<div class="cont-block">
			<div class="content">
				<div class="msg-container">
					<div class="inm"></div>
					<div class="sending-area">
						<textarea cols="" rows="1" placeholder=" Write something to send"></textarea>
						<input type="button" id="send_msg" data-rid="<?php echo $logged_user['id'] ?>" value="Send" class="send">
					</div>
					<div class="msgs">

					</div>
				</div>
				<div class="conversation">
					<?php

					if($convs){

						foreach($convs as $conv){

							if($conv['user1'] != Login::isLoggedIn()['id'] ){
								$user = DB::query("SELECT * FROM users WHERE id=:user_id",array(':user_id'=>$conv['user1']))[0];
							} elseif($conv['user2']!= Login::isLoggedIn()['id'] ){
								$user = DB::query("SELECT * FROM users WHERE id=:user_id",array(':user_id'=>$conv['user2']))[0];
							}

							echo '<div class="conv" data-uid="'.$user['id'].'">
									<div>
										<img src="./images/'.$user['img'].'" alt="'.$user['fname'].'">
										<div class="user-name">'.$user['fname'].' '.$user['lname'].'</div>
									</div>
								</div>';
						}

					} else {

						echo '<div class="no-msg">Start New Conversation</div>';
					}

					?>

					<div class="new-conv"><div><span>+</span></div></div>
				</div>
			</div>
		</div>
	</div>
	
</div>
</body>
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


function exe(){

	var receiver = <?php echo Login::isLoggedIn()['id'] ?>,
		active ;

	$('.conv').on('click',function(){
		
		var msg_container = $('.msgs'),
			self = $(this);
			active = self;
			self.siblings().removeClass('active');
			self.addClass('active');

			$.ajax({
				url:'users/actions.php',
				method:'post',
				data:{message:'true',user:self.data('uid')},
				success:function(result){

					msg_container.html(result);
					msg_container.css('opacity', 1);
					receiver = null;
					receiver = self.data('uid');
				}
			});
			msg_container.css('opacity', 0.7);

	});

	$('#send_msg').on('click' , function(){

		var self = $(this);
		if(receiver != <?php echo $logged_user['id']; ?> ){

			$.ajax({
				url:'users/actions.php',
				method:'post',
				data:{sendmessage:'true',user:receiver,body:self.siblings('textarea').val()},
				success:function(result){

					self.siblings('textarea').val("");
					active.trigger('click');

				}
			});
		}

	});


}

$('.new-conv').on('click' , function(){

	$('.msgs').html("");

	$.ajax({
		url:'users/actions.php',
		method:'post',
		data:{newmessage:'true'},
		success:function(result){

			$('.conversation').html(result);
			$('.new-conv.back').on('click',function(){
				window.history.go();
			});
			exe();
		}
	});

});

window.onload= function(){
	exe();
}


})();




</script>
</html>