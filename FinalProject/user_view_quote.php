<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>View A Quotation</title>
</head>
<?php
include('./userlogin_check.php');
include('../mysqli_connect.php');
?>

<body>
	<h1>Quotes</h1>
	<h2>
		<a href="./add_quote.php"><span style="color: blue">Add New Quote</span></a>
	</h2>
	<?php
	// read data from database
	$sql = "SELECT * FROM quotes";
	$quote = mysqli_query($dbc, $sql);
	if (mysqli_num_rows($quote) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($quote)) {
			$quote_id = $row['id'];
			echo  $row["text"] . " " . (($row["favorite"] == "Y") ? '<span style=color:red>Favorite!</span>' : '');
			echo '<br>';
			echo '<i><strong>' . $row["author"] . '</strong></i>';
			echo '<br>';
			echo '<i>' . $row["date_entered"] . '</i>';
			echo '<br>';
			echo "<a href='update_quote.php?id=$quote_id'>Update</a> | <a href='delete_quote.php?id=$quote_id'>Delete</a>";
			echo '<br> <hr>';

		}
	} else {
		echo "0 results";
	}
	?>
</body>

</html>