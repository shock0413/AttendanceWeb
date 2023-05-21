<?php

	$connect = mysqli_connect('localhost', 'root', 'apmsetup', 'test_db');
	
	$id = $_REQUEST['id'];
	
	$sql = "update attendance set attd_check = 'no' where emp_id = $id";
	mysqli_query($connect, $sql);

?>