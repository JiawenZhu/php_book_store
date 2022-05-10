<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Add A Quotation</title>
</head>

<body>
	<?php
	include('userlogin_check.php');
	include('../mysqli_connect.php');
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$author = $_POST['author'];;
		$text = $_POST['text'];
		if (isset($_POST['favorite'])) {
			$sql = "INSERT INTO quotes(author, date_entered, favorite, text) VALUES ('$author', NOW(), 'Y', '$text')";
		} else $sql = "INSERT INTO quotes(author, date_entered, favorite, text) VALUES ('$author', NOW(), 'N', '$text')";

		if ($dbc->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $dbc->error;
		}

		$dbc->close();
	}


	?>
	<form action="add_quote.php" method="post">
		<p><label for="username">Author name</label><input type="text" name="author" size="20"></p>
		<textarea name="text" rows="6" cols="30" placeholder="start your quote..."></textarea>
		<input name="favorite" type="checkbox" />
		<label for=favorite>check to add as favorite</label>
		<br />
		<br />
		<input type="submit" name="submit" value="Add This Quote!" class="button--pill">
	</form>

</body>

</html>