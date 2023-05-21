<?
    session_start();
    $table = "board";
    $ripple = "ripple";
?>

<html>
<head>
<meta charset="utf8">
<title>게시판</title>
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/board.css" rel="stylesheet" type="text/css" media="all">
</head>
<?
    include "../lib/dbconn.php";
    $scale = 10;
    
    if ($_REQUEST[mode]=="search") {
        if (!$_REQUEST[search]) {
            echo ("
                <script>
                    window.alert('검색할 단어를 입력해 주세요!');
                    history.go(-1);
                </script>
            ");
            exit;
        }
        $sql = "select * from $table where $_REQUEST[find] like '$_REQUEST[search]' order by board_date desc, board_id desc";
    } else {
        $sql = "select * from $table order by board_date desc, board_id desc";
    }
    
    $result = mysqli_query($connect, $sql);
    $total_record = mysqli_num_rows($result);
    
    if ($total_record % $scale == 0)
        $total_page = floor($total_record/$scale);
    else
        $total_page = floor($total_record/$scale) + 1;
	
	if ($_REQUEST[page])
		$page = $_REQUEST[page];
    
    if (!$page)
        $page = 1;
    
    $start = ($page - 1) * $scale;
    $number = $total_record - $start;
?>

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

		<form  name="board_form" method="post" action="board.php?table=<?=$table?>&mode=search"> 
		<div id="list_search">
			<div id="list_search1">▷ 총 <?= $total_record ?> 개의 게시물이 있습니다.  </div>
			<div id="list_search2"><img src="../img/select_search.gif"></div>
			<div id="list_search3">
				<select name="find">
                    <option value='board_title'>제목</option>
                    <option value='board_content'>내용</option>
                    <option value='user_id'>작성자</option>
				</select></div>
			<div id="list_search4"><input type="text" name="search"></div>
			<div id="list_search5"><input type="image" src="../img/list_search_button.gif"></div>
		</div>
		</form>
		<div class="clear"></div>

		<div id="list_top_title">
			<ul>
				<li id="list_title1"><img src="../img/list_title1.gif"></li>
				<li id="list_title2"><img src="../img/list_title2.gif"></li>
				<li id="list_title3"><img src="../img/list_title3.gif"></li>
				<li id="list_title4"><img src="../img/list_title4.gif"></li>
				<li id="list_title5"><img src="../img/list_title5.gif"></li>
			</ul>		
		</div>

		<div id="list_content">
<?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
      mysqli_data_seek($result, $i);     // 포인터 이동        
      $row = mysqli_fetch_array($result); // 하나의 레코드 가져오기	      
      
	  $item_num = $row[0];
	  $item_title = $row[1];
      $item_date = $row[3];
	  $item_userid = $row[4];
      $item_hit = $row[5];
	  $item_date = substr($item_date, 0, 10);

	  $sql = "select * from $ripple where board_id=$item_num";
	  $result2 = mysqli_query($connect, $sql);
      if ($result2)
        $num_ripple = mysqli_num_rows($result2);
      

?>
			<div id="list_item">
				<div id="list_item1"><?= $number ?></div>
				<div id="list_item2"><a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>"><?= $item_title ?></a>
<?
		if ($num_ripple)
				echo " [$num_ripple]";
?>
				</div>
				<div id="list_item3"><?= $item_userid ?></div>
				<div id="list_item4"><?= $item_date ?></div>
				<div id="list_item5"><?= $item_hit ?></div>
			</div>
<?
   	   $number--;
   }
?>
			<div id="page_button">
				<div id="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp; 
<?
   // 게시판 목록 하단에 페이지 링크 번호 출력
   for ($i=1; $i<=$total_page; $i++)
   {
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<b> $i </b>";
		}
		else
		{ 
			echo "<a href='board.php?table=$table&page=$i'> $i </a>";
		}      
   }
?>			
			&nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
				</div>
				<div id="button">
					<a href="board.php?table=<?=$table?>&page=<?=$page?>"><img src="../img/list.png"></a>&nbsp;
<? 
	if($_SESSION[userid])
	{
?>
		<a href="write_form.php?table=<?=$table?>"><img src="../img/write.png"></a>
<?
	}
?>
				</div>
			</div> <!-- end of page_button -->		
        </div> <!-- end of list content -->
		<div class="clear"></div>

	</div> <!-- end of col2 -->
    </div>  <!-- End content -->
</div>
</body>
</html>