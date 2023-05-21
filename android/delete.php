<?php

	$connect = mysqli_connect('localhost','root','apmsetup','test_db');
	mysqli_set_charset($connect, 'utf8');
	
	$user_id = $_GET[userId];
	$board_id = $_GET[boardId];
	$board_title = $_GET[boardTitle];
	
	$sql = "delete from board where board_id = {$board_id} and emp_id = '{$user_id}'";
	$result = mysqli_query($connect, $sql);
	
	$result_count = mysqli_affected_rows($connect);
	
	$xmlcode = "<?xml version=\"1.0\" encoding=\"utf8\"?>\n";
	if ($result_count>0) {
		$xmlcode .= "<data>\n";
		$xmlcode .= "<check>pass</check>\n";
	} else {
		$xmlcode .= "<data>\n";
		$xmlcode .= "<check>fail</check>\n";
	}
	$xmlcode .= "</data>\n";
	
	$dir = "C://APM_Setup/htdocs/android/deleteresult";
	$filename = $dir."/deleteresult{$board_id}.xml";
	
	file_put_contents($filename, $xmlcode);
	
	mysqli_close($connect);

?>