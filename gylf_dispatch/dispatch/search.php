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
		<title>Subscribers</title>
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
										
										<h2><a href="#">Healing School Dispatch Page </a></h2>
										<span class="byline">Dispatch Templates </span>
									</header>
									<div class="info">
										
										<span class="date"><span class="month"><?php echo date('m'); ?><span></span></span> <span class="day"><?php echo date('d'); ?></span><span class="year">, 2013</span></span>
										
										
									</div>
									
									
									<div class="license-form">
  <?php
 include('../link.inc.php');
 include_once ('pagination/function.php');

function get_newsletters()
	{
	$recs = array();
	$result = mysql_query("select subject as newsletter_name, template_id as newsletterId from dispatch_templates");
	if(!$result)
	die(mysql_error());
	while($records = mysql_fetch_assoc($result))
	$recs[] = $records;
	return $recs;
	
	}//end fn
	
	
    	$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 20;
    	$startpoint = ($page * $limit) - $limit;
        
        //to make pagination
		$email = !isset($_GET["email"]) ? "" : $_GET["email"];
		$newsletterId = !isset($_GET["nid"]) ? "" : $_GET["nid"];
		$url = "?email=$email&nid=$newsletterId&";
		$newsletters = get_newsletters();
		
        $statement = "SELECT c.* FROM dispatch_response d LEFT JOIN contacts c using(crypt_val) where d.template_id LIKE'%$newsletterId%' ";

 
  $sql = "SELECT c.* FROM dispatch_response d LEFT JOIN contacts c using(crypt_val) where d.template_id LIKE'%$newsletterId%' LIMIT {$startpoint} , {$limit}";
 // echo $sql;
  $result = mysql_query($sql);
	  if(!$result)
	  {
	  die("Unable to get records.<br><br>".mysql_error());
	  }//end if
	  
 ?> 
  <form name="form1" method="get" action="">
    
  Subscribers: 
  <select name="nid" id="nid" onChange="this.form.submit()">
    <option value="" >All</option>
	<?php
	foreach($newsletters as $newsletter)
	{
	$sel = ($newsletterId == $newsletter['newsletterId'])? 'selected="selected"' : "";
	
	echo "<option value=\"".$newsletter['newsletterId']."\" $sel>".$newsletter['newsletter_name']."</option>";
	}//end foreach
	?>
  </select>
  
  <table id="rounded-corner" summary="Ministers' data">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company">S/N</th>
			<th scope="col" class="rounded-q1">Title</th>
			<th scope="col" class="rounded-q1">Firstname</th>
            <th scope="col" class="rounded-q1">Lastname</th>
           
            <th scope="col" class="rounded-q3">Email</th>
            <th scope="col" class="rounded-q9">Phone</th>
			<th scope="col" class="rounded-q5">Country</th>
			<th scope="col" class="rounded-q6">Unsubscribe</th>
			<th scope="col" class="rounded-q7">Crypt Val</th>
			<th scope="col" class="rounded-q8">Timestamp</th>
			<th scope="col" class="rounded-q4">Edit</th>
			
        </tr>
		
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="10" class="rounded-foot-left"><em>Newsletter Subscribers</em></td>
        	<td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>
    <tbody>
    	
		
		<?php
		$counter = 1;
		while($record = mysql_fetch_assoc($result))
		{
		?>
		<tr>
        	<td><?php echo $counter+$startpoint; ?></td>
			<td><?php echo $record['title']; ?></td>
			<td><?php echo $record['firstname']; ?></td>
            <td><?php echo $record['lastname']; ?></td>
            <td><?php echo $record['email']; ?></td>
            <td><?php echo $record['phone']; ?></td>
            <td><?php echo $record['country']; ?></td>
			<td><?php echo $record['unsubscribe']; ?></td>
			
            <td><?php echo $record['crypt_val']; ?></td>
            <td><?php echo $record['timestamp']; ?></td>
            <td><a href="edit_subscriber.php?s=<?php echo $record['list_Id']; ?>">Edit</a></td>
			
        </tr>
		<?php
		$counter++;
		}//end while
		?>
      
    </tbody>
</table></div>
<?php
echo pagination($statement,$limit,$page, $url);
?>

							
									
								</article>
						

						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
					
						<!-- Logo -->
							<div id="logo">
								<h1>HS DP</h1>
							</div>
					
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li ><a href="index.php">Home</a></li>
									<li><a href="newsletters.php">Archives</a></li>
									<li><a href="subscriptions.php">Subscriptions</a></li>
									<li class="current_page_item"><a href="subscribers.php">Subscribers</a></li>
									<li><a href="logout.php">Logout</a></li>
								</ul>
							</nav>

						<!-- Search -->
							<section class="is-search">
								
									<input type="text" class="text" name="email" placeholder="Search Email" />
								</form>
							</section>
					
						
						<!-- Copyright -->
							<div id="copyright">
								<p>
									&copy; 2014 Healing School<br />
									
								</p>
							</div>

					</div>

			</div>

	</body>
</html>