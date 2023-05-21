<? session_start(); ?>

<html>
<head>
<meta charset="utf8">
<title>홈페이지 소개</title>
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/introduce.css" rel="stylesheet" type="text/css" media="all">
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
				<? include "../lib/left_menu.php"; ?>
			</div>
		</div>	<!-- End col1 -->
		
		<div id="col2">
			<div id="title">
				<img src="../img/title_introduce.gif">
			</div>
			<div id="introduce">
				<h1>1. 개요<br></h1>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;현대 모든 기업에서 회의는 필수로 이루어지고 있습니다. 그리고 회의에서 결정된 사안으로 기업에 이익을 창출을 도모하기도 합니다. 하지만 구성원들의 단결성과 책임감이 부족하여 이루어 지는 회의는 무의미할 것입니다. 이것으로 인해, 기업에서는 이익율이 떨어질 것이고, 기업과 구성원들의 갈등이 빚어질 것입니다. 이러한 문제를 감안시키기고자, 개안된 프로그램입니다.<br><br></p>
				<h1>2. 사용법<br></h1>
				<div id="img1">
					<img style="width:380px;" src="../img/descript1.png">
					<img style="float:right; margin-right:10px; width:380px;" src="../img/descript2.png">
				</div>
				<div id="descript1">
					<p>1. 웹페이지에 접속 후 회원가입 및 로그인을 합니다.</p>
					<p>2. 회의에 대한 설정을 저장합니다.</p>
				</div>
				<div style="margin-top:50px;" id="img2">
					<img style="margin-left:40px; width:300px;" src="../img/descript3.png">
					<img style="float:right; margin-right:50px; width:300px;" src="../img/descript4.png">
				</div>
				<div id="descript2">
					<p>3. 회의 일정대로 장소에 도착하여 앱을 실행시키고 로그인합니다.</p>
					<p>4. 메뉴 화면에서 자동적으로 출석합니다.</p>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>