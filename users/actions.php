<?php 
require '../classes/DB.php';
require '../classes/Login.php';
require '../classes/Notify.php';

if(isset($_POST['follow'])){
	if($_POST['follow'] == 'follow'){
		if(!DB::query("SELECT * FROM followers WHERE user_id=:user_id AND follower_id=:follower_id",array(':user_id'=>$_POST['user_id'],':follower_id'=>$_POST['follower_id']))){
		
			DB::query("INSERT INTO followers VALUES (NULL, :user_id , :follower_id) ",array(':user_id'=>$_POST['user_id'],':follower_id'=>$_POST['follower_id']));
			
			Notify::followNotify($_POST['user_id'],$_POST['follower_id']);

			echo "Unfollow";
		}
	} else {
		if(DB::query("SELECT * FROM followers WHERE user_id=:user_id AND follower_id=:follower_id",array(':user_id'=>$_POST['user_id'],':follower_id'=>$_POST['follower_id']))){

			DB::query("DELETE FROM followers WHERE user_id=:user_id AND follower_id=:follower_id" , array(':user_id'=>$_POST['user_id'],':follower_id'=>$_POST['follower_id']));
			echo "Follow";
		}
	}
}

if(isset($_POST['like'])){

	if($_POST['like'] == 'true'){

		if(!DB::query("SELECT * FROM post_likes WHERE post_id=:post_id AND liker_id=:liker_id",array(':post_id'=>$_POST['post_id'],':liker_id'=>$_POST['liker_id']))){

			DB::query("INSERT INTO post_likes VALUES(NULL , :post_id , :liker_id) ",array(':post_id'=>$_POST['post_id'],':liker_id'=>$_POST['liker_id']));

			DB::query("UPDATE posts SET likes=likes+1 WHERE id=:post_id ",array(':post_id'=>$_POST['post_id']));

			Notify::likeNotify($_POST['post_id']);

			$json =array("txt"=>"Liked","likes"=>DB::query("SELECT * FROM posts WHERE id=:post_id",array(":post_id"=>$_POST["post_id"]))[0]["likes"],"class"=>"lkd");
			echo json_encode($json);
		}
	} else{
		
		if(DB::query("SELECT * FROM post_likes WHERE post_id=:post_id AND liker_id=:liker_id",array(':post_id'=>$_POST['post_id'],':liker_id'=>$_POST['liker_id']))){
			
			DB::query("DELETE FROM post_likes WHERE post_id=:post_id AND liker_id=:liker_id",array(':post_id'=>$_POST['post_id'],':liker_id'=>$_POST['liker_id']));

			DB::query("UPDATE posts SET likes=likes-1 WHERE id=:post_id ",array(':post_id'=>$_POST['post_id']));


			$json =array("txt"=>"Like","likes"=>DB::query("SELECT * FROM posts WHERE id=:post_id",array(":post_id"=>$_POST["post_id"]))[0]["likes"],"class"=>"lk");
			echo json_encode($json);
		}
	}

}

if(isset($_POST['message'])){

	if(!DB::query("SELECT * FROM conversation WHERE user1=:user OR user2=:user ",array(':user'=>Login::isLoggedIn()['id']))){

		DB::query("INSERT INTO conversation VALUES (NULL,:logged_user , :user) ",array(':logged_user'=>Login::isLoggedIn()['id'] , ':user'=>$_POST['user']));
	}

	$messages = DB::query("SELECT * FROM messages WHERE (sender=:logged_user AND receiver=:user) OR (sender=:user AND receiver=:logged_user )   ORDER BY id ASC",array(':logged_user'=>Login::isLoggedIn()['id'],':user'=>$_POST['user'],':logged_user'=>Login::isLoggedIn()['id'],':user'=>$_POST['user']));

	if($messages){

		$output = "";
		foreach($messages as $message){

			if($message['sender'] == Login::isLoggedIn()['id']){

				$output .= '<div class="msg logusr" data-sid="'.$message['sender'].'">
								<span>'.$message['body'].'</span>
							</div>';
			} else {

				$output .= '<div class="msg usr" data-sid="'.$message['sender'].'">
								<span>'.$message['body'].'</span>
							</div>';
			}
		}
			echo $output;

	}else{

		echo '<div class="nmf">Start Messaging</div>';
	}
}

if(isset($_POST['sendmessage'])){

	if($_POST['body'] != ""){

		$receiver = $_POST['user'];

		if(!DB::query("SELECT * FROM `conversation` WHERE (user1=:logged_user AND user2=:user) OR (user1=:user AND user2=:logged_user)",array(':logged_user'=>Login::isLoggedIn()['id'],':user'=>$_POST['user']))){

			DB::query("INSERT INTO conversation VALUES (NULL, :logged_user , :user)",array(':logged_user'=>Login::isLoggedIn()['id'],':user'=>$_POST['user']));
		}

		if(DB::query("INSERT INTO messages VALUES (NULL , :body , :sender , :receiver , 0) ",array(':body'=>$_POST['body'],':sender'=>Login::isLoggedIn()['id'],':receiver'=>$_POST['user']))){

			echo "<script>console.log(".$_POST['user'].")</script>";
		}else{
			echo 'Failed';
		}

	}

}

if(isset($_POST['newmessage'])){

	$news = DB::query("SELECT followers.user_id FROM `followers` WHERE followers.follower_id=:logged_user AND followers.user_id NOT IN (SELECT user1 FROM conversation WHERE user1=:logged_user OR user2=:logged_user ) AND followers.user_id NOT IN (SELECT user2 FROM conversation WHERE user1=:logged_user OR user2=:logged_user )",array(':logged_user'=>Login::isLoggedIn()['id']));

	foreach($news as $new){

		$user = DB::query("SELECT * FROM users WHERE id=:user_id",array(':user_id'=>$new['user_id']))[0];

		echo '<div class="conv" data-uid="'.$user['id'].'">
				<div>
					<img src="./images/'.$user['img'].'" alt="'.$user['fname'].'">
					<div class="user-name">'.$user['fname'].' '.$user['lname'].'</div>
				</div>
			</div>';

	}

	echo "<div class='new-conv back'><div><span>&#10094</span></div></div>";

}

?>