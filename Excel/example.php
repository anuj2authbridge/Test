<?php
ob_clean();
include("excelwriter.inc.php");
$excel = new ExcelWriter(TEMP_REPORT_PATH."exaple.xls");
$excel->writeRow()
$excel->writeCol('Name');
$excel->close();
$file = TEMP_REPORT_PATH."exaple.xls";
 if (file_exists($file)) {
	header('Content-Description: File Transfer');
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename=' . basename($file));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	readfile($file);
	exit;
}
