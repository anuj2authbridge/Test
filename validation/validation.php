<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.validate.js"></script>

<script>
$(document).ready(function() {

		// validate signup form on keyup and submit
		$("#commentForm").validate({
			rules: {
				name: "required",
				email: {
					required: true,
					email: true
				},
				phone: "required",
				desig: "required",
				company: "required"
			},
			messages: {
				required: "Please enter your name",
				
				email: "Please enter a valid email address"
			}
		});
});
</script>
