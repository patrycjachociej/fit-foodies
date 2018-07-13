<?php

session_start();

if(isset($_POST['email'])) {

    $email_to = "handel@fitfoodies.eu";
    $email_subject = "Fit Foodies - New message";
    
    $email_from = $_POST['email']; // required
    $text = $_POST['text']; // required
    $name = $_POST['name']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The email address you entered is incorrect.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";

 
  if(strlen($text) < 2) {
    $error_message .= 'The content you entered is not valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Message details:\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    
    $email_message .= "From (E-mail): ".clean_string($email_from)."\n";
    $email_message .= "From (name): ".clean_string($name)."\n";
    $email_message .= "Message: ".clean_string($text)."\n";

    
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
     
mail($email_to, $email_subject, $email_message, $headers) or die ("Failure"); 

$_SESSION["wyslano"]="1";

header("Location: /en.php#kontakt");
?>
 
<!-- include your own success html here -->
 


 
<?php
 
}
?>