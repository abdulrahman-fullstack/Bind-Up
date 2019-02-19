<?php 

if(!isset($_COOKIE['BUEM'])){
	 header('location:/');
} else{

	require 'classes/DB.php';
	require 'classes/Login.php';

	if(!DB::query("SELECT * FROM login_tokens WHERE token=:token",array(':token'=>sha1($_COOKIE['BUEM'])))){

		header('location:/');
	} else{

		$user = Login::isLoggedIn();
		$dob = $user['dob'];
		$dob = explode('-', $dob);
		$day = $dob[2];
		$month = $dob[1];
		$year = $dob[0];
		$dob = "{$year}-{$month}-{$day}";
		$dob = date("Y-M-d" , strtotime($dob));
		echo '<script>console.log("'.$dob.'");</script>';
		$dob = explode('-', $dob);
	}
}

if(isset($_POST['update'])){

	$target = './images/'.basename($_FILES['pro_img']['name']);
	$img = $_FILES['pro_img']['name'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$ph_num = $_POST['ph_num'];
	$gender = $_POST['gender'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$dob = "{$year}-{$month}-{$day}";
	$dob = date("Y-m-d" , strtotime($dob));

	if($fname == "" || $lname=="" || $ph_num=="" || $gender=="" || $img==""){
		echo "<script>alert('Fill in all the fields')</script>";
	} else{

		DB::query("UPDATE users SET fname=:fname , lname=:lname , gender=:gender , ph_num=:ph_num , dob=:dob , img=:img WHERE id=:user_id ",array(':fname'=>$fname , ':lname'=>$lname,':gender'=>$gender,':ph_num'=>$ph_num,':dob'=>$dob,':img'=>$img,':user_id'=>$user['id']));

		move_uploaded_file($_FILES['pro_img']['tmp_name'], $target);

		header('location:/profile.php');

	}

}



?>

<html>
<head>
	<title>BindUp</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/edp.css">
	<!-- <link rel="stylesheet" href="css/font-awesome.css"> -->
	<link rel="stylesheet" href="fonts/montez.css">
	<link rel="stylesheet" href="css/helvatica.css">
</head>
<body>
<div class="wrap">
	<div class="hdr-wrap">
		<div class="header">

			<header><a href="/">BindUp</a></header>

		</div>
	</div>

	<div class="edt-profile">
		<div class="form">
			<form action="" method="post" enctype="multipart/form-data">
				<p><input type="file" name="pro_img"> - Upload profile picture</p>
				<p><input value="<?php echo $user['fname']; ?>" name="fname" type="text"> - First Name</p>
				<p><input value="<?php echo $user['lname']; ?>" name="lname" type="text"> - Last Name</p>
				<p><input value="<?php echo $user['ph_num']; ?>" type="text" name="ph_num"> - Contact Number</p>
				<p><input value="<?php echo $user['gender']; ?>" type="text" name="gender"> - Gender</p>
				<p>
					<select name="day" id="day" value="<?php echo $dob[2] ?>">
					<?php
						foreach (range(1, 31, 1) as $day){
							if(strlen($day) == 1){
								echo "<option value='0$day'>$day</option>";
							}else{
								echo "<option value='$day'>$day</option>";
							}
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
				<p><input type="submit" name="update" value="Update"><span><a href="profile.php" class="cancel">Cancel</a></span></p>
			</form>
		</div>
	</div>


</div>
<script src="js/jquery-3.2.1.js"></script>
<script>
	
window.onload = function(){

	$('#day').val('<?php echo $dob[2] ?>').change();
	$('#month').val('<?php echo $dob[1] ?>').change();
	$('#year').val('<?php echo $dob[0] ?>').change();

};

</script>
</body>
</html>