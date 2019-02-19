<?php 

require_once('DB.php');

$db = new DB("127.0.0.1","bindup","root","bindup");
   
if($_SERVER['REQUEST_METHOD'] == "GET"){



} else if($_SERVER['REQUEST_METHOD'] == "POST"){

	if($_GET['url'] == 'auth'){

		$body = file_get_contents("php://input");
		$body = json_decode($body);

		$email = $body->email;
		$pass = $body->password;

		if($user = $db->query("SELECT * FROM users WHERE email=:email AND password=:pass",array(':email'=>$email,':pass'=>sha1($pass)))){

			$cstrong = true;
			$token = bin2hex(openssl_random_pseudo_bytes(64,$cstrong));

			$db->query("INSERT INTO login_tokens VALUES('',:token,:user_id)",array(':token'=>sha1($token),':user_id'=>$user[0]['id']));

			echo ' { "Token": "'.$token.'" } ';

		} else {

			http_response_code(401);
		}
	}
   
}else if($_SERVER['REQUEST_METHOD'] == "DELETE"){

	if($_GET['url'] == 'auth'){

		if(isset($_GET['token'])){
			
			if($db->query("SELECT token FROM login_tokens WHERE token=:token ",array(':token'=>sha1($_GET['token'])))){
				
				$db->query("DELETE FROM login_tokens WHERE token=:token",array(':token'=>sha1($_GET['token'])));

				echo ' "Status": "Success" ';
				http_response_code(200);

			} else {

				echo ' "Error":  "Invalid Token" ';
				http_response_code(400);
			}
		} else {

			echo ' "Error": "Token not found" ';
			http_response_code(400);
		}
	}

} else {
   http_response_code(405);
}

?>