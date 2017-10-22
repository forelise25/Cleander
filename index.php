
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<?
  $host="localhost";
  $dbid="root";
  $dbpass="1234";
  $dbname="scheduler";
  
  function my_connect($host,$id,$pass,$db){
	$connect=mysql_connect($host,$id,$pass);
	mysql_select_db($db);
	return $connect;
  }
  //mysql 연결
  $connect = my_connect($host, $dbid, $dbpass, $dbname);

?>
<link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/nanumgothic.css">
<link rel = "stylesheet" href = "css/form.css">
<html>
<head>
<title></title>
</head>
<body>
<table width="100%" height="100%" cellspacing="0" cellpadding="0" background = "img/background.png" border="0" style="background-repeat:no-repeat;"> 
<tr>
<td>
  <center>
	 <table height = "600sp" cellspacing = "30sp" align = "top">
		<tr style = "vertical-align: bottom;"><td>
		<img src="img/main_logo.png" width="265" height = "200">
		</td></tr>
		<tr style = "vertical-align: top;"><td>
		<form name="form1" method="post" action="calender.php">
		  <input type="password" name="passwd" maxlength="20" class = "rounded1" placeholder = "비밀번호를 입력하세요" style = "text-align:center">
		  <input type="submit" name="submit" value = "확인" class = "rounded2">
		  <input type="hidden" name = "mode" value = "search">
	   </form>
	   </tr></td>
	</table>
  </center>
  </td>
  <tr>
  </table>
</body>
</html>