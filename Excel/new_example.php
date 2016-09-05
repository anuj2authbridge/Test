<?php
include("excelwriter.inc.php");
$excel=new ExcelWriter("abc.xls");
if($excel==false)	{
echo $excel->error;
exit();
}

//write header
$header = array("<b>Col-1</b>","<b>Col-2</b>", "Col-3");
//print header
$excel->writeLine($header);
//fetch all data from db according to requirement
while(true)
{
  $excel->writeRow();
  $excel->writeCol("$variable-for-col-1");
  $excel->writeCol("$variable-for-col-3");
  $excel->writeCol("$variable-for-col-3");
}
$excel->close();
$file = "abc.xls";
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}
?>
