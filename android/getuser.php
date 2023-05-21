<?
	$connect = mysqli_connect("localhost", "root", "apmsetup", "test_db");
	mysqli_set_charset($connect, "utf8");
	
	$user_id = $_REQUEST[id];
	
	$sql = "select * from user where user_id = '$user_id'";
	$result = mysqli_query($connect, $sql);
	
	$xmlcode = "<?xml version=\"1.0\" encoding=\"utf8\"?> \n";
	$xmlcode .= "<data>\n";
	
	while ($row = mysqli_fetch_array($result)) {
		$user_pw = $row[1];
		$user_name = $row[2];
		$user_phone = $row[4];
		
		$xmlcode .= "<user_name>$user_name</user_name>";
		$xmlcode .= "<user_pw>$user_pw</user_pw>";
		$xmlcode .= "<user_phone>$user_phone</user_phone>";
	}
	
	$xmlcode .= "<data>\n";
	
	$dir = "C://APM_Setup/htdocs/android/getuserresult";
	$filename = $dir."/result(".$user_id.").xml";
	
	file_put_contents($filename, $xmlcode);
	
	mysqli_close($connect);
?>