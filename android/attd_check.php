<?php
	
	$connect = mysqli_connect('localhost', 'root', 'apmsetup', 'test_db');
	
	$id = $_REQUEST['id'];
	$date = date("Y-m-d");
	$time = date("H:i:s");
	
	$sql = "select * from meeting m join attendance a on m.meet_id = a.meet_id";
	$sql .= " where a.user_id = '$id' and m.meet_date = '$date' and m.meet_start <= '$time' and m.meet_end >= '$time'";
	$result = mysqli_query($connect, $sql);
	
	$xmlcode = "<?xml version=\"1.0\" encoding=\"utf8\"?> \n";
	$xmlcode .= "<node>\n";
	while ($row=mysqli_fetch_array($result))
	{
		$meet_num = $row[7];
		$attd_check=$row[8];
		
		$xmlcode .= "<meet_num>$meet_num</meet_num>\n";
		$xmlcode .= "<check>$attd_check</check>\n";
	}
	$xmlcode .= "</node>\n";
	
	$dir = "C://APM_Setup/htdocs";
	$file = $dir."./android/attd_check.xml";
	file_put_contents($file, $xmlcode);
?>