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
		$author = $_POST['author'];
		$text = $_POST['text'];
		$id = $_POST['id'];

		if (isset($_POST['favorite'])) {
			$sql = "UPDATE quotes SET author = '$author', text = '$text', favorite = 'Y' WHERE id = $id";
		} else $sql = "UPDATE quotes SET author = '$author', text = '$text', favorite = 'N' WHERE id = $id";

		if ($dbc->query($sql) === TRUE) {
			header('Location:  user_view_quote.php');
		} else {
			echo "Error: " . $sql . "<br>" . $dbc->error;
		}

		$dbc->close();
	}
	?>
	<form action="update_quote.php" method="post">
		<p><label for="username">Author name</label><input type="text" name="author" size="20"></p>
		<textarea name="text" rows="6" cols="30"></textarea>
		<input name="favorite" type="checkbox" />
		<input type="text" name="id" value="<?php echo $_GET['id']; ?>" hidden/>
		<label for=favorite>check to add as favorite</label>
		<br />
		<br />
		<input type="submit" name="submit" value="Update this Quote!" class="button--pill">
	</form>

</body>

</html>