<?php
if(isset($_POST['email'])) {

    $email_to = "handel@fitfoodies.eu";
    $email_subject = "Fit Foodies - Nowa wiadomość";
 
    if( !isset($_POST['email']) ||
        !isset($_POST['text']) ) {
        died('Wypełniony formularz zawiera błędy. Popraw je.');       
    }
 
    
    $email_from = $_POST['email']; // required
    $text = $_POST['text']; // required
    $name = $_POST['name']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Wpisany adres e-mail jest niepoprawny.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";

 
  if(strlen($text) < 2) {
    $error_message .= 'Wpisana treść nie jest poprawna.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Szczegóły wiadomości:\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    
    $email_message .= "Od (E-mail): ".clean_string($email_from)."\n";
    $email_message .= "Od (imię): ".clean_string($name)."\n";
    $email_message .= "Treść: ".clean_string($text)."\n";

    
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
     
mail($email_to, $email_subject, $email_message, $headers) or die ("Failure"); 
    
session_start();

$_SESSION["wyslano"]="Dziękujemy za kontakt. Wiadomość została wysłana. Odpowiedź otrzymasz najszybciej jak to możliwe.";

header("Location: index.php#kontakt");
?>
 
<!-- include your own success html here -->
 


 
<?php
 
}
?>