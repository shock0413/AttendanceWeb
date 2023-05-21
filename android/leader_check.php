<?
	$connect = mysqli_connect('localhost', 'root', 'apmsetup', 'test_db');
	
	$meet_num = $_REQUEST['num'];
	$user_id = $_REQUEST['id'];
	$date = date("Y-m-d");
	$time = date("H:i:s");
	
	$sql = "select * from meeting where meet_id = $meet_num and user_id = '$user_id'";
	$sql .= " and meet_date = '$date' and meet_start <= '$time' and meet_end >= '$time'";
	$result = mysqli_query($connect, $sql);
	
	$row = mysqli_fetch_array($result);
	
	$check_num = $row[0];
	$check_userid = $row[5];
	
	$xmlcode = "<?xml version=\"1.0\" encoding=\"utf8\"?> \n";
	$xmlcode .= "<data>\n";
	if (($meet_num == $check_num) && ($check_userid == $user_id)) {
		$xmlcode .= "<leader_check>YES</leader_check>\n";
	} else {
		$xmlcode .= "<leader_check>NO</leader_check>\n";
	}
	$xmlcode .= "</data>\n";
	
	$dir = "C://APM_Setup/htdocs";
	$file = $dir."/android/leaderresult/check_result$meet_num.xml";
	file_put_contents($file, $xmlcode);
	
?>