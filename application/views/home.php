<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Event Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap.min.css" media="screen">
    <link href="<?php echo base_url();?>/assets/base.css" rel="stylesheet" media="screen">
<!-- Bootstrap style responsive -->	
	<link href="<?php echo base_url();?>/assets/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>/assets/font-awesome.css" rel="stylesheet" type="text/css">

   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<style type="text/css" id="enject"></style>
  </head>
<body>
<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
	<div class="span6">Welcome!<strong> User</strong></div>
	
</div>
</div>
</div>
<div id="mainBody">
	<div class="container">	
	<div class="navbar-inner">   
		<form class="form-inline navbar-search">
		<input id="srchFld" class="srchTxt" type="text">
				<button type="button" id="goButton" class="btn btn-primary">Go</button>
		</form>
		<form class="form-reset" action="./events" method="GET">
				<button type="submit" id="reset" class="btn btn-primary">Reset</button>
		</form>
    
	</div>
	
	
	<div class="row">

		<div class="span9">		
			
		<h4>Events</h4>
			  <ul class="thumbnails">
<?php 
//echo "<pre>";
//print_r($loadSet);
foreach($loadSet as $value){ 
?>
				<li class="span3">
				  <div class="thumbnail">
					<a><img src=<?php echo $value['eventlogo'];?> alt=""></a>
					<div class="caption">
					  <h5><?php echo $value['eventname'];?></h5>
					  <p> 
						Event Date :<?php echo $value['eventdate'];?> 
					  </p>
					  <p class="venueFilter"> 
						Event Venue :<?php echo $value['eventVenue'];?> 
					  </p>
					  <p>
						Fare :&#8360; <?php echo $value['eventfare'];?>
					  </p>
					  </div>
				  </div>
				</li>
<?php  }?>				
			  </ul>	

		</div>
		</div>
	</div>
</div>
<div id="footer">
	
</div>

	<script src="<?php echo base_url();?>/assets/jquery.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>/assets/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>/assets/loader.js" type="text/javascript"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
	
</body>
</html>