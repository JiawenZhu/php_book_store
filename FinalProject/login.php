<?php // Script 8.8 - login.php
/* This page lets people log into the site (in theory). */

// Set the page title and include the header file:
define('TITLE', 'Login');
include('templates/header.html');
include('../mysqli_connect.php');
// database connection
print '<h2>Login Form</h2>
	<p>Users who are logged in can take advantage of certain features like this, that, and the other thing.</p>';

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$sql = $dbc->query("SELECT * FROM users WHERE username = '$username'");
	if ((!empty($username)) && (!empty($password))) {
		if ($sql->num_rows > 0) {
			$user = $sql->fetch_array();
			if (password_verify($password, $user['password']) && $user['status'] === 'OPEN') {
				// starts session after a user login
				session_start();
				$_SESSION['username'] = $username;
				$_SESSION['user_loggedin'] = time();

				if ($user['admin'] == 'Y') {
					$_SESSION['admin_loggedin'] = 'Y';
					header('Location: admin_welcome.php');
				} else header('Location: user_welcome.php');
			} elseif ($user['status'] === 'LOCKED') {  	// account is  locked
				echo '<span style="color: red;">Sorry, your account has been locked!</span><br>';
				echo '<a href="login.php">Try a different account to login</a>';
			}
		} else { // Incorrect information!

			print '<p class="text--error">The submitted username and password do not match those on file!<br>Go back and try again.</p>';
			print '<a href="./login.php">try again here</a>';
		}
	} else { // Forgot a field.

		print '<p class="text--error">Please make sure you enter both an username and a password!<br>Go back and try again.</p>';
	}
} else { // Display the form.

	echo '<form action="login.php" method="post" class="form--inline">
	<p><label for="name">User Name:</label><input type="name" name="username" size="20"></p>
	<p><label for="password">Password:</label><input type="password" name="password" size="20"></p>
	<p><input type="submit" name="submit" value="Log In!" class="button--pill"></p>
	</form>';
}

include('templates/footer.html'); // Need the footer.
