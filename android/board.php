<?php

	$connect = mysqli_connect('localhost', 'root', 'apmsetup', 'test_db');
	mysqli_set_charset($connect, 'utf8');

	$sql = "select * from board order by board_date desc, board_id desc";
	$result = mysqli_query($connect, $sql);
	
	$xmlcode = "<?xml version=\"1.0\" encoding=\"utf8\"?>\n";
	$xmlcode .= "<data>\n";
	while ($row=mysqli_fetch_array($result)) {
	
		$board_id = $row[0];
		$board_title = $row[1];
		$board_content = $row[2];
		$board_date = $row[3];
		$user_id = $row[4];
		
		$xmlcode .= "<board_id>$board_id</board_id>\n";
		$xmlcode .= "<board_title>$board_title</board_title>\n";
		$xmlcode .= "<board_content>$board_content</board_content>\n";
		$xmlcode .= "<board_date>$board_date</board_date>\n";
		$xmlcode .= "<user_id>$user_id</user_id>\n";
	}
	$xmlcode .= "</data>\n";
	$dir = "C://APM_Setup/htdocs/android";
	$filename = $dir."/boardresult.xml";
	
	file_put_contents($filename, $xmlcode);
	
	mysqli_close($connect);
?>