<?php
if ((isset($_FILES['picture1']))&&(isset($_POST['name']))&&(isset($_POST['qty']))&&(isset($_POST['category']))&&(isset($_POST['size']))&&(isset($_POST['price']))) {
	include('connection.php');
	$picCnt=(int)0;
	$loop=1;

	if (isset($URL[2])) {	
		$picCnt=(int)$URL[2];
	}

	$filenames="";
	$test_name="";

	if ($picCnt!=0) {
		$loop=1;
		while ($loop<=$picCnt) {
			if (isset($_FILES['picture'.$loop])) {
				$test_name = uploadimage('picture'.$loop)."/";
				if ($test_name != "FAILED/") {
					$filenames .= $test_name;
				}
				else{
					$loop = $picCnt;
					$test_name="FAILED";	
				}
			}
			$loop++;
		}
	}
	else
	{
		$test_name = uploadimage('picture'.$loop);
		if ($test_name != "FAILED") {
			$filenames .= $test_name;
		}
	}

	if ($test_name!="FAILED") {
		add($filenames);
	}
	else{
		mysqli_close($con);
		//echo "Failed to Add.";
		$_SESSION['notif']="FAILED";	
		header("Location: products");
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

function add($file)
{
	include('connection.php');
	$filenames=rtrim(ltrim(mysqli_real_escape_string($con,$file)));
	$name=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['name'])));
	$qty=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['qty'])));
	$category=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['category'])));
	$size=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['size'])));
	$price=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['price'])));
	$discount=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['discount'])));

	$query="INSERT INTO tblitems(name,qty,category,size,price,picture,discount) VALUES ('$name','$qty','$category','$size','$price','$filenames','$discount')";
	if (mysqli_query($con,$query)) {
		mysqli_close($con);
		$_SESSION['notif']="SUCCESS";
		header("Location: products");
	}
	else
	{
		mysqli_close($con);
		echo "Failed to Add.";
		$_SESSION['notif']="FAILED";	
		header("Location: products");
	}
}
?>