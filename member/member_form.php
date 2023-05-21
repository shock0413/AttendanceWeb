<?
	session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<link rel="stylesheet" type="text/css" href="../css/common.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/member.css" media="all">
<script type="text/javascript">
	function check_id() {
		window.open("check_id.php?id=" + document.member_form.id.value,
			"IDcheck",
			"left=200,top=200,width=200,height=60,scrollbars=no,resizable=yes");
	}
	
	function check_input() {
		if (!document.member_form.id.value) {
			alert("아이디를 입력하세요.");
			document.member_form.id.focus();
			return;
		}
		
		if (!document.member_form.pass.value) {
			alert("비밀번호를 입력하세요.");
			document.member_form.pass.focus();
			return;
		}
		
		if (!document.member_form.pass_confirm.value) {
			alert("비밀번호확인을 입력하세요.");
			document.member_form.pass_confirm.focus();
			return;
		}
		
		if (!document.member_form.name.value) {
			alert("이름을 입력하세요.");
			document.member_form.name.focus();
			return;
		}
		
		if (document.member_form.pass.value !=
			document.member_form.pass_confirm.value) {
			alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");
			document.member_form.pass.focus();
			document.member_form.pass.select();
			return;
		}
		if (!document.member_form.phone.value) {
			alert("휴대폰 번호를 입력하세요.");
			document.member_form.phone.focus();
			return;
		}
		document.member_form.submit();
	}
	
	function reset_form() {
		document.member_form.id.value = "";
		document.member_form.pass.value = "";
		document.member_form.pass_confirm.value = "";
		document.member_form.name.value = "";
		
		document.member_form.id.focus();
		
		return;
	}
</script>
<title>회원가입</title>
</head>

<body>
<div id="wrap">
	<div id="header">
		<? include "../lib/top_login2.php"; ?>
	</div>	<!-- End : header -->
	
	<div id="menu">
		<? include "../lib/top_menu2.php"; ?>
	</div>	<!-- End : menu -->
	
	<div id="content">
		<div id="col1">
			<div id="left_menu">
<?
				include "../lib/left_menu.php";
?>
			</div>	<!-- End : left_menu -->
		</div>	<!-- End : col1 -->
		
		<div id="col2">
		<form name="member_form" method="post" action="insert.php">
		<div id="title">
			<img src="../img/title_join.gif">
		</div>	<!-- End : title -->
		
		<div id="form_join">
			<div id="join1">
			<ul>
			<li>* 아이디</li>
			<li>* 비밀번호</li>
			<li>* 비밀번호 확인</li>
			<li>* 이름</li>
			<li>* 휴대폰 번호</li>
			</ul>
			</div>	<!-- End : join1 -->
			<div id="join2">
			<ul>
			<li><div id="id1"><input type="text" name="id"></div><div id="id2"><a href="#"><img src="../img/check_id.gif" onclick="check_id();"></a></div><div id="id3">4~12자의 영문 소문자, 숫자와 특수기호(_)만 사용할 수 있습니다.</div></li>
			<li><input type="password" name="pass"></li>
			<li><input type="password" name="pass_confirm"></li>
			<li><input type="text" name="name"></li>
			<li><input type="number" name="phone"></li>
			</ul>
			</div>	<!-- End : join2 -->
			<div class="clear"></div>
			<div id="must">* 는 필수 입력항목입니다.</div>
		</div>	<!-- End : form_join -->
		<div id="button">
			<a href="#"><img src="../img/button_save.gif" onclick="check_input();"></a>&nbsp;&nbsp;
			<a href="#"><img src="../img/button_reset.gif" onclick="reset_form();"></a>
		</div>	<!-- End : button -->
		</form>
		</div>	<!-- End : col2 -->
	</div>	<!-- End : content -->
</div>	<!-- End : wrap -->
</body>
</html>