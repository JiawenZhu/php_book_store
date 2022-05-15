<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Books</title>
</head>

<body>
	<?php
	define('TITLE', 'Books by J.D. Salinger');
	include('templates/header.html');

	echo "<h1>My Books</h1>";
	// Read the file's contents into an array:
	$data = file('../users/user/books.csv');

	// Count the number of items in the array:
	foreach ($data as $item) {
		echo "<p>" . $item . "</p>";
	}

	?>
</body>

</html>
<?php include('templates/footer.html'); ?>