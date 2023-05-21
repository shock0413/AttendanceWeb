<?
	$connect = mysqli_connect('localhost', 'root', 'apmsetup', 'test_db') or
		die ("SQL server에 연결할 수 없습니다.");
		
	mysqli_query($connect, "set session character_set_connection=utf8;");
	mysqli_query($connect, "set session character_set_results=utf8");
	mysqli_query($connect, "set session character_set_client=utf8");
?>