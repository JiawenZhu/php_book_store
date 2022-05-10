<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>View A Quotation</title>
</head>
<?php
include('templates/header.html');
include('../mysqli_connect.php');
?>

<body>
  <h1>Quotes</h1>
  <?php
  	// read data from database
	$sql = "SELECT * FROM quotes";
	$quote = mysqli_query($dbc, $sql);
	if (mysqli_num_rows($quote) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($quote)) {
      print  $row["text"];
			print '<br>';
			print '<i><strong>' . $row["author"] . '</strong></i>';
			print '<br><hr>';
		}
	} else {
		echo "0 results";
	}
  ?>
</body>

</html>