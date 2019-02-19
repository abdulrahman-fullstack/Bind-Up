<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

//Import PHPMailer classes into the global namespace
// use PHPMailer\PHPMailer\PHPMailer;

// require './vendor/autoload.php';

// //Create a new PHPMailer instance
// $mail = new PHPMailer;

// //Tell PHPMailer to use SMTP
// $mail->isSMTP();

// //Enable SMTP debugging
// // 0 = off (for production use)
// // 1 = client messages
// // 2 = client and server messages
// $mail->SMTPDebug = 2;

// //Set the hostname of the mail server
// $mail->Host = 'smtp.gmail.com';
// // use
// // $mail->Host = gethostbyname('smtp.gmail.com');
// // if your network does not support SMTP over IPv6

// //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
// $mail->Port = 25;

// //Set the encryption system to use - ssl (deprecated) or tls
// $mail->SMTPSecure = 'tls';

// //Whether to use SMTP authentication
// // $mail->SMTPAuth = true;

// //Username to use for SMTP authentication - use full email address for gmail
// $mail->Username = "abdulrahman21820@gmail.com";

// //Password to use for SMTP authentication
// $mail->Password = "21827250";

// //Set who the message is to be sent from
// $mail->setFrom('abdulrahman21820@gmail.com', 'Abdul Rahman');

// //Set an alternative reply-to address
// $mail->addReplyTo('abdulrahman21820@gmail.com', 'Reply Me');

// //Set who the message is to be sent to
// $mail->addAddress('rahmanabdul9094@gmail.com', 'Abdul Rahman');

// //Set the subject line
// $mail->Subject = 'Hey this is my first mail try it should work ';

// //Read an HTML message body from an external file, convert referenced images to embedded,
// //convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);

// //Replace the plain text body with one created manually
// $mail->AltBody = 'No plain text';

// //Attach an image file
// // $mail->addAttachment('sample.png');

// //send the message, check for errors
// if (!$mail->send()) {
//     echo "Mailer Error: " . $mail->ErrorInfo;
// } else {
//     echo "Message sent!";
//     //Section 2: IMAP
//     //Uncomment these to save your message in the 'Sent Mail' folder.
//     #if (save_mail($mail)) {
//     #    echo "Message saved!";
//     #}
// }

// //Section 2: IMAP
// //IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
// //Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
// //You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
// //be useful if you are trying to get this working on a non-Gmail IMAP server.
// function save_mail($mail)
// {
//     //You can change 'Sent Mail' to any other folder or tag
//     $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

//     //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
//     $imapStream = imap_open($path, $mail->Username, $mail->Password);

//     $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
//     imap_close($imapStream);

//     return $result;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mailing</title>
</head>
<body>
    <form action="" method="post">
        <p><input type="email" name="email" placeholder="Email"></p>
        <p><input type="submit" name="mail_sbmt"></p>
    </form>
</body>
</html>

<?php
echo date_default_timezone_set("");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require './vendor/autoload.php';

if(isset($_POST['mail_sbmt'])){

$email_to = $_POST['email'];
// echo "<script>alert('hey its working')</script>";

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.mail.yahoo.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'abdulrahman21820@yahoo.com';       // SMTP username
    $mail->Password = 'gmail21827250';                         // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('abdulrahman21820@yahoo.com' , 'Abdul Developer');
    $mail->addAddress($email_to, 'Abdul Rahman');               // Add a recipient
    // $mail->addAddress('ellen@example.com');                  // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    // $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Welcome to BindUp';
    // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()){
    echo "<script>alert('Message could not be sent. Mailer Error: ". $mail->ErrorInfo."')</script>";
}
else{
    echo "<script>alert('Message has been sent')</script>";
}
}
?>