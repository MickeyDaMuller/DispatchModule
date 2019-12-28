<?php
session_start();
if(!isset($_SESSION['login_webservice']))
	{
		header("Location: login.php");	
	}
	require_once('../link.inc.php');
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Subscriptions</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="css/ie7.css" /><![endif]-->
		<style type="text/css">
<!--
@import url("style.css");
-->
</style>
<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script>
    $(function() {
        $( "#tabs" ).tabs({
            beforeLoad: function( event, ui ) {
			ui.panel.html("<img src='/images/loading.GIF' alt='loading...' />");
                ui.jqXHR.error(function() {
                    ui.panel.html(
                        "Couldn't load this tab. We'll try to fix this as soon as possible. Kindly check your internet connection also" );
                });
            }
        });
    });
    </script>
	</head>
	
	<body class="left-sidebar">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Content -->
					<div id="content">
						<div id="content-inner">
					
							<!-- Post -->
								<article class="is-post is-post-excerpt">
									<header>
										<!--
											Note: Titles and bylines will wrap automatically when necessary, so don't worry
											if they get too long. You can also remove the "byline" span entirely if you don't
											need a byline.
										-->
										<h2><a href="#">Global Youth Leaders Forum Dispatch Page </a></h2>
										<span class="byline">Newsletter Subscriptions </span></header>
									<div class="info">
										
										<span class="date"><span class="month"><?php echo date('m'); ?><span></span></span> <span class="day"><?php echo date('d'); ?></span><span class="year">, 2013</span></span>
										<!--
											Note: You can change the number of list items in "s(tats" to whatever you want.
										-->
										
									</div>
									
									
									<div class="license-form">
                                    
                                     <div class="style1"><strong><?php echo $site_short ?> 
          </strong><br><br>

          <a href="manage_newsletters.php">Manage groups</a>	
          </div> 
<br>

 <div class="style1"><strong>GLOBAL YOUTH LEADERS FORUM DATABASE <br>
          FIGURES
          </strong><br>
          </div> 
          <?php 
 

function getBatchCount($batch_date, $conf_session_tag)
{
$sql = "select m.firstname from  hs_registration r  left join hs_members m using (memberId) where r.status4 = '$conf_session_tag' and r.arrival = '$batch_date' ";
//echo "<br>sql: $sql";
$result = mysql_query($sql);
if(!$result)
die("could not get registration date count: ".mysql_error());

$record = mysql_num_rows($result);
return $record;
}//end fn





$sql = "select count(list_Id) as list_count from contacts ";
$result = mysql_query($sql);
if(!$result)
die("could not get contact figures: ".mysql_error());

$batches_report = "<table border='1'>";
$total_reg = 0;

$batches_report .= "<tr>
            <td><b>Source</b></td>
            <td><b>Count</b></td>
          </tr>";

 $records = mysql_fetch_assoc($result);
$count = $records['list_count'];

$batches_report .= "<tr>
            <td>Total database count</td>
            <td>$count</td>
          </tr> ";

$batches_report .= "</table>";
?><br>
         <br>
 

          <br>
          </span>
        </div></td>
      </tr>
      <tr>
        <td height="412" valign="top">
		<div id="tabs">
    <ul>
        <li><a href="#tabs-1">General Figure</a></li>
        <li><a href="subscriptions_count.php">Subscriptions</a></li>
		
        
    </ul>
    <div id="tabs-1">
        
        <p><div><?php echo $batches_report; ?><div></p>
    </div>
</div></div>
								
									
								</article>
						
							<!-- Post -->
								

							<!-- Pager -->
								

						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
					
						<!-- Logo -->
							<div id="logo">
								<h1>GYLF DP</h1>
							</div>
					
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li ><a href="index.php">Home</a></li>
									<li><a href="newsletters.php">Archives</a></li>
									<li class="current_page_item"><a href="subscriptions.php">Subscriptions</a></li>
									<li><a href="subscribers.php">Subscribers</a></li>
									<li><a href="logout.php">Logout</a></li>
								</ul>
							</nav>

						<!-- Search -->
							<section class="is-search">
								<form method="post" action="search.php">
									<input type="text" class="text" name="search" placeholder="Search" />
								</form>
							</section>
					
						
					
						<!-- Recent Posts -->
							
					
						<!-- Recent Comments -->
							
					
						<!-- Calendar -->
							
						
						<!-- Copyright -->
							<div id="copyright">
								<p>
									&copy; 2018 Global Youth Leaders Forum<br />
									
								</p>
							</div>

					</div>

			</div>

	</body>
</html>