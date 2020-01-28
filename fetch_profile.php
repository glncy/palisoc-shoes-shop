<?php
if (isset($_POST['id'])) {
	include('connection.php');
	$id = $_POST['id'];
	$query="SELECT * FROM tblusers WHERE id='$id'";
	$get=mysqli_query($con,$query);
	$row=mysqli_fetch_array($get);
	echo '<div class="input-group">
			<span class="input-group-addon">
	        	First Name
	      	</span>
	    	<input type="text" class="form-control" value="'.$row['fname'].'" disabled id="fname">
	    </div>
	    <br/>
	    <div class="input-group">
			<span class="input-group-addon">
	        	Last Name
	      	</span>
	    	<input type="text" class="form-control" value="'.$row['lname'].'" disabled id="lname">
	    </div>
	    <br/>
	    <div class="input-group">
			<span class="input-group-addon">
	        	Birthday
	      	</span>
	    	<input type="date" class="form-control" value="'.$row['birth'].'" disabled id="birth">
	    </div>
	    <br/>
	    <div class="input-group">
			<span class="input-group-addon">
	        	E-mail
	      	</span>
	    	<input type="email" class="form-control" value="'.$row['email'].'" disabled id="email">
	    </div>
	    <div id="pw_group" style="display:none;">
	    <br/>
	    <div class="input-group">
			<span class="input-group-addon">
	        	Password
	      	</span>
	    	<input type="password" class="form-control" value="00000000" id="pw">
	    </div>
	    <br/>
	    <div class="input-group">
			<span class="input-group-addon">
	        	Retype password
	      	</span>
	    	<input type="password" class="form-control" value="00000000" id="confirmpw" onkeyup="edit_verify_pw();">
	    </div>
	    <div id="edit_verify_pw">
	    	<br/>
	    </div>
	    </div>';
	mysqli_close($con);
}
else
{
	if (isset($_SERVER['HTTP_REFERER']))
	{
		mysqli_close($con);
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	else
	{
		mysqli_close($con);
		header('Location: /');
	}
}
?>