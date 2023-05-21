<?
   session_start();
   include "../lib/dbconn.php";

   $sql = "delete from $_REQUEST[table] where board_id = $_REQUEST[num]";
   mysqli_query($connect, $sql);

   echo "
	   <script>
	    location.href = 'board.php?table=$_REQUEST[table]';
	   </script>
	";
?>