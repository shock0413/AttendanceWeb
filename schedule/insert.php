<? session_start(); ?>
<meta charset="utf8">
<?
	if (!$_SESSION[userid]) {
		echo ("
			<script>
				window.alert('로그인 후 이용해 주세요.');
				history.go(-1);
			</script>
		");
		exit;
	}
	
	include "../lib/dbconn.php";
	
	mysqli_set_charset($connect, "utf8");
	
	$sql = "insert into meeting(meet_name, meet_date, meet_start, meet_end, user_id)";
	$sql .= " values('$_REQUEST[schedule_name]', '$_REQUEST[schedule_date]', '$_REQUEST[schedule_start]', '$_REQUEST[schedule_end]', '$_SESSION[userid]')";
	
	mysqli_query($connect, $sql);
	
	$sql = "select * from meeting where meet_name = '$_REQUEST[schedule_name]' and meet_date = '$_REQUEST[schedule_date]' and user_id = '$_SESSION[userid]'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);
	$meet_num = $row[0];
	
	$sql = "select * from user";
	$result2 = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($result2)) {
		$userid = $row[0];
		if ($_REQUEST['schedule_check_'.$row[0]]) {
			$sql = "insert into attendance(user_id, meet_id)";
			$sql .= " values('$userid', $meet_num)";
			mysqli_query($connect, $sql);
		}
	}
	
	echo ("
		<script>
			location.href = 'schedule.php';
		</script>
	");
	
?>