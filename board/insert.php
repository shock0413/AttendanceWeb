<? session_start(); ?>
<meta charset="utf8">
<?
	if(!$_SESSION[userid]) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.');
	     history.go(-1);
	   </script>
		");
		exit;
	}

	$regist_day = date("Y-m-d (H:i:s)");  // 현재의 '년-월-일-시-분-초'을 저장
    
    include "../lib/dbconn.php";       // dconn.php 파일을 불러옴
	
    if ($_REQUEST[mode]=="modify")
	{
		$sql = "update $_REQUEST[table] set board_title = '$_POST[title]', board_content = '$_POST[content]' where board_id = $_REQUEST[num]";   // get target record
		$result = mysqli_query($connect,$sql);
    } else {
        $sql = "insert into $_REQUEST[table] (board_title, board_content, board_date, user_id) values ('$_POST[title]', '$_POST[content]', '$regist_day', '$_SESSION[userid]')";
        mysqli_query($connect, $sql);
    }
    
    echo "
	   <script>
	    location.href = 'board.php?table=$_REQUEST[table]&page=$_REQUEST[page]';
	   </script>
	";
	
?>