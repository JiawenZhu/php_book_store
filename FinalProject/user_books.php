<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Books</title>
</head>

<body>
	<?php
	define('TITLE', 'Books by J.D. Salinger');
	include('userlogin_check.php');
	$file_dir = "../users/" . $_SESSION['username'] . "/books.csv";
	?>
	<form action="user_books.php" method="post" class="form--inline">
		<p><label for="name">Author Name:</label><input type="text" name="authorname" size="20"></p>
		<p><label for="password">Book Name:</label><input type="text" name="bookname" size="20"></p>
		<p><input type="submit" name="submit" value="Submit" class="button--pill"></p>
	</form>
	<?php
	echo "<h1>My Books</h1>";
	// Read the file's contents into an array:
	$data = file($file_dir);

	// Count the number of items in the array:
	foreach ($data as $item) {
		echo "<p>" . $item . "</p>";
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
		if (!empty($_POST['authorname']) && (!empty($_POST['bookname']))) { // Need some thing to write.
			$content = $_POST['authorname']. ' | ' . $_POST['bookname'];
			print $content;
			if (is_writable($file_dir)) { // Confirm that the file is writable.

				file_put_contents($file_dir, $content . PHP_EOL, FILE_APPEND); // Write the data.

			} else { // Could not open the file.
				print '<p style="color: red;">Your quotation could not be stored due to a system error.</p>';
			}
		} else { // Failed to enter a quotation.
			print '<p style="color: red;">Please enter a quotation!</p>';
		}
	}
	?>

</body>

</html>
<?php include('templates/footer.html'); ?>