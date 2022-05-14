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
$sql_all_users = $dbc->query("SELECT * FROM users ORDER BY username");
?>
<h2>Administrator Functions </h2>
<!-- form 1 -->
<form action="admin.php" method="post" class="form--inline">
  <label for="name">Select A user name:</label>
  <select id="username" name="username">
    <?php
    if ($sql_all_users->num_rows > 0) {
      while ($data = $sql_all_users->fetch_array()) {
        echo '<option name="username" value=' . $data['username'] . '>' . $data['username'] . '</option>';
      }
    }
    ?>
    </div>
  </select><br><br>
  <input type="submit" name="submit1" value="Submit" class="button--pill">

</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['submit1'])) {
    $_SESSION['selected_user'] = $_POST['username'];
    $username = $_SESSION['selected_user'];
    print 'username: <strong>' . $username . '</strong>';
    $sql_user = $dbc->query("SELECT * FROM users WHERE username = '$username'");
    if ($sql_user->num_rows > 0) {
      $user = $sql_user->fetch_array();
      $_SESSION['user_status'] =  $user['status'];
      $_SESSION['user_admin'] = $user['admin'];
    }
  }

  if (isset($_POST['option'])) {
    $username = $_SESSION['selected_user'];
    if ($_POST['option'] === 'OPEN' || $_POST['option'] === 'LOCKED') {
      $status = $_POST['option'];
      $sql = "UPDATE users SET status = '$status' WHERE username = '$username'";
      usleep(500);
      success($dbc, $sql, $username);
    } elseif ($_POST['option'] === 'admin') {
      $sql = "UPDATE users SET admin = 'Y'WHERE username = '$username' ";
      usleep(500);
      success($dbc, $sql, $username);
    } elseif ($_POST['option'] === 'delete') {
      // delete selected user
      $sql = "DELETE FROM users WHERE username = '$username'";
      success($dbc, $sql, $username);
      usleep(3000);
      header('Location: admin.php');
    }
  }
}
function success($dbc, $sql, $username)
{
  if ($dbc->query($sql) === TRUE) {
    echo "successfully update " .$username."'s status";
  } else {
    echo "Error: " . $sql . "<br>" . $dbc->error;
  }
  $dbc->close();
}
?>
<!-- form 2 -->
<?php if (isset($_POST['submit1'])) { ?>
  <h2>Account Options: </h2>
  <form action="admin.php" method="post" class="form--inline">
    <!-- <input type="radio" name="username" value="Delete This Account" /> -->
    <input type="radio" name=option value=OPEN <? if ($_SESSION['user_status'] == 'OPEN') {
                                                  echo "Checked";
                                                } ?> />
    <label for="open">open</label><br>
    <input type="radio" name=option value=LOCKED <? if ($_SESSION['user_status'] == 'LOCKED') {
                                                    echo "Checked";
                                                  } ?> />
    <label for="locked">locked</label><br>
    <input type="radio" name=option value="admin" />
    <label for="open">Grant Administrator Role</label><br>
    <input type="radio" name=option value="delete" />
    <label for="Delete This Account">Delete This Account</label><br><br>
    <input type="submit" name="submit" value="Submit" class="button--pill">
  </form>
<?php } ?>
<?php // Return to PHP.
include('templates/footer.html'); // Include the footer.
?>