<html>

<style>
/*  SECTIONS  */
.section {
	clear: both;
	padding: 0px;
	margin: 0px;
}

/*  COLUMN SETUP  */
.col {
	display: block;
	float:left;
	margin: 1% 0 1% 1.6%;
}
.col:first-child { margin-left: 0; }

/*  GROUPING  */
.group:before,
.group:after { content:""; display:table; }
.group:after { clear:both;}
.group { zoom:1; /* For IE 6/7 */ }

/*  GRID OF FOUR  */
.span_4_of_4 {
	width: 100%;
}
.span_3_of_4 {
	width: 74.6%;
}
.span_2_of_4 {
	width: 49.2%;
}
.span_1_of_4 {
	width: 23%;
}

/*  GO FULL WIDTH BELOW 480 PIXELS */
@media only screen and (max-width: 480px) {
	.col {  margin: 1% 0 1% 0%; }
	.span_1_of_4, .span_2_of_4, .span_3_of_4, .span_4_of_4 { width: 100%; }
}


</style>

<body>
<p></p>

<div class="section group">
<?php 
//echo "<pre>";
//print_r($loadSet);
foreach($loadSet as $value){ 
?>

	<div class="col span_1_of_4">
		<div id ="eventLogo">
		<img src =<?php echo $value['eventlogo'];?> height="100px" width="100px">
		</div>
		<div id ="eventName"><?php echo $value['eventname'];?></div>
		<div id ="eventFare"><?php echo $value['eventfare'];?></div>
		<div id ="eventVenue"><?php echo $value['eventVenue'];?></div>
		<div id ="eventDate"><?php echo $value['eventdate'];?></div>
	</div>

<?php } ?>
	
</div>


</body>

</html>