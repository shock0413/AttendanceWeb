	<div id="logo"><a href="../main.php"><img src="../img/logo.jpg" /><img id="logo_img" src="../img/meet_logo.jpeg"></div>
	<div id="moto"><img src="../img/moto.jpg"></div>

	<div id="top_login">
<?
	if(!$_SESSION[userid])
	{
?>
		<a href="../login/login_form.php">로그인</a> | <a href="../member/member_form.php">회원가입</a>
<?
	}
	else
	{
?>
		<a href="../login/logout.php">로그아웃</a> | <a href="../login/member_form_modify.php">정보수정</a> <br> 
		<? echo("$_SESSION[username]"); ?>님 환영합니다.
<?
	}
?>
	</div>