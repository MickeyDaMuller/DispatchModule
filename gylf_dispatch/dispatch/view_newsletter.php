<?php
session_start();
if(!isset($_SESSION['login_webservice']))
	{
		header("Location: login.php");	
	}
?>

  
  <?php
 
  
	if(!isset($_GET['n']))
	die("Kindly <a href='newsletters.php'>select</a> a template");
  include('../link.inc.php');
	
 	$template_id = $_GET['n'];
  $sql = "SELECT * from dispatch_templates where template_id = $template_id";
  
  $result = mysql_query($sql);
	  if(!$result)
	  {
	  die("Unable to get records.<br><br>".mysql_error());
	  }//end if
	  
	 $record = mysql_fetch_assoc($result);
	 $subject = $record['subject']; 
	 $message = stripslashes($record['message']);
	 $dispatch_date = $record['dispatch_date'];
	 $date_added = $record['date'];

 
 ?>
  <a href="index.php">Home</a> | <a href="newsletters.php">Newsletters</a> <br>
  <br> 
 <div>
 <strong>Template Subject</strong>: <?php echo $subject; ?> (added on <?php echo $date_added ?>)
 <br>
 <br>
 <strong>Message</strong>:<br>
 <?php echo $message ?>
 </div>					
 <br>
 <a href="add_pool.php?tid=<?php echo $template_id ?>"> Send for Dispatch </a>		
							