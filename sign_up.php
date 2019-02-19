<?php

require 'classes/source_sign_up.php';

?>
<html>
<head>
	<title>SM-sign up</title>
	<?php require_once 'header.php'; ?>
	<link rel="stylesheet" href="css/sign_up_main.css">
</head>

<body>
	<?php require_once 'hdlogo.php'; ?>

	<div class="wrap">
		
		<h1>Sign Up</h1>
		<div class="login" style="text-align: center;margin:10px 0 0 0;">or <a href="/">Login</a></div>
		<div class="sign-up">
			<form action="sign_up.php"  method="post" onsubmit="return validate()" >				
				<p>
					<input type="text" class="fname" placeholder="&nbsp;First name" name="fname" >
				</p>
				<p>
					<input type="text" class="lname" placeholder="&nbsp;Last Name" name="lname" >
				</p>
				<p>
					<label for="day">Birth Date :</label>
					<select name="day" id="day">
					<?php
						foreach (range(1, 31, 1) as $day){
							echo "<option value='$day'>$day</option>";
						}
						echo "</select>";

 						$months=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec');

						echo "<select name='month' id='month'>";

						foreach ($months as $month) {
							echo "<option value='$month'>$month</option>";
						}
						echo "</select>";

						$cur_year = date('Y');
						echo "<select name='year' id='year'>";

						foreach(range($cur_year-15 , 1910 , 1) as $year){
							echo "<option value='$year'>$year</option>";
						}
						echo "</select>";
					?>
				</p>
				<p>
					<label for="gender" class="gender-lbl">Gender :</label>
					<select name="gender" id="gender">
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</p>
				<p>
					<input type="text" class="ph_num" name="ph_num" placeholder="&nbsp;Phone number">
				</p>
				<p>
					<input type="email" class="email" placeholder="&nbsp;E-mail" name="email" >
				</p>				
				<p>
					<input type="password" class="pwd" placeholder="&nbsp;Password" name="password" maxlength="20">
					<span class="show"><img src="images/eye.png" alt="show"></span>
				</p>
				<p>
					<input type="submit" name="submit" value="Sign up" >
				</p>
			</form>
		</div>
		<div class="vb"></div>
		<div class="moto">
			It's Time<br> &nbsp;&nbsp;&nbsp;To Get <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bind Up
		</div>
	</div>

<script src="js/jquery-3.2.1.js"></script>
<script>

	$(window).on('load' , function(){
		$('input.fname').trigger('focus');
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

		var fname = $('input.fname').val(),
		lname = $('input.lname').val(),
		ph_num = $('input.ph_num').val(),
		email = $('input.email').val(),
		pwd = $('input.pwd').val();

		if(fname==='' || lname==='' || ph_num==='' || email ==='' || pwd ===''){
			alert('Enter all the fields ');
			if($('input').val()===''){
				$(this).trigger('focus');
			}
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