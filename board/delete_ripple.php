<?
      include "../lib/dbconn.php";

      $sql = "delete from ripple where ripple_id=$_REQUEST[ripple_num]";
      mysqli_query($connect, $sql);
      mysqli_close($connect);

      echo "
	   <script>
	    location.href = 'view.php?table=$_REQUEST[table]&num=$_REQUEST[num]';
	   </script>
	  ";
?>
