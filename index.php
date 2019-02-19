<?php

require_once 'classes/valid.php';

if(isset($_COOKIE['BUEM'])){

	if(DB::query("SELECT * FROM login_tokens WHERE token=:token",array(':token'=>sha1($_COOKIE['BUEM'])))){

		header('location:userhome.php');
	}
}

?>
<html>
<head>
	<title>SM-Login</title>
	<?php require_once 'header.php'; ?>
	<link rel="stylesheet" href="css/lgin_main.css">
	
</head>

<body>

<?php require_once 'hdlogo.php'; ?>

<div class="wrap">
	
	<div class="title">
		<h1>Log In</h1>
		<span class="sop">or &nbsp;<a href="sign_up.php">create account</a></span>
	</div>
	
	<div class="lgnfrm">
		<form action="index.php"  method="post" class="login" >
			<p>
				<input type="email" class="email" placeholder="&nbsp;Login Id" name="loginid" >
			</p>
			<p>
				<input type="password" class="pwd" placeholder="&nbsp;Password" name="password" maxlength="20" >
				<span class="show"><img src="images/eye.png" alt="show"></span>
			</p>
			<p>
				<input type="submit" name="login" value="Log in" class="loginbtn" onclick="return validate();" >
			</p>
			
			
		</form>
		<div class="vb"></div>
	</div>

	<div class="moto">
		Let's <br> &nbsp;&nbsp;&nbsp;Get <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bind	
	</div>
	<!-- <span >or <a href="sign_up.php">Sign Up</a></span> -->
</div>
	


<script src="js/jquery-3.2.1.js"></script>
<script>

$(window).on('load' , function(){
	$('input.email').trigger('focus');
});

( function () {

	$('span.show img').on('click' , function(){
		if ($('input.pwd').attr('type') == 'password') {

			$('input.pwd').attr('type' , 'text');		
		}
		else {
			$('input.pwd').attr('type' , 'password');
		}
	});

})();

function validate(){

	var lid = $('form.login input.lid').val(),
		pwd = $('form.login input.pwd').val();

	if(lid==='' || pwd===''){
		alert('Enter both the fields ');
		return false;
	}
	else{
		return true;
	}
}

$('input').on('blur', function(){
	if($(this).val()!==""){
		$(this).css('font-weight' , 'bold');
	}
});

</script>

</body>
</html>
