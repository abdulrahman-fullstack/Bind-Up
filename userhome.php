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


?>

<html>
<head>
	<title>BindUp</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/uh.css">
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
			<div class="timelinecc cont-changer cur">
				<span class="active"></span><a href="userhome.php">Timeline</a>
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
			<div class="findppscc cont-changer">
				<span></span><a href="findpp.php">Find People</a>
			</div>
		</div>
	</div>
	
	<div class="global-cont">
		<div class="cont-block">
			<div class="content">
				
				<div class="post-block clearfix">
					<div class="post-area">
						<div class="ph pd"> &nbsp;Share your experience ...</div>
						<div class="pc pd" contenteditable></div>
						<textarea class="hidden" id="post_body" cols="0" rows="0"></textarea>
					</div>
					<div class="ps">
						<input type="button" id="pstbtn" name="post" value="Post">	
					</div>
				</div>
				<div class="posts-container">
					<?php 

						$logged_user = Login::isLoggedIn();
						$post = "";

						if($all_post = DB::query("SELECT posts.id ,posts.post_body,posts.posted_at,posts.user_id,posts.likes,users.img,users.fname,users.lname FROM posts , users , followers
							WHERE posts.user_id = followers.user_id
							AND users.id = posts.user_id
							AND follower_id = :logged_user_id
							ORDER BY posts.id DESC ",
							array(':logged_user_id'=>$logged_user['id']))){
							
							foreach($all_post as $post){

								// $date_str = (string)$post['posted_at'];
								$date = explode(' ' , $post['posted_at']);
								$time = explode(':' , $date[1]);
								$like = DB::query("SELECT * fROM post_likes WHERE post_id=:post_id AND liker_id=:liker_id",array(':post_id'=>$post['id'],':liker_id'=>$logged_user['id'])) ? 'Liked' : 'Like' ;
								$like_class = DB::query("SELECT * fROM post_likes WHERE post_id=:post_id AND liker_id=:liker_id",array(':post_id'=>$post['id'],':liker_id'=>$logged_user['id'])) ? 'lkd' : 'lk' ;
								
								echo "
								<div class='post clearfix'>
									<div class='user'>
										<div class='img'><img src='./images/".$post['img']."' alt='".$post['fname']."'></div>
										<h3><a href='profile.php?id=".$post['user_id']."' >".$post['fname']." ".$post['lname']."</a></h3>
										<div class='time'>posted at ".$time[0].":".$time[1]."&nbsp;&nbsp; on  ".$date[0]."</div>
									</div>
									<div class='cont'><pre>".htmlspecialchars($post['post_body'])."</pre></div>
									<div class='ops'>
										<input type='button' data-pid='".$post['id']."' value='$like' class='like-btn $like_class'>
										<span class='pl'>&nbsp;&nbsp; 
											<span class='lc'>".$post['likes']."</span> likes
										</span>
									</div>
								</div>
								";
							}
						}

					?>
				</div>
				<div class="notification clearfix">
					<div class="notify-list">
						<?php 

							if($notifies = DB::query("SELECT * FROM notifications WHERE receiver=:logged_user ORDER BY id DESC",array(':logged_user'=>$logged_user['id']))){

								foreach($notifies as $notify){

									$sender = $notify['sender'];
									$type = $notify['type'];

									$user = DB::query("SELECT * FROM users WHERE id=:user_id ",array(':user_id'=>$sender))[0];

									if($type == 1){

										echo '<div class="ntfs"><img class="pro-img" src="./images/'.$user['img'].'" alt="'.$user['fname'].'">
												<div class="not-msg">
												'.$user['fname'].' '.$user['lname'].' has liked your post
												</div>
											</div>';

									} elseif($type == 2){

										echo '<div class="ntfs"><img class="pro-img" src="./images/'.$user['img'].'" alt="'.$user['fname'].'">
												<div class="not-msg">
												'.$user['fname'].' '.$user['lname'].' is following you
												</div>
											</div>';

									}
								}

							} else {
								echo '<div class="msg"><h2>No Notifications Yet</h2></div>';
							}

							
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="js/jquery-3.2.1.js"></script>
<script>
( function () {
	
	// var wrap_height = window.innerHeight;
	
	// document.getElementsByClassName('wrap')[0].style.minHeight = wrap_height;

	window.onload = function(){
		$('.pc').trigger('focus');
	};

})();

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

( function () {
	var pc = document.getElementsByClassName('pc')[0],
		post_body = $('textarea#post_body').val();
	
	pc.onkeyup = function(){
		if(this.innerText !== ""){
			
			this.previousElementSibling.style.display = "none";
			post_body = this.innerText;
			console.log(post_body);
		}else{
			if(this.previousElementSibling.style.display == "none" ){
				this.previousElementSibling.style.display = "block";
			}
		}
	};
	var pc = $('.pc');
	$('#pstbtn').on('click', function(){
		if(post_body == ""){

			alert('This post appears to be blank... write something');
		}else{

			console.log('exe');
			$.ajax({
				url:'users/post.php',
				method:'post',
				data:{post:post_body},
				dataType:'text',
				success:function(result){
					// $('div.content').html(result);
					// window.history.go();
					console.log(result);
				}
			});
		}
	});

})();

( function () {
	
	var like = $('input.like-btn'), action,
		likes_count = like.siblings('.pl');

	like.on('click', function(){
		action = $(this).val()=='Like' ? 'true' : 'false' ;
		var self = $(this);
		$.ajax({
			url:'users/actions.php',
			method:'post',
			data:{like:action,post_id:self.data('pid'),liker_id:<?php echo Login::isLoggedIn()['id'] ?>},
			dataType:'json',
			success:function(result){
				self.val(result.txt).css('opacity' , 1);
				result.class == 'lkd' ? self.removeClass('lk').addClass(result.class) : self.removeClass('lkd').addClass(result.class);
				self.siblings('.pl').find('.lc').text(result.likes);
			}
		});
		self.css('opacity', 0.2);
	});

})();
</script>
</body>
</html>
