<?php
function spamcheck($field)
  {
  // Sanitize e-mail address
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);
  // Validate e-mail address
  if(filter_var($field, FILTER_VALIDATE_EMAIL))
    {
    return TRUE;
    }
  else
    {
    return FALSE;
    }
  }

function debug_to_console($data) {
if(is_array($data) || is_object($data))
{
echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
} else {
echo("<script>console.log('PHP: ".$data."');</script>");
}
}
// display form if user has not clicked submit

  // Check if the "from" input field is filled out
  if (isset($_POST["email"]))
    {
    // Check if "from" email address is valid
    $mailcheck = spamcheck($_POST["email"]);
    if ($mailcheck==FALSE)
      {
      debug_to_console("Invalid input");
      }
    else
      {
      $from = $_POST["email"]; // sender
      $name = $_POST["name"];
      $message = $_POST["message"];
      // message lines should not exceed 70 characters (PHP rule), so wrap it
      $message = wordwrap($message, 70);
      $headers = 'From: your@email.com' . "\r\n" . //This helps with a weird bug with gmail. Makes the email they enter in become the reply to.
    'Reply-To:'. $from . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
      // send mail
      mail("your@email.com","$name - Contact Form Submission",$message,$headers);
      debug_to_console("Sent Message");
      }
    }
?>