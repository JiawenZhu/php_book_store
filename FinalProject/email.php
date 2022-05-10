<?php // Script 8.4 - index.php
/* This is the home page for this site. 
It uses templates to create the layout. */

// Include the header:
include('userlogin_check.php');
// Leave the PHP section to display lots of HTML:
?>
<?php
require 'phpmailer/PHPMailerAutoload.php';
?>

<h1>Email Form</h1>
<form class="ui form" action="email.php" method="post">
    <div class="field">
        <label>My Email</label>
        <input type="text" name="email" required>
    </div>
    <div class="field">
        <label>Subject</label>
        <input type="text" name="subject" required>
    </div>
    <br />
    <div class="field">
        <label>Messages: </label>
        <textarea name="notes" cols="25" rows="10" placeholder="start your notes here"></textarea>
    </div>
    <input type="submit" name="submit" value="Submit" />
</form>

<?php
/* for Gmail use the following settings
 * Host: smtp.gmail.com
 * Port: 465
 * for Yahoo use the following settings
 * Host: smtp.mail.yahoo.com
 * Port: 465
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPDebug;   // debug set to 1, 2, or 3 to show more or less details for error messages

    $mail->Host = 'smtp.gmail.com';       // host name for email service                              
    $mail->Username = 'zhujiawen519@gmail.com'; 
    // username for email account you can have the @ extension or leave it off                  
    $mail->Password = 'zhujiawen519*8997290';                 // password for email account
    $mail->Sender = 'zhujiawen519@gmail.com';                   // Email address of the sending email
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->addAddress = $_POST['email'];                // Add a recipient
    $email = $_POST['email'];
    $mail->FromName = 'Chris';            // the name you want to appear
    $mail->Subject = $_POST['subject'];              // Subject
    $mail->Body    = $_POST['notes'];           // Message
    print $mail->SMTPDebug;

    if (!$mail->send()) {
        print '<h3 style="color: red;">ERROR! Unable to send Email<h3>';
    } else {
        print '<h3 style="color: green;">Email Sent Successfully</h3>';
    }
}
