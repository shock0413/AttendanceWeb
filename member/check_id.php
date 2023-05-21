<meta charset="utf8">
<?

	$id = $_REQUEST['id'];

	if(!$id) {
		echo("아이디를 입력하세요.");
	}
	else {
		include "../lib/dbconn.php";
		
		$sql = "select * from user where user_id='$id'";
		
		$result = mysqli_query($connect, $sql);
		$num_record = mysqli_num_rows($result);
		
		$pattern = '/^[0-9a-z_]{4,12}$/';
		
		if (preg_match($pattern, $id, $result)) {
		if ($num_record>0) {
				echo "아이디가 중복됩니다!<br>";
				echo "다른 아이디를 사용하세요.<br>";
			} else {
				echo "{$id}은 사용할 수 있는 이름입니다.<br>";
				echo "\$result의 값: {$result[0]}";
			}
		} else {
			echo "{$id}은 사용할 수 없는 이름입니다.";
		}
		
		mysqli_close($connect);
	}
?>