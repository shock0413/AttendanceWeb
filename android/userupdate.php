<?
	$connect = mysqli_connect("localhost", "root", "apmsetup", "test_db");
	mysqli_set_charset($connect, "utf8");
	
	$user_id = $_REQUEST[id];		// 조건문
	$user_name = $_REQUEST[name];	// 바꿀 이름(개명했을 시)
	$user_pw = $_REQUEST[password];	// 바꿀 비밀번호
	$user_phone = $_REQUEST[phone];	// 바꿀 휴대폰 번호
	
	$sql = "update user set user_name = '$user_name', user_pw = '$user_pw', phone = '$user_phone'";
	$sql .= " where user_id = '$user_id'";
	
	mysqli_query($connect, $sql);
	
	mysqli_close($connect);
?>