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
		$sql = "select list_Id, email, crypt_val from contacts where unsubscribe = 0 AND updated = 1 group by email LIMIT $count, 200";	
		else
		{
		$sql = "select list_Id, email, crypt_val from contacts c left join subscriptions s using(list_Id) where c.unsubscribe = 0 AND c.updated = 1 AND s.newsletterId in ($target) group by email LIMIT $count, 200";
		}//end else
		return $sql;
	}//end fn
	
	function updateContactWelcome($welcomeId, $list_Id)
	{
	$result = mysql_query("update contacts set welcome = $welcomeId where list_Id = $list_Id");
	if(!$result)
	die(mysql_error());
	}//end fn
	
	function dispatchEnded($pool_id)
	{
	$result = mysql_query("update dispatch_pool set status = 2 where pool_id = $pool_id");
	if(!$result)
	die(mysql_error());
	}//end fn
	
	function sendAdminMail($message)
	{
	$mail = new PHPMailer();
			$mail->IsSMTP();  // telling the class to use SMTP
			$mail->SMTPAuth = true;
			$mail->IsHTML(true);
			
			$mail->SetFrom('no-reply@m.enterthehealingschool.org', 'Healing School');
			$mail->Subject  = "System message to Admin";
			$mail->AddAddress("uwemsam@gmail.com");
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
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	return false;
	
	return true;
}//end fn

 
 ?>
	
							