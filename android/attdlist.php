<?

	$connect = mysqli_connect("localhost", "root", "apmsetup", "test_db");
	mysqli_set_charset($conenct, "utf8");
	
	mysqli_query($connect,"set session character_set_connection=utf8;");
	mysqli_query($connect,"set session character_set_results=utf8;");
	mysqli_query($connect,"set session character_set_client=utf8;");
	
	$user_id = $_REQUEST[id];
	
	$sql = "select * from meeting m join attendance a ";
	$sql .= "on m.meet_id = a.meet_id ";
	$sql .= "where a.user_id = '$user_id'";
	
	$result = mysqli_query($connect, $sql);
	
	$xmlcode = "<?xml version=\"1.0\" encoding=\"utf8\"?> \n";
	$xmlcode .= "<data>\n";
	while ($row = mysqli_fetch_array($result)) {
		$meet_name = $row[1];
		$meet_date = $row[2];
		$meet_start = $row[3];
		$meet_end = $row[4];
		$meet_check = $row[8];
		
		$xmlcode .= "<meet_date>$meet_date</meet_date>\n";
		$xmlcode .= "<meet_name>$meet_name</meet_name>\n";
		$xmlcode .= "<meet_start>$meet_start</meet_start>\n";
		$xmlcode .= "<meet_end>$meet_end</meet_end>\n";
		$xmlcode .= "<meet_check>$meet_check</meet_check>\n";
	}
	$xmlcode .= "</data>\n";

	$dir = "C://APM_Setup/htdocs/android";
	$filename = $dir."/attdlistresult/attdlistresult(".$user_id.").xml";
	
	file_put_contents($filename, $xmlcode);
	
	mysqli_close($connect);

?>