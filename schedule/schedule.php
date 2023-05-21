<?php

	session_start();
	$table = "meeting";
?>

<html>
<head>
<meta charset="utf8">
<title>회의일정</title>
<link href="/css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="/css/schedule.css" rel="stylesheet" type="text/css" media="all">
</head>
<?
	include "../lib/dbconn.php";
	$scale = 10;
	
	$sql = "select * from $table order by meet_date desc, meet_start desc, meet_end desc, meet_id desc";
	$result = mysqli_query($connect, $sql);
	$total_record = mysqli_num_rows($result);
	
	if ($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);
	else
		$total_page = floor($total_record/$scale) + 1;
	
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
				<? include "../lib/left_menu2.php"; ?>
			</div>
		</div>
		
		<div id="col2">
			<div id="title">
				<img src="../img/title_schedule.gif">
			</div>
			<div id="schedule_list">
				<div id="list_top_title">
					<ul>
						<li id="list_title1"><img src="../img/schedule_list_title1.gif"></li>
						<li id="list_title2"><img src="../img/schedule_list_title2.gif"></li>
						<li id="list_title3"><img src="../img/schedule_list_title3.gif"></li>
						<li id="list_title4"><img src="../img/schedule_list_title4.gif"></li>
						<li id="list_title5"><img src="../img/schedule_list_title5.gif"></li>
						<li id="list_title6"><img src="../img/schedule_list_title6.gif"></li>
					</ul>
				</div>
				
				<div id="list_content">
<?
			for ($i=$start; $i<$start+$scale && $i < $total_record; $i++) {
				mysqli_data_seek($result, $i);
				$row = mysqli_fetch_array($result);
				
				$item_name = $row[1];
				$item_date = $row[2];
				$item_start = $row[3];
				$item_end = $row[4];
				$item_userid = $row[5];
				
?>
				<div id="list_item">
					<div id="list_item1"><?=$number?></div>
					<div id="list_item2"><?=$item_name?></div>
					<div id="list_item3"><?=$item_date?></div>
					<div id="list_item4"><?=$item_start?></div>
					<div id="list_item5"><?=$item_end?></div>
					<div id="list_item6"><?=$item_userid?></div>
				</div>
<?
				$number--;
			}
?>
				<div id="page_button">
				<div id="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp; 
<?
			for ($i=1; $i<=$total_page; $i++) {
				if ($page == $i) {
					echo "<b> $i </b>";
				} else {
					echo "<a href='schedule.php?page=$i'> $i </a>";
				}
			}
?>
				&nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
				</div>
				</div>
				<div id="button">
					<a href="schedule.php?page=<?=$page?>"><img src="../img/list.png"></a>&nbsp;
			</div>	<!-- End schedule_list -->
		</div>	<!-- End col2 -->
	</div>	<!-- End content -->
</div>	<!-- End wrap -->
</body>
</html>