public function index()
	{
		$host = "localhost";
		$path = "http://localhost/nid_bridge/cron/send_mail";
		$id = 5;
		$method = 'POST';
		$this->curl_request_async($host, $path, $id, $method);
		//$this->send_mail();
		echo "mail sent";
		die;
	}
	
	 public function curl_request_async($hostname, $path, $id, $method='POST')
  {
      
	  $fp = fsockopen($hostname, 80, $errno, $errstr, 30);
	  if (!$fp) { 
		echo "$errstr ($errno) <br />\n" ;
	}
	  else
	  {
		$data = "id=".urlencode($id)."\r\n\r\n";
		$headers = "POST $path HTTP/1.1\r\n";
		$headers .= "Host: $hostname\r\n";
		$headers .= "Content-type: application/x-www-form-urlencoded; ; charset=utf-8\r\n";
		$headers .= "Content-Length: ".strlen($data)."\r\n\r\n\r\n";
		fwrite($fp, $headers);
    	fclose($fp);
	  }
  }
  
  
    public function send_mail() {
     // do whatever you to do
    }
