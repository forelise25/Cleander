<link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/nanumgothic.css">
<link rel = "stylesheet" href = "css/form.css">
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

<script>

  function chk(){
	  if(!document.insert_classroom.grade.value){
		  alert("학급 정보를 입력하세요");
		  document.insert_classroom.grade.focus();
		  return;
	  }
	  if(!document.insert_classroom.passwd.value){
		  alert("비밀번호를 입력하세요");
		  document.insert_classroom.passwd.focus();
		  return;
	  }
	  if(!document.insert_classroom.passwd_rechk.value){
		  alert("비밀번호 재확인을 입력하세요");
		  document.insert_classroom.passwd_rechk.focus();
		  return;
	  }

	if(document.insert_classroom.passwd.value != document.insert_classroom.passwd_rechk.value){
		alert("비밀번호가 다릅니다.");
		document.insert_classroom.passwd_rechk.focus();
		return;
	}
	document.insert_classroom.submit();
}
</script>
<?
if($mode == 'update'){
	$query = "select * from main_category where pk = $pk";
	$result = mysql_query($query, $connect);
	$rows = mysql_fetch_array($result);
	?>
<center>
<table><tr><td>
	<form name = "insert_classroom" method="post" action = "insert_classroom_post.php?mode=<?=$mode?>&pk=<?=$rows[pk]?>" >
학급 정보를 입력해주세요. ex) 201721
<br/><br/>
<input class = "input_text" type = "text" name = "grade" value = <?=$rows[grade]?>  maxlength = 6>
<br/><br/>
비밀번호를 입력해주세요. (12자리 이내)
<br/><br/>
<input class = "input_text" type = "password" name = "passwd" maxlength=12 value = <?=stripslashes($rows[passwd])?>>
<br/><br/>
비밀번호를 다시 입력해주세요.
<br/><br/>
<input class = "input_text" type = "password" name = "passwd_rechk" maxlength=12 value = <?=stripslashes($rows[passwd])?>>
<br/><br/>
<input class = "input_but" style="margin-right:" type = "button" name = "button" value = "등록하기" onclick = "javascript:chk()">
</form>
</td></tr><table>
	<?
}
	else{
?>
<br><br/>
<center>
<table><tr><td>
<form name = "insert_classroom" method="post" action = "insert_classroom_post.php" >
학급 정보를 입력해주세요. ex) 201721
<br><br>
<input class = "input_text" type = "text" name = "grade" maxlength = 6>
<br><br>
비밀번호를 입력해주세요. (12자리 이내)
<br><br>
<input class = "input_text" type = "password" name = "passwd" maxlength=12>
<br><br>
비밀번호를 다시 입력해주세요.
<br><br>
<input  class = "input_text" type = "password" name = "passwd_rechk" maxlength=12>
<br><br>
</td></tr>
<tr><td align = "right">
<input class = "input_but" type = "button" name = "button" value = "등록하기" onclick = "javascript:chk()">
</form>
</td></tr></table>
</center>
<?
	}
?>