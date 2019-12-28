<?php

require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();  // telling the class to use SMTP
$mail->SMTPAuth = true;
$mail->Host     = "128.121.86.65"; // SMTP server
$mail->Port = 25;
$mail->Username = "christ13";
$mail->Password = "UXB0eBwA";

//$mail->From     = "from@example.com";
$mail->SetFrom('comments@enterthehealingschool.org', 'Healing School');
$mail->AddAddress("uwemsam@gmail.com");

$mail->Subject  = "New content coming up";
$mail->Body     = "I really  hope this can work fine";
$mail->WordWrap = 50;
$mail->SMTPDebug = 1;

if(!$mail->Send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}
?>