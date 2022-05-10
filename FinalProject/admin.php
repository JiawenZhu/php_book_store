<?php // Script 8.4 - index.php
/* This is the home page for this site. 
It uses templates to create the layout. */

// Include the header:
// include('userlogin_check.php');
include('../mysqli_connect.php');
require('./userlogin_check.php');
// Leave the PHP section to display lots of HTML:
?>
<?php
$sql_user = $dbc->query("SELECT * FROM users ORDER BY username");
?>
<h2>Administrator Functions </h2>
<form action="adminEdit.php" method="post" class="form--inline">
  <label for="name">Select A user name:</label>
  <select id="username" name="username">
    <?php
    if ($sql_user->num_rows > 0) {
      while($data = $sql_user->fetch_array()){
        echo '<option value="username">' .$data['username']. '</option>';
      }
    }
    ?>
  </select><br><br>
  <input type="submit" name="submit" value="Submit!" class="button--pill">
</form>


<?php // Return to PHP.
include('templates/footer.html'); // Include the footer.
?>