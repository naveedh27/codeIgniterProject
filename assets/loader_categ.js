
var $ = jQuery;
var Locations = ["Aluvae", "Baroda", "Bravos", "Chennai", "Cochin", "Coimabtore", "Daman", "Diu", "Ernakulam", "Goa", "Gwalior", "Jammu", "Kashmir", "Kuala Lampur", "Namakkal", "NCR", "Noida", "Pondy", "Singapore", "Trichy", "Vagator"]; 


$( document ).ready(function() { 

$('#srchFldCateg').focus(function(){
	 $(this).css('background-image', 'none');
 });
 
 
 $( "#srchFldCateg" ).autocomplete({
      source : Locations
});

var city = "";
function lookForCityChange(){	
    var newCity = document.getElementById("srchFldCateg").value;
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



});