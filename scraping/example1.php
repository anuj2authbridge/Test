//step1 get cookies

$specialChars = array("\r", "\n");
	$replaceChars = array("", "");
	
	
$url="google.com";
	$ch1 = curl_init();
	curl_setopt($ch1, CURLOPT_URL, $url);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch1, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch1, CURLOPT_HEADER, 1);
	$cookie_output = curl_exec($ch1);
	curl_close($ch1);
	
	preg_match('/^Set-Cookie:\s*([^;]*)/mi', $cookie_output, $m);
	
	// step 2 use cookie & fetch data
	$ch2 = curl_init();
	curl_setopt($ch2, CURLOPT_URL, "google.com");
	curl_setopt($ch2, CURLOPT_POST, TRUE);
	curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_array_data);
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch2, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch2, CURLOPT_COOKIE, isset($m[1]) ? $m[1] : "");
	$cin_html = curl_exec($ch2);
	curl_close($ch2);
	
	//step 3 extarct data
	$dom = new DOMDocument();
	@$dom->loadHTML($cin_html);
	$xpath = new DOMXPath($dom);
	$dom->saveHTMLfile('test__'.generateRandomString(10).'__'.time().'__'.mt_rand(10000, 999999).'.html');
	$rows = $xpath->query("//table[@id='DataBlock1']/tr");
	if($rows->length > 0)
	{
	  $chek_str = str_replace($specialChars, $replaceChars, trim(cleanString($rows->item(1)->childNodes->item(0)->nodeValue)));
				if($chek_str == 'CIN') {
					$finalData['Cin'] = str_replace($specialChars, $replaceChars, trim(cleanString($rows->item(1)->childNodes->item(2)->nodeValue)));
					$finalData['CompanyName'] = str_replace($specialChars, $replaceChars, trim(cleanString($rows->item(2)->childNodes->item(2)->nodeValue)));
					$finalData['AuthorisedCapital'] = str_replace($specialChars, $replaceChars, trim(cleanString($rows->item(8)->childNodes->item(2)->nodeValue)));
					$finalData['PaidUpCapital'] = str_replace($specialChars, $replaceChars, trim(cleanString($rows->item(9)->childNodes->item(2)->nodeValue)));
					$finalData['DateOfIncorporation'] = str_replace($specialChars, $replaceChars, trim(cleanString($xpath->query("//table[@id='DataBlock1']/tr/td/input[@name='regDt']/@value")->item(0)->nodeValue)));
					$finalData['Address'] = str_replace($specialChars, $replaceChars, trim(cleanString($rows->item(12)->childNodes->item(1)->nodeValue))).' '.str_replace($specialChars, $replaceChars, trim(cleanString($rows->item(13)->childNodes->item(1)->nodeValue)));
					$finalData['City'] = str_replace($specialChars, $replaceChars, trim(cleanString($rows->item(14)->childNodes->item(1)->nodeValue)));
					$finalData['State'] = str_replace($specialChars, $replaceChars, trim(cleanString($rows->item(15)->childNodes->item(1)->nodeValue)));
					$finalData['Country'] = str_replace($specialChars, $replaceChars, trim(cleanString($xpath->query('//table[@id="DataBlock1"]/tr/td/select[@name="cntryCode"]/option[@selected]')->item(0)->nodeValue)));
					$finalData['Pin'] = str_replace($specialChars, $replaceChars, trim(cleanString($rows->item(17)->childNodes->item(1)->nodeValue)));
					$output = array('status'=>'200', 'mag'=>'ok', 'response'=>array($finalData));
					
				}
	}
		function cleanString($text) {
    $utf8 = array(
        '/[Ã¡Ã Ã¢Ã£ÂªÃ¤]/u'   =>   '',
        '/[ÃÃÃÃÃ]/u'    =>   '',
        '/[ÃÃÃÃ]/u'     =>   '',
        '/[Ã­Ã¬Ã®Ã¯]/u'     =>   '',
        '/[Ã©Ã¨ÃªÃ«]/u'     =>   '',
        '/[ÃÃÃÃ]/u'     =>   '',
        '/[Ã³Ã²Ã´ÃµÂºÃ¶]/u'   =>   '',
        '/[ÃÃÃÃÃ]/u'    =>   '',
        '/[ÃºÃ¹Ã»Ã¼]/u'     =>   '',
        '/[ÃÃÃÃ]/u'     =>   '',
        '/Ã§/'           =>   '',
        '/Ã/'           =>   '',
        '/Ã±/'           =>   '',
        '/Ã/'           =>   '',
        '/â/'           =>   '', // UTF-8 hyphen to "normal" hyphen
        '/[âââ¹âºâ]/u'    =>   '', // Literally a single quote
        '/[ââÂ«Â»â]/u'    =>   '', // Double quote
        '/:/'           =>   '',		// nonbreaking space (equiv. to 0x160)
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}
