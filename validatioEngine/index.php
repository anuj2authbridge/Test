$(document).ready(function(){

if input type button is submit then 

$("#add-team-member").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});

if input type button is button then
$('body').on('click', '#sign-up-btn', function(e){
		 if($("#sign-up-form").validationEngine('validate', {promptPosition : "topRight:-50", autoPositionUpdate : true})) {
		 }
		 });
});


validation rule -: 

