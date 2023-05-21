<meta charset="utf8">
<?php

	$connect = mysqli_connect('localhost', 'root', 'apmsetup', 'test_db');
	mysqli_set_charset($connect, "utf8");
	
	$title = $_GET[title];
	$content = $_GET[content];
	$user_id = $_GET['id'];
	$regist_day = date("Y-m-d (H:i:S)");
	
	$last_id_sql = "select board_id from board order by board_id desc";
	$result = mysqli_query($connect, $last_id_sql);

	$row = mysqli_fetch_array($result);
	$last_id = $row[0];
	
	$sql = "insert into board(board_title, board_content, board_date, user_id)";
	$sql .= " values('{$title}', '{$content}', '{$regist_day}', '{$user_id}');";
	$result = mysqli_query($connect, $sql);
	
?>