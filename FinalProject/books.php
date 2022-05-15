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
		if(count($item)===0){
			echo "There is no content to read";
		}
		echo "<p>" . $item . "</p>";
	}

	?>
</body>

</html>
<?php include('templates/footer.html'); ?>