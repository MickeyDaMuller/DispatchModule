<?php
$message = "";
if(isset($_POST['submit']))
{
	if($_POST['username'] != "")
	{
		if($_POST['password'] != "")
		{
			if($_POST['username'] == "admin")
			{
				if($_POST['password'] == "iamdadm1n")
				{
					session_start();
					$_SESSION['login_webservice'] = "yes";
					header("Location: structure/index.php");
				}
				else
					$message = "Incorrect password specified";
			}
			else
				$message = "Incorrect Username specified";
		}
		else
		{
			$message = "Please fill in password field";	
		}
	}
	else
	{
		$message = "Please fill in username field";	
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login Page</title>
</head>

<body>
<div>
<iframe src="../../../banner/ibanner.htm" scrolling="no" frameborder="0" name="banner" width="100%" height="200px"></iframe>
</div>
<div style="margin-left:400px">
<p>
Login Page
</p>
<?php echo $message ?>
<form method="post" action="">
Username:<br />
<input name="username" type="text" id="username" size="30" /><br />
Password<br />
<input name="password" type="password" id="password" size="30"  /><br /><br />
<input type="submit" name="submit" id="submit" value="Login"  />
</form>
</div>
</body>
</html>