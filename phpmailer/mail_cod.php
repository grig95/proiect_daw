<?php

function sendMail($to, $message, $title)
{
  require_once('class.phpmailer.php');
  require_once('mail_config.php');


  // În caz că vreun rând depășește N caractere, trebuie să utilizăm
  // wordwrap()
  $message = wordwrap($message, 160, "<br />\n");


  $mail = new PHPMailer(true); 

  $mail->IsSMTP();

  try {
  
    $mail->SMTPDebug  = 0;                     
    $mail->SMTPAuth   = true; 

    $nume='Daw Project';

    $mail->SMTPSecure = "ssl";                 
    $mail->Host       = "smtp.gmail.com";      
    $mail->Port       = 465;                   
    $mail->Username   = $username;  			// GMAIL username
    $mail->Password   = $password;            // GMAIL password
    $mail->AddReplyTo($to, 'Daw Project');
    $mail->AddAddress($to, $nume);
  
    $mail->SetFrom($username, 'Daw Project');
    $mail->Subject = $title;
    $mail->AltBody = 'To view this post you need a compatible HTML viewer!'; 
    $mail->MsgHTML($message);
    $mail->Send();
    echo "Message Sent OK</p>\n";
  } catch (phpmailerException $e) {
    echo $e->errorMessage(); //error from PHPMailer
  } catch (Exception $e) {
    echo $e->getMessage(); //error from anything else!
  }
}

function sendPasswordChangeMail($to) 
{
  $title = "MGOS Account password change";
  $message = "Hello! Through this email we hereby notify you that your MGOS account's password has been changed. \n(PLEASE DO NOT actually take this seriously, look at the sender's email address, it's super super suspicious)";
  sendMail($to, $message, $title);
}

?>
