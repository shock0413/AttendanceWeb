<?php

	session_start();
	
	include "../lib/dbconn.php";
	
	$sql = "select * from user";
	$result = mysqli_query($connect, $sql);
	$result2 = mysqli_query($connect, $sql);

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>회의설정</title>
<link href="/css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="/css/schedule.css" rel="stylesheet" type="text/css" media="all">
<script>
	function check_input() {
		var today = new Date();
		var day = today.getDate();
		if (day < 10) {
			day = "0" + day;
		}
		var month = today.getMonth()+1;
		if (month < 10) {
			month = "0" + month;
		}
		var year = today.getFullYear();
		today = year + "-" + month + "-" + day;
		var count = 0;
		if (!document.schedule_setting_form.schedule_name.value) {
			window.alert("회의명을 입력하세요.");
			document.schedule_setting_form.schedule_title.focus();
			return;
		}
		if (!document.schedule_setting_form.schedule_date.value) {
			window.alert("회의일자를 설정해주세요.");
			document.schedule_setting_form.schedule_date.focus();
			return;
		}
		if (document.schedule_setting_form.schedule_date.value < today) {
			window.alert("오늘 이후로 일자를 설정해주세요.");
			document.schedule_setting_form.schedule_date.focus();
			return;
		}
		if (!document.schedule_setting_form.schedule_start.value) {
			window.alert("시작시간을 설정해주세요.");
			document.schedule_setting_form.schedule_start.focus();
			return;
		}
		if (!document.schedule_setting_form.schedule_end.value) {
			window.alert("종료시간을 설정해주세요.");
			document.schedule_setting_form.schedule_end.focus();
			return;
		}
		if (document.schedule_setting_form.schedule_start.value > document.schedule_setting_form.schedule_end.value) {
			window.alert("종료시간이 시작시간보다 크게 해주세요.");
			document.schedule_setting_form.schedule_end.focus();
			return;
		}
<?
		while ($row = mysqli_fetch_array($result2)) {
?>
			if (document.schedule_setting_form.schedule_check_<?=$row[0]?>.checked) {
				count++;
			}
<?
		}
?>
		if (count < 1) {
			window.alert("회의 참여자를 1명 이상 선택해주세요.");
			return;
		}
		document.schedule_setting_form.submit();
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
				<? include "../lib/left_menu2.php"; ?>
			</div>
		</div>
		
		<div id="col2">
			<div id="title">
				<img src="../img/title_setting_schedule.gif">
			</div>
			<form name="schedule_setting_form" method="post" action="insert.php">
				<div id="setting_form">
					<div class="schedule_setting_line"></div>
					<div id="schedule_setting_row1"><div class="col1">회의명</div>
						<div class="col2"><input type="text" name="schedule_name"></div>
					</div>
					<div class="schedule_setting_line"></div>
					<div id="schedule_setting_row2"><div class="col1">회의일자</div>
						<div class="col2"><input type="date" name="schedule_date"></div>
					</div>
					<div class="schedule_setting_line"></div>
					<div id="schedule_setting_row3"><div class="col1">시작시간</div>
						<div class="col2"><input type="time" name="schedule_start"></div>
					</div>
					<div class="schedule_setting_line"></div>
					<div id="schedule_setting_row4"><div class="col1">종료일자</div>
						<div class="col2"><input type="time" name="schedule_end"></div>
					</div>
					<div class="schedule_setting_line"></div>
					<div id="schedule_setting_row5"><div class="col1">참석자</div>
						<div class="col2">
<?
						while ($row = mysqli_fetch_array($result)) {
?>
							<input type="checkbox" name="schedule_check_<?=$row[0]?>"><?=$row[0]?>
<?							
						}
?>					
						
						</div>
					</div>
					<div id="setting_button"><a href="#"><img src="../img/ok.png" onclick="check_input();"></a>&nbsp;
									<a href="schedule.php"><img src="../img/list.png"></a>
					</div>
				</div>	<!-- End setting_form -->
			</form>
		</div>	<!-- End col2 -->
	</div>	<!-- End content -->
</div>	<!-- End wrap -->
</body>
</html>