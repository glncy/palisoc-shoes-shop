<!DOCTYPE html>
<html>
<head>
	<title><?php echo $location;?> | Palisoc Foot Wear</title>
	<base href="<?php echo base();?>">
	<link rel="stylesheet" type="text/css" href="connection.php">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap3/css/bootstrap-theme.min.css">
	<script type="text/javascript" src="assets/jquery3.2.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap3/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/city.min.js"></script>
	<script type="text/javascript" src="assets/script.js"></script>
	<style type="text/css">
		body
		{
			background-color: #cbcf57;
		}
		.navbar
		{
			border-radius: 0px;
			background-color: black;
		}
		.navbar-nav>li>a
		{
			color: white;
		}
		.navbar-nav>li>a:hover
		{
			color: white;
			background-color: gray;
		}
		.nav .open>a, .nav .open>a:focus, .nav .open>a:hover
		{
			color: white;
			background-color: gray;
		}
		.form-control
		{
			border-radius: 0px;
		}
		.btn_search
		{
			border-radius: 0px;
			background-image: none;
			color: white;
		}
		.btn_search:hover
		{
			background-color: white;
			color: black;
			background-image: none;
		}
		.col-sm-2
		{
			margin-top: 20px;
		}
		.modal-content
		{
			border-radius: 0px;
		}
		hr
		{
			border-color: black;
		}
		.btn
		{
			border-radius: 0px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-primary navbar-fixed-top">
		<div class="container-fluid">
    		<div class="navbar-header">
      			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topnav" aria-expanded="false" style="background-color: white; border-radius: 0px;">
		        	<span class="sr-only">Toggle navigation</span>Menu
		      	</button>
      			<a class="navbar-brand" href="#" style="color: #d7df00; padding-top: 10px; padding-left: 10px;">
      				<img src="res/logo.png" style="width: 30px;display: inline-block;" > &nbsp Palisoc Footwear</a>
    		</div>
    		<div class="collapse navbar-collapse" id="topnav">
      			<ul class="nav navbar-nav">
       				<li class="active"><a href="/"><span class="glyphicon glyphicon-home"></span>&nbspHome<span class="sr-only">(current)</span></a></li>
        			<li><a href="/shoes/men">Men</a><li/>
        			<li><a href="/shoes/women">Women</a></li>
        			<li><a href="/shoes/kids">Kids</a></li>
        			<!--<li><a href="#">Casual</a></li>-->
	      		</ul>
	      		<?php
	      		if (isset($_SESSION['user_id'])) {
	      			include('connection.php');
	      			$user_id=$_SESSION['user_id'];
	      			$query="SELECT * FROM tblcart WHERE user_id='$user_id'";
	      			$get=mysqli_query($con,$query) or die(mysqli_error($con));
	      			$cart=mysqli_num_rows($get);
	      			echo '
	      		<ul class="nav navbar-nav navbar-right">
        			<li><a href="cart"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp<span style="background-color: red; padding: 10px; color: white; border-radius: 100px;" id="cart_count">'.$cart.'</span></a></li>
	      			<li class="dropdown">
	          			<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Hi '.$_SESSION['user_name'].'!&nbsp<span class="caret"></span>&nbsp';
	          		$query="SELECT * FROM tblnotif WHERE user_id='$user_id' AND read_notif='false'";
	          		$get=mysqli_query($con,$query);
	          		$notif=mysqli_num_rows($get);
	          		if ($notif>0) {
	          		echo '<span style="background-color: red; padding: 10px; color: white; border-radius: 100px;">'.$notif.'</span>';
	          		}
	          		echo '</a>
	          			<ul class="dropdown-menu">
	            			<li><a href="profile">Profile</a></li>
				            <li><a href="transactions">Transactions ';
				    if ($notif>0) {
				    	echo '<span style="border-radius: 20px;background-color:red;color: white; padding:5px;">'.$notif.'</span>';
				    }
				    echo '</a></li>
				            <li role="separator" class="divider"></li>
				            <li><a href="logout">Log out</a></li>
	          			</ul>
        			</li>
	      		</ul>';
	      		}	
	      		else
	      		{
	      			echo '
	      		<ul class="nav navbar-nav navbar-right">
        			<li><a href="#" data-toggle="modal" data-target="#sign_up">Sign Up</a></li>
        			<li><a href="#" data-toggle="modal" data-target="#login">Log In</a></li>
	      		</ul>
	      		';
	      		}
	      		?>
	      		<form class="navbar-form navbar-right" action="search_query" method="post">
	        		<div class="input-group">
				    	<input type="text" class="form-control" placeholder="Search for..." name="search" value="<?php 
				    	if ($URL[0]=='search'){
					    		if (isset($URL[1])){
					    		echo $URL[1];
				    		}
				    	}?>" required>
				    	<span class="input-group-btn">
				        	<button class="btn btn-primary btn_search" type="submit"><span class="glyphicon glyphicon-search"></span></button>
				      	</span>
				    </div>
	      		</form>
    		</div><!-- /.navbar-collapse -->
  		</div><!-- /.container-fluid -->
	</nav>
	<div style="margin-bottom: 60px;"></div>