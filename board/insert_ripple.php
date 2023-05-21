<?
	session_start();
?>
<meta charset="utf8">
<?
   if(!$_SESSION[userid]) {
     echo("
	   <script>
	     window.alert('로그인 후 이용하세요.');
	     history.go(-1);
	   </script>
	 ");
	 exit;
   }   
   include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

   $regist_day = date("Y-m-d (H:i:s)");  // 현재의 '년-월-일-시-분'을 저장

   // 레코드 삽입 명령
   $sql = "insert into ripple (board_id, ripple_content, user_id, create_date) ";
   $sql .= "values($_REQUEST[num], '$_POST[ripple_content]', '$_SESSION[userid]', '$regist_day')";    

   mysqli_query($connect, $sql);  // $sql 에 저장된 명령 실행
   mysqli_close($connect);                // DB 연결 끊기

   echo "
	   <script>
	    location.href = 'view.php?table=$_REQUEST[table]&num=$_REQUEST[num]';
	   </script>
	";
?>

   