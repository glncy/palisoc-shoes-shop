<!DOCTYPE html>
<html>
<head>
	<title><?php echo $location;?> | Palisoc Foot Wear</title>
	<base href="http://localhost">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap3/css/bootstrap-theme.min.css">
	<script type="text/javascript" src="assets/jquery3.2.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap3/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/script.js"></script>
	<script type="text/javascript" src="assets/highcharts.js"></script>
	<script type="text/javascript" src="assets/exporting.js"></script>
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
		.panel
		{
			border-radius: 0px;
		}
		.panel-heading
		{
			background-image: none;
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
       				<li class="active"><a href="admin"><span class="glyphicon glyphicon-home"></span>&nbspHome<span class="sr-only">(current)</span></a></li>
        			<li><a href="admin/reports">Reports</a></li>
        			<li><a href="admin/products">Products</a></li>
	      		</ul>
	      		<ul class="nav navbar-nav navbar-right">
        			<li><a href="admin/manage">Administrator</a></li>
        			<li><a href="logout">Log out</a></li>
	      		</ul>
    		</div><!-- /.navbar-collapse -->
  		</div><!-- /.container-fluid -->
	</nav>
	<div style="margin-bottom: 60px;"></div>