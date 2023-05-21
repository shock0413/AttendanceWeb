<?
	$connect = mysqli_connect('localhost', 'root', 'apmsetup', 'test_db');
	
	$meet_num = $_REQUEST[num];
	
	$sql = "select * from meeting where meet_id = $meet_num";
	$result = mysqli_query($connect, $sql);
	
	$row = mysqli_fetch_array($result);
	
	$xmlcode = "<?xml version=\"1.0\" encoding=\"utf8\"?>\n";
	$xmlcode .= "<data>\n";
	
	$xmlcode .= "</data>\n";
?>