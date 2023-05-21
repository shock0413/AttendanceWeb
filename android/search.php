<?php

$connect =  mysqli_connect("localhost", "root", "apmsetup", "test_db");
mysqli_set_charset($connect,"utf8");

mysqli_query($connect,"set session character_set_connection=utf8;");
mysqli_query($connect,"set session character_set_results=utf8;");
mysqli_query($connect,"set session character_set_client=utf8;");


$id = $_REQUEST[id];
$pw = $_REQUEST[password];

if(strpos($id, " ") || strpos($pw, " "))
	return;

$sql = "select * from user where user_id='$id' and user_pw='$pw';";
$result = mysqli_query($connect,$sql);

$xmlcode = "<?xml version=\"1.0\" encoding=\"utf8\"?> \n";
$xmlcode .= "<customer>\n";
while($row=mysqli_fetch_array($result))
{

	$check_id = $row[0];
	$check_password = $row[1];
	$check_name = $row[2];
	
	$xmlcode .= "<node>\n";
	$xmlcode .= "<id>$check_id</id>\n";
	$xmlcode .= "<password>$check_password</password>\n";
	$xmlcode .= "<name>$check_name</name>\n";
	$xmlcode .= "</node>\n";
	
	print("$check_id\n");
	print("$check_password\n");
	print("$check_name\n");
}
$xmlcode .= "</customer>\n";
$dir = "c://APM_Setup/htdocs";
$filename = $dir."/android/searchresult.xml";

file_put_contents($filename, $xmlcode);

mysqli_close($connect);

?>