<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery validation plug-in - main demo</title>
<link rel="stylesheet" href="demo/css/screen.css">
<script src="jquery-2.2.3.min.js"></script>
<script src="input-mask/jquery.inputmask.js"></script>
<script src="input-mask/jquery.inputmask.extensions.js"></script>
<script src="jquery.form-validator.min.js"></script>
</head>

<body>
<div id="main">
<p>Default submitHandler is set to display an alert into of submitting the form</p>
<form class="cmxform" id="commentForm" method="get" action="">
	<fieldset>
		
		<p>
			<label for="cname">Name </label>
			<input id="cname" name="name" type="text" data-validation="required custom" data-validation-regexp='^([0-9]{4}[\-][0-9]{6})$' data-validation-error-msg='TTTT', data-inputmask='"mask":"9999-999999"' data-mask>
		</p>
		
		<p>
			<input class="submit" type="button" id="btn" value="Submit">
		</p>
	</fieldset>

</form>	
</div>
<script>
$(document).ready(function() {
$("[data-mask]").inputmask();
$.validate({
	form : '#commentForm',
	onSuccess : function($form) {
		return true;
	 }
	
});

////
$.validate({
    form : '#add_case_form',
    onSuccess : function($form) {
        var response = $.fn.validate_client_fields($form);
        if(response === true) {
            if($(".movingFormGroup").hasClass("mCustomScrollbar")){
               var $items = $('.movingFormGroup .mCustomScrollBox .mCSB_container').children(); 
            } else{
                var $items = $('.movingFormGroup').children(); 
            }   
            var $current = $items.filter('.current');
            var index = $current.index();
            if(index <= 1) {
                $.fn.update_next_prev_section(1);
                return false;
            }
        }
        return response;   
    },
});

/* validate documents */
$.fn.validate_client_fields = function($form)
{
    var response = true;
    var error_msg = '';
    var i = 1;
    $(".error-message").remove();
   
    if(response == true && !$("#next").is(":visible") && $("#prev").is(":visible"))
    {
        $(".client-specific-fileds").each(function(){
            if($(this).attr('is_mandatory') == '1' && $(this).val() == '')
            {
                var field_label = $(this).attr('field_label');
                error_msg+= i+". Client specific "+field_label +" field is mandatory.Insufficiency will be raised.Please confirm.\n\n";
                i++;
            }
        });
        if(error_msg !='')
        {
            response = confirm(error_msg);
        }
    }
    return response;
}


$.fn.update_next_prev_section = function(delta)
{
    if($(".movingFormGroup").hasClass("mCustomScrollbar")){
       var $items = $('.movingFormGroup .mCustomScrollBox .mCSB_container').children(); 
    } else{
        var $items = $('.movingFormGroup').children(); 
    }  
    var $current = $items.filter('.current');
    var index = $current.index();
    var newIndex = index+delta;
    if(index == 1) {
        $(".btn-submit , .btn-next").attr("type" , "submit");
    }
    // Range check the new index
    newIndex = (newIndex < 0) ? 0 : ((newIndex > $items.length) ? $items.length : newIndex); 
    if (newIndex != index){
        $current.removeClass('current');
        $current = $items.eq(newIndex).addClass('current');
        // Hide/show the next/prev
        $("#prev").toggle(!$current.is($items.first()));    
        $("#next").toggle(!$current.is($items.last()));    
    }
}



/////
$('#btn').click( function() {	
        $("#commentForm").submit();       
    });
});
</script>
</body>
</html>
