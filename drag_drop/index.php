<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
</head>
<body>
    <style type="text/css">
        body
        {
            font-family: Arial;
            font-size: 10pt;
        }
        img
        {
            height: 100px;
            width: 100px;
            margin: 2px;
        }
        .draggable
        {
            filter: alpha(opacity=60);
            opacity: 0.6;
        }
        .dropped
        {
            position: static !important;
        }
        #dvSource
        {
            border: 5px solid #ccc;
            padding: 5px;
            min-height: 100px;
            width: 430px;
        }
		#panDiv,#aadharDiv,#passportDiv
        {
            border: 5px solid #ccc;
            padding: 5px;
            min-height: 100px;
            width: 130px;
        }
    </style>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>
    <link href="css/jquery-ui.css" rel="stylesheet"
        type="text/css" />
    <script type="text/javascript">
        $(function () {
            $("#dvSource img").draggable({
                revert: "invalid",
                refreshPositions: true,
                drag: function (event, ui) {
                    ui.helper.addClass("draggable");
                },
                stop: function (event, ui) {
                    ui.helper.removeClass("draggable");
					var divIds = $(this).parent("div").attr("id");
                    var image = this.src.split("/")[this.src.split("/").length - 1];
                    if ($.ui.ddmanager.drop(ui.helper.data("draggable"), event)) {
						if(divIds == 'panDiv')
						{
							OCRImage(this.src, 'PAN');
						}
						else if(divIds == 'aadharDiv') {
							OCRImage(this.src, 'AADHAR');
						}
						else if(divIds == 'passportDiv') {
							OCRImage(this.src, 'PASSPORT');
						}else{
							alert("Please try again!");
						}
                      
                    }
                    else {
                        alert(image + " not dropped.");
                    }
                },
				
            });
            $("#panDiv, #aadharDiv, #passportDiv").droppable({
                drop: function (event, ui) {                    
					$(this).html("");	
                    ui.draggable.addClass("dropped");
                    $(this).append(ui.draggable);
					
                }
            });
			function OCRImage(imgPath, docType)
			{
				if(imgPath != '' && docType != '')
				{
					$.ajax({
						url: "ocr.php",
						type: "POST",
						data:  {'imgPath': imgPath, 'docType': docType },
						cache: false,
						processData:true,
						beforeSend: function()
						{
							 $("#loaderId").html("Please wait while we process your request.");
						},
						success: function(data)
						{
							 $("#loaderId").html(data);
						},
						error: function() 
						{
								 $("#loaderId").html("Something went wrong, Please try again later.");
						} 	        
				   });
				}
			}
			
			
        });
    </script>
    <div id="dvSource">
        <img alt="" src="images/Chrysanthemum.jpg" />
        <img alt="" src="images/Desert.jpg" />
        <img alt="" src="images/Hydrangeas.jpg" />
        <img alt="" src="images/Jellyfish.jpg" />
        <img alt="" src="images/Koala.jpg" />
        <img alt="" src="images/Lighthouse.jpg" />
        <img alt="" src="images/Penguins.jpg" />
        <img alt="" src="images/Tulips.jpg" />
    </div>
    <hr />
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center">
			<div id="panDiv">
				Drop here
			</div>
			<div>OCR PAN </div>
		</td>
		<td align="center">
			<div id="aadharDiv">
				Drop here
			</div>
			<div>OCR Aadhra </div>
		</td>
		<td align="center">
			<div id="passportDiv">
				Drop here
			</div>
			<div>OCR PASSPORT </div>
		
		</td>
	</tr>
	<tr><td colspan="3" align="center">&nbsp;</td></tr>
	<tr><td colspan="3" align="center"><b><span id="loaderId"></span></b></td></tr>
	</table>
    
</body>
</html>

-----------------------------------------------------------------


<?php
/*
$con = mysql_connect("localhost", "root", "") or die(mysql_error());
if($con)
{
	mysql_select_db("ocr", $con) or die(mysql_error());
}
*/
if(isset($_POST['imgPath']) && !empty($_POST['imgPath']))
{
	$docPath = $_POST['imgPath'];
	$docType = $_POST['docType'];
	//$query = "INSERT INTO table SET doc_path = '$docPath', doc_type = '$docType'";
	//$exe = mysql_query($query) or die(mysql_error());
	$response = array('DocType'=>$docType, 'Path'=>$docPath);
	echo json_encode($response);
	exit();
}
?>
