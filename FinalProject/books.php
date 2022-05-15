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
	$data = file('books.csv');

	// Count the number of items in the array:

	if (count($data) === 0) {
		echo "There is no content to read";
	} else {
		foreach ($data as $item) {
			$book_desc = explode('|', $item);
			// list description of each book 0 is author name 1 is book name.
			echo '<div class="ui container">
			<table class="ui very basic collapsing celled table">
					<thead>
							<tr>
									<th>Author Name</th>
									<th>Book Name</th>
							</tr>
					</thead>
					<tbody>
							<tr>
									<td>
											' . $book_desc[0] . '
									</td>
									<td>
											' . $book_desc[1] . '
									</td>
							</tr>
					</tbody>
			</table>
	</div>';
		}
	}

	?>
</body>

</html>
<?php include('templates/footer.html'); ?>