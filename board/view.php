<?

    session_start();
    include "../lib/dbconn.php";
    $sql = "select * from $_REQUEST[table] where board_id = $_REQUEST[num]";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    
    $item_num = $row[0];
    $item_title = $row[1];
    $item_content = $row[2];
    $item_date = $row[3];
    $item_userid = $row[4];
    $item_hit = $row[5];
	if (!$_SESSION[userid]=="admin" || !$_SESSION[userid] == $item_userid) {	// 로그인한 사용자가 관리자이거나 게시글의 작성자가 아닌 사용자가 글을 볼 경우 조회 수 증가
		$sql = "select * from $_REQUEST[table] where board_id = $_REQUEST[num]";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);
		$item_hit = $row[5];
    
		$new_hit = $item_hit + 1;
		$sql = "update $_REQUEST[table] set hit=$new_hit where board_id=$item_num";   // 글 조회수 증가시킴
		mysqli_query($connect,$sql);
	}
	$sql = "select * from $_REQUEST[table] where board_id = $_REQUEST[num]";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
	$item_hit = $row[5];
?>

<html>
<head>
<meta charset="utf8">
<title>게시판</title>
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/board.css" rel="stylesheet" type="text/css" media="all">
<script>
	function check_input()
	{
		if (!document.ripple_form.ripple_content.value)
		{
			alert("내용을 입력하세요!");    
			document.ripple_form.ripple_content.focus();
			return;
		}
		document.ripple_form.submit();
    }

    function del(href) 
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
    }
</script>
</head>

<body>
<div id="wrap">
    <div id="header">
        <? include "../lib/top_login2.php"; ?>
    </div>  <!-- End header -->
    
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
                <img src="../img/title_free.gif";>
            </div>
            
            <div id="view_comment"></div>
            <div id="view_title">
                <div id="view_title1"><?=$item_title?></div><div id="view_title2"><?=$item_userid?> | 조회 : <?= $item_hit ?>
                                        | <?=$item_date?></div>
            </div>
            
            <div id="view_content">
                <?=$item_content?>
            </div>
			
			<div id="ripple">
<?
			$sql = "select * from ripple where board_id=$item_num order by create_date";
			$ripple_result = mysqli_query($connect, $sql);
			
			while ($row_ripple = mysqli_fetch_array($ripple_result)) {
				$ripple_num = $row_ripple[0];
				$board_id = $row_ripple[1];
				$ripple_content = $row_ripple[2];
				$ripple_userid = $row_ripple[3];
				$ripple_date = $row_ripple[4];
?>
			<div id="ripple_writer_title">
			<ul>
			<li id="writer_title1"><?=$ripple_userid?></li>
			<li id="writer_title2"><?=$ripple_date?></li>
			<li id="writer_title3">
			  <? 
					if($_SESSION[userid]=="admin" || $_SESSION[userid]==$ripple_userid)
			          echo "<a href='delete_ripple.php?table=$_REQUEST[table]&num=$item_num&ripple_num=$ripple_num'>[삭제]</a>"; 
			  ?>
			</li>
			</ul>
			</div>
			<div id="ripple_content"><?=$ripple_content?></div>
			<div class="hor_line_ripple"></div>
<?
			}
?>
			<form  name="ripple_form" method="post" action="insert_ripple.php?table=<?=$_REQUEST[table]?>&num=<?=$item_num?>">  
			<div id="ripple_box">
				<div id="ripple_box1"><img src="../img/title_comment.gif"></div>
				<div id="ripple_box2"><textarea rows="5" cols="65" name="ripple_content"></textarea>
				</div>
				<div id="ripple_box3"><a href="#"><img src="../img/ok_ripple.gif"  onclick="check_input()"></a></div>
			</div>
			</form>
			</div>	<!-- End ripple -->
			
			<div id="view_button">
				<a href="board.php?table=<?=$table?>&page=<?=$page?>"><img src="../img/list.png"></a>&nbsp;
<? 
	if($_SESSION[userid] && ($_SESSION[userid]==$item_userid))
	{
?>
				<a href="write_form.php?table=<?=$_REQUEST[table]?>&mode=modify&num=<?=$_REQUEST[num]?>&page=<?=$_REQUEST[num]?>"><img src="../img/modify.png"></a>&nbsp;
				<a href="javascript:del('delete.php?table=<?=$_REQUEST[table]?>&num=<?=$_REQUEST[num]?>')"><img src="../img/delete.png"></a>&nbsp;
<?
	}
?>
<? 
	if($_SESSION[userid])
	{
?>
				<a href="write_form.php?table=<?=$_REQUEST[table]?>"><img src="../img/write.png"></a>
<?
	}
?>
		</div>
		<div class="clear"></div>

        </div>	<!-- End col2 -->
    </div>  <!-- End content -->
</div>  <!-- End wrap -->
</body>
</html>