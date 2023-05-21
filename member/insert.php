<meta charset="utf8">
<?
	$id = $_POST['id'];
	$pass = $_POST['pass'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$regist_day = date("Y-m-d (H:i:s)");		// 현재의 '년-월-일-시-분-초'을 저장
	$ip = $REMOTE_ADDR;		// 방문자의 IP주소를 저장
	
	include "../lib/dbconn.php";
    
    mysqli_set_charset($connect, "utf8");
	
	$sql = "select * from user where user_id='$id'";
	$result = mysqli_query($connect, $sql);
	$exist_id = mysqli_num_rows($result);
	
	if($exist_id) {
		echo("
			<script>
				window.alert('해당 아이디가 존재합니다.');
				history.back();
			</script>
		");
		exit;
	}
	else {
		$sql = "insert into user values('$id', '$pass', '$name', '$regist_day', '$phone')";
		mysqli_query($connect, $sql);
	}
	
	mysqli_close($connect);
	echo("
		<script>
		location.href = '../main.php';
		</script>
	");
?>