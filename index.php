<?php
session_start();
$URL=explode("/", $_SERVER['QUERY_STRING']);
if ($_SERVER['QUERY_STRING']=="index") {
	require_once("error/404.php");
}
else{
	if ($URL[0]!="") {
		if ($URL[0]=="admin") {
			if (isset($_SESSION['admin_session'])) {
				if (isset($URL[1])) {
					if ($URL[1]!="") {
						if (file_exists('ed766ae19299df52b8b375e370ba0ec2/'.$URL[1].".php")) {
							require_once('ed766ae19299df52b8b375e370ba0ec2/'.$URL[1].".php");
						}
						else
						{
							require_once("error/404.php");
						}
					}
					else{
						require_once('ed766ae19299df52b8b375e370ba0ec2/home.php');
					}
				}
				else
				{
					require_once('ed766ae19299df52b8b375e370ba0ec2/home.php');
				}

			}
			else{
				require_once('ed766ae19299df52b8b375e370ba0ec2/login.php');
			}
			
		}
		else
		{
			if (($URL[0]=="cart")||($URL[0]=="transactions")||($URL[0]=="profile")) {
				if (isset($_SESSION['user_id'])) {
					if ($URL[0]=="cart") {
						require_once('cart.php');
					}
					else if ($URL[0]=="transactions") {
						require_once('transactions.php');
					}
					else if ($URL[0]=="profile") {
						require_once('profile.php');
					}
				}
				else{
					require_once("error/404.php");
				}
			}
			else
			{
				if (file_exists($URL[0].".php")) {
					require_once($URL[0].".php");
				}
				else
				{
					require_once("error/404.php");
				}
			}
		}
	}
	else
	{
		require_once("home.php");
	}
}

function base(){
	echo str_replace("index.php", "", $_SERVER['PHP_SELF']);
}


?>