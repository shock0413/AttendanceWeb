<meta charset="utf8">
<?
	$connect = mysqli_connect('localhost', 'root', 'apmsetup', 'test_db');
	
	$meet_num = $_REQUEST[num];
	$phone = $_REQUEST[phone];
	
	$sql = "select * from user where phone = '$phone'";
	$result = mysqli_query($connect, $sql);
	
	$row = mysqli_fetch_array($result);
	
	$user_id = $row[0];
	
	$sql = "update attendance set send_msg = 'YES'";
	$sql .= " where user_id = '$user_id' and meet_id = $meet_num and send_msg = 'NO'";
	mysqli_query($connect, $sql);
	
?>