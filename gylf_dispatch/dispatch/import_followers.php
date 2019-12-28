<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.heading{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
	background:#003366;
	border: thin #999999;
	padding:10px;
}
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; font-weight: bold; background: #003366; border: thin #999999; color: #FFFFFF; }
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>

<body class="style2">
<div class="style1">Import CSV </div>
<br />
<?php
include('../link.inc.php');

function get_newsletters()
	{
	$recs = array();
	$result = mysql_query("select newsletter_name, newsletterId from newsletters");
	if(!$result)
	die(mysql_error());
	while($records = mysql_fetch_assoc($result))
	$recs[] = $records;
	return $recs;
	
	}//end fn
	
	$newsletters = get_newsletters();
	
	

?>
<br />
<form action="import_followers2.php" method="post" enctype="multipart/form-data" name="f" class="style2" id="f" >
Category: 
<label for="category"></label>
<select name="category" id="category">
  
  <?php
	foreach($newsletters as $newsletter)
	{
	$sel = ($newsletterId == $newsletter['newsletterId'])? 'selected="selected"' : "";
	
	echo "<option value=\"".$newsletter['newsletterId']."\" $sel>".$newsletter['newsletter_name']."</option>";
	}//end foreach
	?>
  
</select>
<br />
  <br />
  CSV File(Must follow this order of columns: <b>title, firstname, lastname, email, country, phone</b>): 
  <input type="file" name="file" />
        <br />
        <br />
       
      <input type="submit" name="Submit" value="Submit" />
</form>  
<br />
</body>
</html>
