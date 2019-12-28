<?php
session_start();
if(!isset($_SESSION['login_webservice']))
	{
		header("Location: login.php");	
	}
?>
<!DOCTYPE HTML>
<!--
	Striped 2.5 by HTML5 Up!
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Dispatch Page</title>
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
	</head>
	<!--
		Note: Set the body element's class to "left-sidebar" to position the sidebar on the left.
		Set it to "right-sidebar" to, you guessed it, position it on the right.
	-->
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
										<h2><a href="#"> Dispatch Page </a></h2>
										<span class="byline">Dispatch window </span>
									</header>
									<div class="info">
										<!--
											Note: The date should be formatted exactly as it's shown below. In particular, the
											"least significant" characters of the month should be encapsulated in a <span>
											element to denote what gets dropped in 1200px mode (eg. the "uary" in "January").
											Oh, and if you don't need a date for a particular page or post you can simply delete
											the entire "date" element.
											
										-->
										<span class="date"><span class="month"><?php echo date('m'); ?><span></span></span> <span class="day"><?php echo date('d'); ?></span><span class="year">, 2013</span></span>
										<!--
											Note: You can change the number of list items in "s(tats" to whatever you want.
										-->
										
									</div>
									
									
									
									<div class="license-form">
  
  <?php
 
  function is_dispatch_on()
  {
  $result = mysql_query("select pool_id from dispatch_pool where status = 1");
	if(!$result)
	die(mysql_error());
	if(mysql_num_rows($result) == 0)
	return false;
	else
	return true;
  }//end fn
  
  function edit_status($pool_id, $status)
  {
  $result = mysql_query("update dispatch_pool set status = $status where pool_id = $pool_id");
	if(!$result)
	die(mysql_error());
	echo "Edit status was successful";
	
  }//end fn
  
  function get_audience_count($target)
  {
  $sql = "select count(list_Id) as list_count from contacts c left join subscriptions s using(list_Id) where c.unsubscribe = 0 AND c.updated = 1 AND s.newsletterId in ($target) group by email ";
  $result = mysql_query($sql);
	if(!$result)
	die("could not get count <br>");
	$record = mysql_fetch_assoc($result);
	//echo "res count: ".$record['list_count'];
	return $record['list_count'];
	
  }//end fn

  include('../link.inc.php');
	if(isset($_GET['i']))
	{
	$pid = $_GET['i'];
	$param = $_GET['p'];
		
		if($param == 0)
		edit_status($pid, $param);
		
		if($param == 1)
		{
			if(!is_dispatch_on())
			edit_status($pid, $param);
			else echo "You need to stop the current dispatch before starting another. ";
		}//end if
		
		
	}//end if	
 
  $sql = "SELECT p.*, t.subject from dispatch_pool p left join dispatch_templates t using (template_id) order by p.status, t.date  desc LIMIT 0,10";
  
  $result = mysql_query($sql);
	  if(!$result)
	  {
	  die("Unable to get records.<br><br>".mysql_error());
	  }//end if
	  
	  

 
 ?> 
 <table id="rounded-corner" summary="Ministers' data">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company">S/N</th>
			
            <th scope="col" class="rounded-q1">Subject</th>
           
			<th scope="col" class="rounded-q5">Status</th>
			<th scope="col" class="rounded-q6">Dispatch Count</th>
			<th scope="col" class="rounded-q7">Audience Count</th>
			<th scope="col" class="rounded-q4">Action</th>
			
        </tr>
		
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="5" class="rounded-foot-left"><em>Dispatch Pool</em></td>
        	<td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>
    <tbody>
    	
		
		<?php
		$counter = 1;
		while($record = mysql_fetch_assoc($result))
		{
		
		
		$status = $record['status'];
		$pool_id = $record['pool_id'];
			switch ($status)
			{
				case 1:
				$action_param = "0";
				$action_text = "Stop";
				$status_text = "Dispatching...";
				break;
				
				case 0:
				$action_param = "1";
				$action_text = "Start";
				$status_text = "Queued for dispatch";
				break;
				
				case 2:
				$action_param = "-";
				$action_text = "";
				$status_text = "Finished Dispatch";
				break;
				
				default:
				$action_param = "";
				$action_text = "";
				$status_text = "";
				break;
			}//end case
		?>
		<tr>
        	<td><?php echo $counter; ?></td>
			<td><?php echo $record['subject']; ?></td>
            <td><?php echo $status_text ?></td>
            <td><?php echo $record['count']; ?></td>
           	<td><?php echo "-";//get_audience_count($record['target']); ?></td>
            
            <td><a href="index.php?i=<?php echo $pool_id; ?>&p=<?php echo $action_param; ?>"><?php echo $action_text; ?></a><br>
            <a href="pool_del.php?i=<?php echo $pool_id; ?>">Delete</a>
</td>
			
        </tr>
		<?php
		$counter++;
		}//end while
		?>
      
    </tbody>
</table></div>
									
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
									<li class="current_page_item"><a href="index.php">Home</a></li>
									<li><a href="newsletters.php">Archives</a></li>
									<li><a href="subscriptions.php">Subscriptions</a></li>
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
									&copy; 2016 Dispatch<br />
									
								</p>
							</div>

					</div>

			</div>

	</body>
</html>