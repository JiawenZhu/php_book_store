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
    $id = $_POST['id'];

    if (isset($_POST['delete'])) {
      $sql = "DELETE FROM quotes WHERE id = $id";
    } else {
      header('Location:  user_view_quote.php');
    }


    if ($dbc->query($sql) === TRUE) {
      header('Location:  user_view_quote.php');
    } else {
      echo "Error: " . $sql . "<br>" . $dbc->error;
    }
    $dbc->close();
  }
  ?>
  <form action="delete_quote.php" method="post">
    <p><Span style="color: red;">Are you sure you want to delete this quote?</Span></p>
    <input type="submit" name="delete" value="YES, delete this Quote!" class="button--pill">
    <input type="submit" name="cancel" value="NO, leave this quote alone!" class="button--pill">
    <input type="text" name="id" value="<?php echo $_GET['id']; ?>" hidden />
  </form>
</body>

</html>