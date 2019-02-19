<?php 

require '../classes/DB.php';
require '../classes/Login.php';
if(isset($_POST['post'])){

	if($user=Login::isLoggedIn()){

		$post_body = $_POST['post'];

		if(DB::query("INSERT INTO `posts` VALUES (NULL , ':post_body', NOW() , :user_id , 0)",array(':post_body'=>$post_body,':user_id'=>$user['id']))){

			echo "success";

		} else{

			echo $post_body;
		}
	}
}

?>