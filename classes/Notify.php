<?php 

class Notify{

	public static function likeNotify($post_id){

		$temp = DB::query("SELECT post_likes.id , posts.user_id AS receiver , post_likes.liker_id AS sender FROM posts,post_likes WHERE posts.id = post_likes.post_id AND posts.id=:post_id ORDER BY post_likes.id DESC ",array(':post_id'=>$post_id));

		$sender = $temp[0]['sender'];
		$receiver = $temp[0]['receiver'];
		if($receiver != $sender){

			DB::query("INSERT INTO notifications VALUES (NULL, 1 , :receiver , :sender ) ",array(':receiver'=>$receiver,':sender'=>$sender));
		}

	}

	public static function followNotify($user_id,$follower_id){

		$sender = $follower_id;
		$receiver = $user_id;

		if($sender != $receiver){
			DB::query("INSERT INTO notifications VALUES (NULL , 2 , :receiver , :sender) ",array(':receiver'=>$receiver,':sender'=>$sender));
		}

	}

}


?>