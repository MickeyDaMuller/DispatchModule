 <?php
 


	function getCurrentQueue()
	{
	$result = mysql_query("select * from dispatch_pool where status = 1");
	if(!$result)
	die(mysql_error());
	$record = mysql_fetch_assoc($result);
	return $record;
	
	}//end fn	
	
	function getDispatchTemplate($template_id)
	{
	$sql = "SELECT * from dispatch_templates t where template_id = $template_id";
  
  	$result = mysql_query($sql);
	if(!$result)
	  {
	  die("Unable to get dispatch template.<br><br>".mysql_error());
	  }//end if
	$record = mysql_fetch_assoc($result);
	return $record;
	}//end fn	
	
	function generateSQL($target, $count)
	{
	$sql = "";
	if($target == '*')
		$sql = "select list_Id, email, crypt_val from contacts where unsubscribe = 0 AND valid = 0 group by email LIMIT $count, 200";	
		else
		{
		$sql = "select list_Id, email, crypt_val from contacts c left join subscriptions s using(list_Id) where c.unsubscribe = 0 AND c.valid = 0 AND s.newsletterId in ($target) group by email LIMIT $count, 50";
		}//end else
		return $sql;
	}//end fn
	
	function updatePoolCount($pool_id, $count)
	{
	$result = mysql_query("update dispatch_pool set count = $count where pool_id = $pool_id");
	if(!$result)
	die(mysql_error());
	}//end fn
	
	function dispatchEnded($pool_id)
	{
	$sql = "update dispatch_pool set status = 2 where pool_id = $pool_id";
	echo "<br> dispatchEnded: $sql <br>";
	$result = mysql_query($sql);
	if(!$result)
	die(mysql_error());
	}//end fn
	
	function sendAdminMail($message)
	{
	$mail = new PHPMailer();
			$mail->IsSMTP();  // telling the class to use SMTP
			$mail->SMTPAuth = true;
			$mail->IsHTML(true);
			
			$mail->SetFrom('noreply@healthandinspirationmagazine.com', 'Healing & Inspiration');
			$mail->Subject  = "System message to Admin";
			$mail->AddAddress("Juliefoster23@mail.com");
					$mail->Body = $message;
					
							if(!$mail->Send()) {
							  echo 'Message was not sent.';
							  echo 'Mailer error: ' . $mail->ErrorInfo;
							}//end if 
							else {
							  echo 'Message has been sent. ';
							}//end else
			$mail->ClearAddresses();
	}//end fn
	
	
	function check_email_address($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
?'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
?([A-Za-z0-9]+))$",
$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}//end fn

 
 ?>
	
							