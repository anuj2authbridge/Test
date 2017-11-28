//js part

$(document).ajaxStart(function(){ 
  $('#loadingDiv').fadeIn(); 
  }).ajaxStop(function(){ 
    $('#loadingDiv').fadeOut("slow");
});
$(window).on('load',function() {
    $("#loadingDiv").fadeOut("slow");
}); 

//html

<div id="loadingDiv" class="loader-overlay">
	    	<div><i class="fa fa-spinner fa-spin fa-5x" aria-hidden="true"></i></div>
		</div>
    
    //css
    /*loader css*/
.loader-overlay
{position: fixed;top: 0;right: 0; bottom: 0;left: 0;z-index: 1050;overflow: hidden; outline: 0;opacity: 1; -webkit-transition: opacity .15s linear;-o-transition: opacity .15s linear;transition: opacity .15s linear;background-color: rgba(0, 0, 0, 0.48);text-align: center;}
.loader-overlay div{position: absolute;left: 47%; top: 40%; color: #fff;}
