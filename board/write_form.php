<?
    session_start();
    include "../lib/dbconn.php";
    
    if ($_REQUEST[mode]=="modify") {
        $sql = "select * from $_REQUEST[table] where board_id=$_REQUEST[num]";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        
        $item_title = $row[1];
        $item_content = $row[2];
    }
?>

<html>
<head>
<meta charset="utf8">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/board.css" rel="stylesheet" type="text/css" media="all">
<script>
  function check_input()
   {
      if (!document.board_form.title.value)
      {
          window.alert("제목을 입력하세요1");    
          document.board_form.subject.focus();
          return;
      }

      if (!document.board_form.content.value)
      {
          window.alert("내용을 입력하세요!");    
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }
</script>
</head>

<body>
<div id="wrap">
    <div id="header">
        <? include "../lib/top_login2.php"; ?>
    </div>
    
    <div id="menu">
        <? include "../lib/top_menu2.php"; ?>
    </div>
    
    <div id="content">
        <div id="col1">
            <div id="left_menu">
<?
                include "../lib/left_menu.php";
?>
            </div>
        </div>  <!-- End col1 -->
        
        <div id="col2">
            <div id="title">
                <img src="../img/title_free.gif">
            </div>
            <div class="clear"></div>

            <div id="write_form_title">
                <img src="../img/write_form_title.gif">
            </div>
            <div class="clear"></div>
<?
        if ($_REQUEST[mode]=="modify") {
?>
            <form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$_REQUEST[num]?>&page=<?=$_REQUEST[page]?>&table=<?=$_REQUEST[table]?>" enctype="multipart/form-data"> 
<?
        } else {
?>
            <form  name="board_form" method="post" action="insert.php?table=<?=$_REQUEST[table]?>" enctype="multipart/form-data">
<?
        }
?>
            <div id="write_form">
                <div class="write_line"></div>
			<div id="write_row1"><div class="col1"> 아이디 </div><div class="col2"><?=$_SESSION[userid]?></div>
            </div>
			<div class="write_line"></div>
            <div id="write_row2"><div class="col1"> 제목   </div>
			                     <div class="col2"><input type="text" name="title" value="<?=$item_title?>" ></div>
			</div>
			<div class="write_line"></div>
            <div id="write_row3"><div class="col1"> 내용   </div>
			                     <div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
			</div>
			<div class="write_line"></div>
            <div id="write_button"><a href="#"><img src="../img/ok.png" onclick="check_input();"></a>&nbsp;
								<a href="board.php?table=<?=$_REQUEST[table]?>&page=<?=$_REQUEST[page]?>"><img src="../img/list.png"></a>
            </div>
			</div>	<!-- End write_form -->
            </form>
        </div>  <!-- End col2 -->
    </div>  <!-- End content -->
</div>  <!-- End wrap -->
</body>
</html>