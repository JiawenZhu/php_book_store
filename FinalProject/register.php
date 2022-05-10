<?php // Script 8.9 - register.php
/* This page lets people register for the site (in theory). */

// Set the page title and include the header file:
define('TITLE', 'Register');
include('templates/header.html');
include('../mysqli_connect.php');

// Print some introductory text:
print '<h2>Registration Form</h2>
	<p>Register so that you can take advantage of certain features like this, that, and the other thing.</p>';

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$problem = false; // No problems so far.

	// Check for each value...
	if (empty($_POST['username'])) {
		$problem = true;
		print '<p class="text--error">Please enter your first name!</p>';
	} else {
		$username = $_POST['username'];
	}

	if (empty($_POST['password1'])) {
		$problem = true;
		print '<p class="text--error">Please enter a password!</p>';
	}

	if ($_POST['password1'] != $_POST['password2']) {
		$problem = true;
		print '<p class="text--error">Your password did not match your confirmed password!</p>';
	} else {
		$password = $_POST['password1'];
		// basic password hash
		$pwd_hashed = password_hash($password, PASSWORD_DEFAULT);
	}

	// insert data into database
	$sql = "INSERT INTO users (username, password, user_dir, status, admin) VALUES ('$username', '$pwd_hashed', '$username', 'OPEN', 'N')";

	if (!$problem) { // If there weren't any problems...

		// Print a message:
		if (mysqli_query($dbc, $sql)) {
			echo "New user created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
		}

		mysqli_close($dbc);

		$_POST = [];
	} else { // Forgot a field.

		print '<p class="text--error">Please try again!</p>';
	}
} // End of handle form IF.

// Create the form:
?>
<form action="register.php" method="post" class="form--inline">

	<p><label for="username">User Name:</label><input type="text" name="username" size="20" value="<?php if (isset($_POST['username'])) {
																																																		print htmlspecialchars($_POST['username']);
																																																	} ?>"></p>

	<p><label for="password1">Password:</label><input type="password" name="password1" size="20" value="<?php if (isset($_POST['password1'])) {
																																																				print htmlspecialchars($_POST['password1']);
																																																			} ?>"></p>
	<p><label for="password2">Confirm Password:</label><input type="password" name="password2" size="20" value="<?php if (isset($_POST['password2'])) {
																																																								print htmlspecialchars($_POST['password2']);
																																																							} ?>"></p>

	<p><input type="submit" name="submit" value="Register!" class="button--pill"></p>

</form>

<?php include('templates/footer.html'); // Need the footer. 
?>