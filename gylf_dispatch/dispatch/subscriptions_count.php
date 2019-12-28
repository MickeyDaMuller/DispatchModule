<?php
session_start();
if(!isset($_SESSION['login_webservice']))
	{
		header("Location: login.php");	
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><script src="selectcustomer.js"></script>
<title>admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {color: #000066}
.style25 {
	font-size: 15px;
	color: #000066;
	background-color: #F0F0F0;
	border: thin solid #999999;
	cursor: hand;
}
.style45 {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style47 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style></head>

<body>

  <div align="center">
    <table width="774" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="766" height="491" valign="top"><div align="center"><br>
          <span class="style1"><strong>DATABASE SUBSCRIPTIONS<br>
          </strong></span></div>
          
  <form name="form2" method="post" action="approve.php">
    <div align="center"><span class="style45">     
    </span><br>
    <br>
      <?php

		function getCount($newsletterId)
		{
		$sql = "SELECT count(list_id) as list_count from subscriptions where newsletterId = '$newsletterId'";
		//echo "$sql <br>";
		$result = mysql_query($sql);
		if(!$result)
		echo mysql_error();
		else
		$result_count = mysql_fetch_assoc($result);
		return $result_count['list_count'];
		}

	
		
		//echo "<br>inserpt: ".$inserpt."<br>";
		$query_school = "SELECT newsletterId, newsletter_name from newsletters";
		
		//echo $query_school;

		$table_name = $query_school;
		
		
		require_once('../link.inc.php');
			//$result = mysql_query("select * from $table_name");
			$result = mysql_query($table_name);
			if (!$result) {
  			 print "Error in sql statement";
  			 die('Query failed: ' . mysql_error());
			}//end if
				
				else 
				{
				
			
				echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" bgcolor= \"#F4FFEA\">"; 
				
				$i = 0;
				echo "<tr>";
				
				echo "<td width = \"60\" class=\"style44\"><b>Source</b></td>";				
				echo "<td width = \"60\" class=\"style44\"><b>Count</b></td>";
				echo "</tr>";
				$count = 0;
				$total_count = 0;
					while (($record = mysql_fetch_assoc($result))) {
					echo "<tr>"; 
					
						echo "<td width = \"60\" class=\"style44\">"; 
						$newsletter_name = $record['newsletter_name'];
						$newsletterId = $record['newsletterId'];
						echo $newsletter_name;
						echo "</td>";
						echo "<td width = \"60\" class=\"style44\">"; 
						//$the_count = getCount($country, $conf_session_tag);
						$the_count = getCount($newsletterId);
						echo $the_count;
						echo "</td>";
						
					echo "</tr>";
					// an extra linebreak to split up the rows
								$count++;	
								$total_count += $the_count;	
					}//end while
					echo "<tr> <td width = \"60\" class=\"style44\">Total </td> <td width = \"60\" class=\"style44\">$total_count </td> </tr>"; 
					mysql_free_result($result);
					echo "</table>";
				}//end else
			
			
			
			echo "<br><br>";
			//echo "<br>inserpt: ".$inserpt."<br>";
		
		
?>
      <br>
      
    </div>
  </form></td>
      </tr>
    </table>
  </div>
</body>
</html>
