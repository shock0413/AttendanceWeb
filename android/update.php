<?php

	$connect = mysqli_connect('localhost', 'root', 'apmsetup', 'test_db');
	
	$id = $_REQUEST['id'];
	$meet_num = $_REQUEST[num];
	$attd_date = date("Y-m-d (H:i:s)");
	
	$sql = "update attendance set attd_check = 'YES', attd_date = '$attd_date' where user_id = '$id' and meet_id = $meet_num";
	mysqli_query($connect, $sql);

?>