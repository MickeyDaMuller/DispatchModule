 <?php
 include('../link.inc.php');
 include('dispatch_functions.php');
 require("../pmailer/class.phpmailer.php");
 $queueRec = getCurrentQueue();
 if($queueRec)
 {
 	$pool_id = $queueRec['pool_id'];
	$template_id = $queueRec['template_id'];
	$status = $queueRec['status'];
	$count = $queueRec['count'];
	$target = $queueRec['target'];
	
	$template = getDispatchTemplate($template_id);
	if($template) 
	{
	 	 $subject = stripslashes($template['subject']); 
		 $message = stripslashes($template['message']);
		 echo "gotten tmplate";
		$sql = generateSQL($target, $count);
		echo "sql: ".$sql;
		
		$result = mysql_query($sql);
		if(!$result)
		die("Could not get emails- ".mysql_error());
		if(mysql_num_rows($result) == 0)
		{
		dispatchEnded($pool_id);
		echo "<br> Dispatch Ended";
		sendAdminMail("Pool Id $pool_id ($subject) has ended dispatch");
		}//end if
		else
		{
			
			$mail = new PHPMailer();
			$mail->IsSMTP();  // telling the class to use SMTP
			$mail->SMTPAuth = true;
			$mail->IsHTML(true);
			
			$mail->SetFrom('contact@globalyouthleadersforum.com', 'GYLF');
			 $mail->AddReplyTo('contact@globalyouthleadersforum.org', 'GYLF');
			$mail->Subject  = $subject;
			
			while($record = mysql_fetch_assoc($result))
			{
				$crypt_val = $record['crypt_val'];
				$email = $record['email'];
				$list_Id = $record['list_Id'];
				$to = $email;
				$extra = '<font size="1" face="Verdana, Arial, Helvetica, sans-serif">If you believe you are receiving this message in error or would no longer like to receive e-newsletters from the Global Youth Leaders Forum, <a href="http://globalyouthleadersforum.com/unsubscribe/index.php?c='.$crypt_val.'" target="_blank">please click here to unsubscribe</a>.      </font>';
				//echo "$email<br>";
				$replacetext = array("|c|", "|t|", "|v|");
				$replacementtext = array($list_Id,$template_id, $crypt_val);
				$message2 = str_replace($replacetext, $replacementtext, $message.$extra);
				
				if(check_email_address(trim($to)))
					{
					
					$mail->AddAddress($to);
					$mail->Body = $message2;
					
							if(!$mail->Send()) {
							  echo 'Message was not sent.';
							  echo 'Mailer error: ' . $mail->ErrorInfo;
							}//end if 
							else {
							  echo 'Message has been sent. ';
							}//end else
							
					echo $to."<br>";
					}
					else echo $to." (incorrect)<br>";
					
					$mail->ClearAddresses();
			}//end while
			
			$count+=50;
			updatePoolCount($pool_id, $count);
		}//end else
	}//end if
	else echo "No template found with id: $template_id";
		
}//end if	
else 
{
echo "No mails queued yet";	

}//end else
 
 ?>
	
							