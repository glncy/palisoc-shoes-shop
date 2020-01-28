<?php
if ((isset($_POST['name']))&&(isset($_POST['qty']))&&(isset($_POST['category']))&&(isset($_POST['size']))&&(isset($_POST['price']))&&(isset($_GET['id'])))
{
	include('connection.php');

	$old_filename="";
	$id = $_GET['id'];
	$delete_target = "";

	if (isset($_GET['target'])) {
		$target = explode(",", $_GET['target']);
		$query = "SELECT * FROM tblitems WHERE id='$id'";
		$get = mysqli_query($con,$query);
		$row = mysqli_fetch_array($get);
		$picture = explode('/',$row['picture']);

		echo "<pre>";
		print_r($picture);
		echo "</pre>";

		$cnt = count($target);
		$loop = 0;

		while ( $loop < $cnt) {
			echo $target[$loop];
			$element = $target[$loop];
			$delete_target[$loop] = $picture[$element-1];
			unset($picture[$element-1]);
			$loop++;
		}

		echo "<pre>";
		print_r($delete_target);
		echo "</pre>";

		$cnt=count($picture);
		$loop=0;
		while ( $loop < $cnt) {
			if (isset($picture[$loop])) {
				if ($picture[$loop]!="") {
					$old_filename .= $picture[$loop]."/";
				}
			}
			$loop++;
		}
	}
	else
	{
		$query = "SELECT * FROM tblitems WHERE id='$id'";
		$get = mysqli_query($con,$query);
		$row = mysqli_fetch_array($get);
		$old_filename = $row['picture']."/";
	}

	echo $old_filename;
	echo "<pre>";
	print_r($_FILES);
	echo "</pre>";

	$cnt=count($_FILES);
	$loop=1;
	$new_filename = "";
	$test_name = "";
	while ($loop<=$cnt) {
		if (isset($_FILES['picture'.$loop])){
			if ($_FILES['picture'.$loop]['name']!="") {
				$test = uploadimage('picture'.$loop)."/";
				if ($test!="FAILED/") {
					$new_filename.=$test;
				}
				else{
					$loop==$cnt;
					$test_name="FAILED";
				}
			}
			
		}
		$loop++;
	}

	if ($test_name!="FAILED") {
		update($old_filename.$new_filename,$id);
	}
	else{
		mysqli_close($con);
		//echo "Failed to Add.";
		$_SESSION['notif']="FAILED_UPDATE";	
		header("Location: /admin/products");
	}
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
		header('Location: /admin');
	}
}


//header("Location: /admin/products

function uploadimage($name)
{
	$ext = file_extension($_FILES[$name]['name']) ; 
	$random_filename = date("Y-m-d").time().rand(1000,9999).".".$ext;
	$target_dir = "res/img/";
	$target_file = $target_dir . $random_filename;
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	// Check file size
	if ($_FILES[$name]["size"] > 1000000) {
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    $uploadOk = 0;
	}
	// Allow 800x800 size
	list ($width,$height) = getimagesize($_FILES[$name]["tmp_name"]);

	if ($width!=$height) {
		$uploadOk = 0;
	}

	if($uploadOk==0)
	{
		echo "<script>alert('There was an Error in Uploading File. Maybe filename is existing or not a valid file');</script>";
		return "FAILED";
	}
	// if everything is ok, try to upload file
	 else {
	    $picture=$random_filename;
	    if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file))
	    {
	        //echo "<script>alert('The photo has been uploaded')</script>";
	        return $picture;
	    }
	    else
	    {
	        //echo "<script>alert('There was an error uploading the file.')</script>";
	        return "FAILED";
	    }
	}
}

function file_extension($filename)
{
	$filename = strtolower($filename) ; 
	$exts = split("[/\\.]", $filename) ; 
 	$n = count($exts)-1; 
 	$exts = $exts[$n]; 
 	return $exts; 
}

function update($file,$id)
{
	include('connection.php');
	$filenames=rtrim(ltrim(mysqli_real_escape_string($con,$file)));
	$name=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['name'])));
	$qty=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['qty'])));
	$category=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['category'])));
	$size=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['size'])));
	$price=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['price'])));
	$discount=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['discount'])));

	$query="UPDATE tblitems SET name='$name',qty='$qty',category='$category',size='$size',price='$price',discount='$discount',picture='$filenames' WHERE id='$id'";
	if (mysqli_query($con,$query)) {
		if (isset($delete_target)) {
			$loop = 0;
			$cnt = count($delete_target);
			while ( $loop < $cnt) {
				unlink("res/img/".$delete_target[$loop]);
				$loop++;
			}
		}
		mysqli_close($con);
		$_SESSION['notif']="SUCCESS_UPDATE";
		header("Location: /admin/products");
	}
	else
	{
		mysqli_close($con);
		echo "Failed to Add.";
		$_SESSION['notif']="FAILED_UPDATE";	
		header("Location: /admin/products");
	}
}
?>