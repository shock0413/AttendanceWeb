<meta charset="utf8">
<?
	$connect = mysqli_connect('localhost', 'root', 'apmsetup', 'test_db');
	
	$meet_num = $_REQUEST[num];
	$time = date("Y-m-d H:i:s");
	
	$sql = "select * from meeting where meet_id = $meet_num";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);
	$meet_date = $row[2];
	$meet_start = $row[3];
	$meet_time = $meet_date." ".$meet_start;
	
	$diff = strtotime($time) - strtotime("$meet_time GMT");	// 회의 시작 후 시간 구하기
	$diff_hour = date("H", $diff);							// 시간 차의 시간 부분
	$diff_min = date("i",$diff);							// 시간 차의 분 부분
	
	$xmlcode = "<?xml version=\"1.0\" encoding=\"utf8\"?>\n";
	$xmlcode .= "<data>\n";
	
	echo $meet_time;
	
	if ($diff_min > 9 || $diff_hour > 0) {					// 시작 후 10분이 지났거나 1시간이 지났을 때
	
		$sql = "select * from attendance a join user u on a.user_id = u.user_id";
		$sql .= " where a.meet_id = $meet_num and a.attd_check = 'NO' and a.send_msg = 'NO'";
		$result2 = mysqli_query($connect, $sql);

		while ($row2 = mysqli_fetch_array($result2)) {
			$phone = $row2[9];
		
			$xmlcode .= "<phone>$phone</phone>\n";
		}
	}
	
	$xmlcode .= "</data>\n";
	
	$dir = "C://APM_Setup/htdocs/android/";
	$file = $dir."latecheckresult/latecheckresult$meet_num.xml";
	
	file_put_contents($file, $xmlcode);
?>