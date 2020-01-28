<?php
if (isset($_SERVER['HTTP_REFERER']))
{
	session_destroy();
	header('Location: /');
}
else
{
	header('Location: /');
}
?>