<?php
include('connection.php');
if (isset($_POST['email'])) {
	$email=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['email'])));
	$query="SELECT * FROM tblusers WHERE email='$email'";
	$get=mysqli_query($con,$query);
	$num_rows=mysqli_num_rows($get);
	if ($num_rows!=0)
	{
		$row=mysqli_fetch_array($get);
		echo '<br/>
	    <h4>Security Questions</h4>
	    <hr/>
	    <input type="text" class="form-control" value="'.$row['id'].'" required="" disabled="" style="display:none;" id="forgot_id">
		<div class="input-group">
			<span class="input-group-addon">
	        	#1
	      	</span>
	      	<input type="text" class="form-control" value="'.$row['q1'].'" required="" disabled="">
	    	<input type="password" class="form-control" placeholder="Answer" name="q1_ans" required="" id="forgot_q1_ans" onkeyup="sec_question_answer(\'q1\')">
	    </div>
	    <div id="q1_result"><br/></div>
	    <div class="input-group">
			<span class="input-group-addon">
	        	#2
	      	</span>
	      	<input type="text" class="form-control" value="'.$row['q2'].'" required="" disabled="">
	    	<input type="password" class="form-control" placeholder="Answer" name="q2_ans" required="" id="forgot_q2_ans" onkeyup="sec_question_answer(\'q2\')">
	    </div>
	    <div id="q2_result"><br/></div>';
	}
	else
	{
		echo "0";
	}
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