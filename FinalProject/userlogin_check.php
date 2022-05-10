<?php
session_start();
// check if the session is continuous

if(isset($_SESSION['admin_loggedin'])){
	include('templates/admin_login_header.html');
}
elseif (isset($_SESSION['user_loggedin'])) {
	include('templates/user_login_header.html');
} else
	header('Location: index.php');
?>