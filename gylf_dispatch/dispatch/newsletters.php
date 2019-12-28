<?php
session_start();
if(!isset($_SESSION['login_webservice']))
	{
		header("Location: login.php");	
	}
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Archives</title>
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
<link href="pagination/css/pagination.css" rel="stylesheet" type="text/css" />
	<link href="pagination/css/grey.css" rel="stylesheet" type="text/css" />
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
										<span class="byline">Newsletter Templates </span>
									</header>
									<div class="info">
										
										<span class="date"><span class="month"><?php echo date('m'); ?><span></span></span> <span class="day"><?php echo date('d'); ?></span><span class="year">, 2013</span></span>
										<!--
											Note: You can change the number of list items in "s(tats" to whatever you want.
										-->
										
									</div>
									
									
									<div class="license-form">
  <?php
 include('../link.inc.php');
 include_once ('pagination/function.php');

    	$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 5;
    	$startpoint = ($page * $limit) - $limit;
        
        //to make pagination
        $statement = "SELECT COUNT(*) as `num` from dispatch_templates";

 
  $sql = "SELECT * from dispatch_templates  order by date desc LIMIT {$startpoint} , {$limit}";
 // echo $sql;
  $result = mysql_query($sql);
	  if(!$result)
	  {
	  die("Unable to get records.<br><br>".mysql_error());
	  }//end if
	  
	  function getDispatchCount($template_id)
	  {
	  		 $sql = "SELECT count(template_id) as temp_count from dispatch_response where template_id = $template_id";
 // echo $sql;
		  $result = mysql_query($sql);
			  if(!$result)
			  {
			  die("Unable to get records.<br><br>".mysql_error());
			  }//end if
			  
			  $record = mysql_fetch_assoc($result);
			  return $record['temp_count'];
	  }//end fn
	  
		
 
 ?> 
 <table id="rounded-corner" summary="Ministers' data">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company">S/N</th>
			<th scope="col" class="rounded-q1">Newsletter Category</th>
            <th scope="col" class="rounded-q1">Subject</th>
           
            <th scope="col" class="rounded-q3">Dispatch Date</th>
            <th scope="col" class="rounded-q9">Dispatch Time</th>
			<th scope="col" class="rounded-q5">Status</th>
			<th scope="col" class="rounded-q6">Clicks</th>
			<th scope="col" class="rounded-q7">Date</th>
			<th scope="col" class="rounded-q8">Test Mail</th>
			<th scope="col" class="rounded-q4">Edit</th>
			
        </tr>
		
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="9" class="rounded-foot-left"><em>Newsletter Templates</em></td>
        	<td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>
    <tbody>
    	
		
		<?php
		$counter = 1;
		while($record = mysql_fetch_assoc($result))
		{
		$temp_count = getDispatchCount($record['template_id']);
		?>
		<tr>
        	<td><?php echo $counter+$startpoint; ?></td>
			<td><?php echo $record['template_id']; ?></td>
            <td><a href="view_newsletter.php?n=<?php echo $record['template_id']; ?>"><?php echo stripslashes($record['subject']); ?></a></td>
            <td><?php echo $record['dispatch_date']; ?></td>
            <td><?php echo $record['dispatch_time']; ?></td>
            <td><?php echo $record['status']; ?></td>
			<td><?php echo $temp_count; ?></td>
			
            <td><?php echo $record['date']; ?></td>
            <td><a href="send_test.php?t=<?php echo $record['template_id']; ?>">Send Test</a></td>
            <td><a href="edit_newsletter.php?t=<?php echo $record['template_id']; ?>">Edit</a></td>
			
        </tr>
		<?php
		$counter++;
		}//end while
		?>
      
    </tbody>
</table></div>
<?php
echo pagination($statement,$limit,$page);
?>

			<br>
	<a href="add_newsletter.php"><h3>Add Template</h3></a>					
									
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
									<li class="current_page_item"><a href="newsletters.php">Archives</a></li>
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