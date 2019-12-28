<?php
session_start();
if(!isset($_SESSION['login_webservice']))
	{
		header("Location: login.php");	
	}


  include('../link.inc.php');
	if(isset($_GET['i']))
	{
	$pid = $_GET['i'];
	
		$sql = "DELETE from dispatch_pool where pool_id = $pid";
  
  $result = mysql_query($sql);
	  if(!$result)
	  {
	  die("Unable to delete from pool.<br><br>".mysql_error());
	  }//end if
	  
	}//end if	
 
  
	  header("Location: index.php");

 
 ?> 
 