 <?php
 include('../../link.inc.php');
 include('dispatch_functions.php');
 require("../../pmailer/class.phpmailer.php");
 

	$template_id = 105;
	$welcomeId = 3;
	
	$template = getDispatchTemplate($template_id);
	if($template) 
	{
	 	 $subject = $template['subject']; 
		 $message = stripslashes($template['message']);
		 //echo "gotten tmplate: <br> $subject <br> $message<br>";
		$sql = "select list_Id, email, crypt_val from contacts where welcome = 2 AND unsubscribe= 0  LIMIT 0, 400";
		//echo "sql: ".$sql;
		
		$result = mysql_query($sql);
		if(!$result)
		die("Could not get emails- ".mysql_error());
		if(mysql_num_rows($result) == 0)
		{
		//dispatchEnded($pool_id);
		echo "<br> Dispatch Ended";
		//sendAdminMail("Pool Id $pool_id ($subject) has ended dispatch");
		}//end if
		else
		{
			
			$mail = new PHPMailer();
			$mail->IsSMTP();  // telling the class to use SMTP
			$mail->SMTPAuth = true;
			$mail->IsHTML(true);
			
			$mail->SetFrom('no-reply@m.enterthehealingschool.org', 'Healing School');
			$mail->Subject  = $subject;
			
			while($record = mysql_fetch_assoc($result))
			{
				$crypt_val = $record['crypt_val'];
				$email = $record['email'];
				$list_Id = $record['list_Id'];
				$to = $email;
				$extra = '<font size="1" face="Verdana, Arial, Helvetica, sans-serif">If you believe you are receiving this message in error or would no longer like to receive e-newsletters from the Healing School, <a href="http://m.enterthehealingschool.org/unsubscribe/index.php?c='.$crypt_val.'" target="_blank">please click here to unsubscribe</a>.      </font>';
				//echo "$email<br>";
				$replacetext = array("|c|", "|t|");
				$replacementtext = array($list_Id,$template_id);
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
					
					
					updateContactWelcome($welcomeId, $list_Id);
			}//end while
			
			//$count+=200;
			
		}//end else
	}//end if
	else echo "No template found with id: $template_id";
		

 ?>
	
							