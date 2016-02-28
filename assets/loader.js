var loadController;
window.onload = function () { 

var $ = jQuery;
var lastVenue ="";

loadController ={
	
		threshold : 1,	
		lastResponse : 0,
		currentCity : "",
		locationslist :[],
		getData : function(){
			
			if(lastVenue == ""){
			$.ajax({
				  url: "events/getNext",
				  type: "get",
				  data:{
					  threshold : loadController.threshold,
					},
				  success: function(response) {
					  if(response != -1){
						loadController.appender(response);
					  }else{
						  $('#footer').append("<h1>That's All Folks !!!</h1>");
						  loadController.lastResponse = response;
					  }
					loadController.threshold++;
					console.log(loadController.threshold);
				  },
				  error: function(xhr) {
					
				  }
			}); 
		}	
		},
		appender : function(response){
			response.forEach(function(entry){						
					var content = "<li class='span3'><div class='thumbnail'><a><img src="+entry['eventlogo']+"></a><div class='caption'><h5>"+entry['eventname']+"</h5><p>Event Date : "+entry['eventdate']+"</p><p class='venueFilter'>Event Venue : "+entry['eventVenue']+"</p><p>Fare :&#8360; "+entry['eventfare']+"</p></div></div></li>";
						
					$('.thumbnails').append(content);
			});
		},
		getLocations : function(location){
			$.ajax({
				  url: "events/getVenue",
				  type: "get",
				  data:{
					  loc:location
					},
				  success: function(response) {
					 loadController.locationslist = response;
				  },
				  error: function(xhr) {
					
				  }
			});
		},
		filterFunc : function(){
			if(lastVenue != $("#srchFld").val()){				
			lastVenue = $("#srchFld").val();
				if(lastVenue != ""){
						 $.ajax({
									  url: "events/getListByLoc",
									  type: "get",
									  data:{
										  location:lastVenue
										},
									  success: function(response) {
										  $('.thumbnails').html('');
										  $('#footer').html('');
										  if(response != -1){
											loadController.appender(response);
											$('#footer').append("<h1>That's All Folks !!!</h1>");
											loadController.lastResponse = -1;
										  }else{
											 $('#footer').append("<h1>Oops!! Nothing Found.</h1>");
										  }
									  },
									  error: function(xhr) {
										
									  }						 
						  });
				}
		}	
		}


}

$(window).scroll(function(){
      if  ($(window).scrollTop() == $(document).height() - $(window).height()){
			if(loadController.lastResponse != -1){
				loadController.getData();
			}
				
      }
 });
 
 
 $('#srchFld').focus(function(){
	 $(this).css('background-image', 'none');
 });
 
  var target = "";
 $( "#srchFld" ).keyup(function() {	 
    target = $(this).val();
	
	/* var rx = new RegExp(".*"+target+".*","i");	
	$('.venueFilter').each(function(){  
		if(!rx.test($(this).text())){
			$(this).closest("li").hide();
		}else{
			$(this).closest("li").show();
		} 
	});
	loadController.locationslist = -1; */
});
var city = "";
function lookForCityChange(){	
    var newCity = document.getElementById("srchFld").value;
    if (newCity != city) {
        city = newCity;
        var rx = new RegExp(".*"+city+".*","i");	
		$('.venueFilter').each(function(){  
			if(!rx.test($(this).text())){
				$(this).closest("li").hide();
			}else{
				$(this).closest("li").show();
			} 
		});
		loadController.currentCity = city;
    }
}
setInterval(lookForCityChange, 800);

$( "#srchFld" ).autocomplete({
      source: function( request, response ) {
      $.ajax({
				  url: "events/getVenue",
				  type: "get",
				  data:{
					  loc:target
					},
				  success: function(data) {
				   response(data);
				  },
				  error: function(xhr) {
					
				  }
				 
      });
    } 
});

$('#goButton').click(function(){
	loadController.filterFunc();
});
$( ".form-inline" ).submit(function( event ) {
  loadController.filterFunc();
  event.preventDefault();
});

}