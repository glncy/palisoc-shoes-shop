<?php
if ((isset($_POST['title']))&&(isset($_POST['desc'])))
{
	include('connection.php');

	$title = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['title'])));
	$desc = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['desc'])));

	$test = uploadimage('photo');
	if ($test!='FAILED') {
		$query = "INSERT INTO tbllist (title,description,picture,type) VALUES ('$title','$desc','$test','header_image')";
		if (mysqli_query($con,$query)) {
			echo '<script type="text/javascript">
				alert("Uploaded Successfully.");
				window.location.href = "'.$_SERVER['HTTP_REFERER'].'";
			</script>';
		}
	}
	else {
		echo '<script type="text/javascript">
				window.location.href = "'.$_SERVER['HTTP_REFERER'].'";
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

	if (($width!='1280')&&($height!='350')) {
		$uploadOk = 0;
	}

	if($uploadOk==0)
	{
		echo "<script>alert('There was an Error in Uploading File. Maybe filename is existing or not a valid file.');</script>";
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
?>