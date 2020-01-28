<?php
if ((isset($URL[2]))&&(isset($_POST['status'])))
{
	include('connection.php');
	$id = rtrim(ltrim(mysqli_real_escape_string($con,$URL[2])));
	$status = lcfirst(rtrim(ltrim(mysqli_real_escape_string($con,$_POST['status']))));
	if (isset($_POST['remarks'])) {
		$remarks = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['remarks'])));
	}
	else
	{
		$remarks = "";
	}
	if ($status=="verifying") {
		$status="";
	}
	$query = "UPDATE tblcheckout SET status='$status', remarks='$remarks' WHERE id='$id'";
	if (mysqli_query($con,$query) or die(mysqli_error($con))) {
		if ($status=='') {
			$query="SELECT * FROM tblcheckout WHERE id='$id'";
			$get=mysqli_query($con,$query);
			$row=mysqli_fetch_array($get);
			$user_id=$row['user_id'];
			$notif = array('notif'=>'CHECK_OUT_VERIFY','id'=>$id);
			$json = json_encode($notif);
			$query = "INSERT INTO tblnotif (json_notif,user_id,read_notif) VALUES ('$json','$user_id','false')";
			mysqli_query($con,$query);
			echo '<script type="text/javascript">
				alert("Updated Successfully.");
				window.location.href = "/admin";
			</script>';
		}
		elseif ($status=='verified') {
			$query="SELECT * FROM tblcheckout WHERE id='$id'";
			$get=mysqli_query($con,$query);
			$row=mysqli_fetch_array($get);
			$product_id = explode("#", $row['products_id']);
			$qty = explode("#", $row['qtys']);
			$user_id=$row['user_id'];
			$notif = array('notif'=>'CHECK_OUT_VERIFIED','id'=>$id);
			$json = json_encode($notif);
			$query = "INSERT INTO tblnotif (json_notif,user_id,read_notif) VALUES ('$json','$user_id','false')";
			mysqli_query($con,$query);
			echo '<script type="text/javascript">
				alert("Updated Successfully.");
				window.location.href = "/admin";
			</script>';
		}
		elseif ($status=='failed') {
			$query="SELECT * FROM tblcheckout WHERE id='$id'";
			$get=mysqli_query($con,$query);
			$row=mysqli_fetch_array($get);
			$user_id=$row['user_id'];
			$notif = array('notif'=>'CHECK_OUT_FAILED','id'=>$id,'remarks'=>$remarks);
			$json = json_encode($notif);
			$query = "INSERT INTO tblnotif (json_notif,user_id,read_notif) VALUES ('$json','$user_id','false')";
			mysqli_query($con,$query);
			echo '<script type="text/javascript">
				alert("Updated Successfully.");
				window.location.href = "/admin";
			</script>';
		}
		elseif ($status=='processing') {
			$query="SELECT * FROM tblcheckout WHERE id='$id'";
			$get=mysqli_query($con,$query);
			$row=mysqli_fetch_array($get);
			$user_id=$row['user_id'];
			$notif = array('notif'=>'CHECK_OUT_PROCESSING','id'=>$id);
			$json = json_encode($notif);
			$query = "INSERT INTO tblnotif (json_notif,user_id,read_notif) VALUES ('$json','$user_id','false')";
			mysqli_query($con,$query);
			echo '<script type="text/javascript">
				alert("Updated Successfully.");
				window.location.href = "/admin";
			</script>';
		}
		elseif ($status=='delivering') {
			$query="SELECT * FROM tblcheckout WHERE id='$id'";
			$get=mysqli_query($con,$query);
			$row=mysqli_fetch_array($get);
			$user_id=$row['user_id'];
			$notif = array('notif'=>'CHECK_OUT_DELIVERING','id'=>$id,'remarks'=>$remarks);
			$json = json_encode($notif);
			$query = "INSERT INTO tblnotif (json_notif,user_id,read_notif) VALUES ('$json','$user_id','false')";
			mysqli_query($con,$query);
			echo '<script type="text/javascript">
				alert("Updated Successfully.");
				window.location.href = "/admin";
			</script>';
		}
		elseif ($status=='delivered') {
			$query="SELECT * FROM tblcheckout WHERE id='$id'";
			$get=mysqli_query($con,$query);
			$row=mysqli_fetch_array($get);
			$user_id=$row['user_id'];
			$notif = array('notif'=>'CHECK_OUT_DELIVERED','id'=>$id,'remarks'=> "Order ID: ".$row['id']);
			$json = json_encode($notif);
			$query = "INSERT INTO tblnotif (json_notif,user_id,read_notif) VALUES ('$json','$user_id','false')";
			mysqli_query($con,$query);
			echo '<script type="text/javascript">
				alert("Updated Successfully.");
				window.location.href = "/admin";
			</script>';
		}
	}
	else
	{
		echo '<script type="text/javascript">
	alert("Failed to Update Status.");
	window.location.href = "/admin";
</script>';
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