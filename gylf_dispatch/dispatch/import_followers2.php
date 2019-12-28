<?php
set_time_limit(360000);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Import CSV</title>
</head>

<body class="style2">
<div class="style1">Import CSV </div>
<br />
<?php
if(!isset($_FILES["file"]))
{
die("Kindly fill <a href='import_followers.php'>form 1</a> first. <br> Thanks.");
}//end if

function insert_contacts($title, $firstname, $lastname, $email, $phone, $country)
	 {
	 $result = mysql_query("INSERT INTO contacts(title, firstname, lastname, email, phone, country) VALUES ('$title', '$firstname', '$lastname', '$email', '$phone', '$country') ON DUPLICATE KEY UPDATE timestamp = now()");	 

		if(!$result)
		die(mysql_error());
		$insert_id = mysql_insert_id();
		return $insert_id;
	 }//end fn
	 
	 function update_crypt_val($list_Id)
	 {
	 $crypt = crypt($list_Id, "contacts");
	 
	 $result = mysql_query("UPDATE contacts set crypt_val = '$crypt' WHERE list_Id = $list_Id");	 

		if(!$result)
		die("error updating crypt($list_Id)".mysql_error());
	 }//end fn
	 
	  function update_member_move($memberId)
	 {
	 
	 
	 $result = mysql_query("UPDATE student_management.prayer_network set moved = 1 WHERE network_id = $memberId");	 

		if(!$result)
		die("Error updating salvation move($memberId) ".mysql_error());
	 }//end fn
	 
	 function get_contact_id($email)
	 {
		 
	 $result = mysql_query("select list_Id from contacts where email = '$email'");	 

		if(!$result)
		die("error getting contact id ($email)".mysql_error());
		
		$record = mysql_fetch_assoc($result);
		return $record['list_Id'];
	 }//end fn
	 
	 
	 function add_subscription($list_Id, $newsletterId)
	 {
	 $result = mysql_query("INSERT INTO subscriptions(list_Id, newsletterId) values ($list_Id, $newsletterId) ON DUPLICATE KEY UPDATE timestamp = now()");	 

		if(!$result)
		die("error adding subscription($list_Id, $newsletterId) ".mysql_error());
	 }//end fn

//$date = date("Ymd");

if((!empty($_FILES["file"])) && ($_FILES['file']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
			
	$filename = basename($_FILES['file']['name']);
  //echo $filename;
  $fname = substr($filename, 0, strrpos($filename, '.'));
  $defname = $date."nm";
  $ext = strtolower(substr($filename, strrpos($filename,'.')));
  //echo "ext: ".$ext."<br>";
  if($ext != ".csv" )
  {
  die("The file you uploaded is not a valid comma separated value(.csv) file. Please click the back button to re-try sending it");
  }//end if
	
	$filename = $defname.$ext;
	$newname = dirname(__FILE__).'/csv/'.$filename;
	$counter = 1;
	//Check if the file with the same name is already exists on the server
	while(file_exists($newname))
	{
	$counter = $counter+1;
	$def = $defname.$counter;
	$filename = $def.$ext;
	$newname = dirname(__FILE__).'/csv/'.$filename;
	}
	
		if (!file_exists($newname)) {
		//Attempt to move the uploaded file to it's new place
		if ((move_uploaded_file($_FILES['file']['tmp_name'],$newname))) {
		  // echo "The file has been saved as: ".$newname."<br>";
				}//end if	
					 else {
					   echo "Could not save excel file in upload folder";
					   die();
					}//end else
		}//end if
		else {
		 echo "Error: File ".$_FILES["file"]["name"]." already exists";
		 die();
		}//end else
	
	} else {
 die('Excel file was not selected. Click the back button and try again');
 
}//end else



$theFile = file_get_contents('csv/'.$filename);
$lines = array();
$new = array();
$lines = explode("\n", $theFile);
$lineCount = count($lines);



include('../link.inc.php');

$newsletterId = 1;
$count = 1;
$category = $_POST['category'];

foreach($lines as $row)
{

$data = explode(",", $row);

	$title = addslashes(trim($data[0]));
	$firstname =  addslashes(trim($data[1]));
	$lastname = addslashes(trim($data[2]));
	$email = addslashes(trim($data[3]));
	$country = addslashes(trim($data[4]));
	$phone = addslashes(trim($data[5]));
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
  echo "E-mail ($email) is not valid<br>";
  continue;
  }
	
	$list_Id = insert_contacts($title, $firstname, $lastname, $email, $phone, $country);
echo "<br>$count) $list_Id- ($email)";

if ($list_Id == 0 || !$list_Id)
{
$list_Id = get_contact_id($email);
echo " $email exists already ($list_Id)";
}//end if

	update_crypt_val($list_Id);
	add_subscription($list_Id, $newsletterId);
	add_subscription($list_Id, $category);
	//update_member_move($memberId);	
		
		
	
	
	$count++;
	}//end foreach
		
?>


  

</body>
</html>
