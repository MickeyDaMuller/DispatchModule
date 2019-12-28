<?php
if(!isset($_GET['c']))
{
header("Refresh: 3; url= http://www.globalyouthleadersforum.org");
die("Redirecting to the Global Youth Leaders' Forum...");

}//end if
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Global Youth Leaders' Forum Unsubscribe Form</title>
<style type="text/css">
<!--

#main {
width: 1056px;
}
.style1 {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 12px;
    color:#FFFFFF;
}
#thetitle {
padding: 5px;
border:dotted;
border-color:#0354ae;
background-color:#0354ae;
margin-top: 5px;
margin-bottom: 5px;
font-weight:600;
}
#theForm {
font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 12px;
    
}
#subtitle {
padding: 2px;
padding-left: 7px;
border:thin;
border-color:#666666;
background-color:#094A80;
margin-top: 5px;
margin-bottom: 15px;
font-weight:600;
}
-->
</style>
<script language="javascript" src="calendar/cal2.js">
/*
Xin's Popup calendar script-  Xin Yang (http://www.yxscripts.com/)
Script featured on/available at http://www.dynamicdrive.com/
This notice must stay intact for use
*/
</script>
<script language="javascript" src="calendar/cal_conf2.js"></script>

<body>
<div id="main">
<center><p><img style="background: #094A80;" src="http://globalyouthleadersforum.org/assets/image/gylfheadlogo.png" /></p></center>
<div id="thetitle">
    <span class="style1"> </span>
  </div>
    <div id="subtitle">
    <span class="style1"></span>
  </div>
    <div id="theForm">
    
    <h1 align="center" class="pageTitle">Global Youth Leaders' Forum Newsletter</h1>
                
        <?php
        if(isset($_POST['c']))
        {
          function updateUnsubscribe($crypt)
          {
          $result = mysql_query("update contacts set unsubscribe = '1' where crypt_val = '".$crypt."'");

          //echo $result;
          
          if(!$result)
          echo("Unable to unsubscribe");
          
          }//end updateUnsubscribe
          
          include('link.inc.php');
          updateUnsubscribe($_POST['c']);
          echo "<br>You have successfully unsubscribed from our mailing list";
        }//end if
        
        else
        {
        ?>
        
        <p>
        <div align="justify"><span >If you do not wish to
                    receive any further mail from us then please click the unsubscribe 
                    button and your email address will be removed from our mailing list.</span></div>
        </p>
            <p>
        <center><form id="form1" name="form1" method="post" action="">
        <input type="hidden" name="c" id="c" value = "<?php echo $_GET['c'] ?>"/>
        <input  name="Submit" type="submit" class="style25" value="Unsubscribe me" />
        </form></center>
        </p>
        <?php
        }//end else
        ?>
    <br /><br />
    
           
  </div>
</div>
</body>
</html>