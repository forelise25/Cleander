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
  //mysql ����
  $connect = my_connect($host, $dbid, $dbpass, $dbname);

 //������������ �ٷ� ��� �� 
?>

<script>
  function chk(){
	  if(!document.insert_classroom.grade.value){
		  alert("�б� ������ �Է��ϼ���");
		  document.insert_classroom.grade.focus();
		  return;
	  }
	  if(!document.insert_classroom.passwd.value){
		  alert("��й�ȣ�� �Է��ϼ���");
		  document.insert_classroom.passwd.focus();
		  return;
	  }
	  if(!document.insert_classroom.passwd_rechk.value){
		  alert("��й�ȣ ��Ȯ���� �Է��ϼ���");
		  document.insert_classroom.passwd_rechk.focus();
		  return;
	  }

	if(document.insert_classroom.passwd.value != document.insert_classroom.passwd_rechk.value){
		alert("��й�ȣ�� �ٸ��ϴ�.");
		document.insert_classroom.passwd_rechk.focus();
		return;
	}
	document.insert_classroom.submit();
}
</script>
<?
if($mode == 'update'){ //[����]�� ������ ���
	$query = "select * from main_category where pk = $pk"; //[����]�� ���� ���ڵ带 ������
	$result = mysql_query($query, $connect);
	$rows = mysql_fetch_array($result);
	?>
	<form name = "insert_classroom" method="post" action = "insert_classroom_post.php?mode=<?=$mode?>&pk=<?=$rows[pk]?>">
		�б� ������ �Է����ּ���. ex) 201721<br>
		<input type = "text" name = "grade" value = <?=$rows[grade]?>  maxlength = 6><br>
		��й�ȣ�� �Է����ּ���. (12�ڸ� �̳�)<br>
		<input type = "password" name = "passwd" maxlength=12 value = <?=stripslashes($rows[passwd])?>><br>
		��й�ȣ�� �ٽ� �Է����ּ���.<br>
		<input type = "password" name = "passwd_rechk" maxlength=12 value = <?=stripslashes($rows[passwd])?>><br>
		<input type = "button" name = "button" value = "����ϱ�" onclick = "javascript:chk()">
	</form>
	<?
}
else{ //���� ����� ���
?>
	<form name = "insert_classroom" method="post" action = "insert_classroom_post.php" >
	�б� ������ �Է����ּ���. ex) 201721
	<br>
	<input type = "text" name = "grade" maxlength = 6>
	<br>
	��й�ȣ�� �Է����ּ���. (12�ڸ� �̳�)
	<br>
	<input type = "password" name = "passwd" maxlength=12>
	<br>
	��й�ȣ�� �ٽ� �Է����ּ���.
	<br>
	<input type = "password" name = "passwd_rechk" maxlength=12>
	<br>
	<input type = "button" name = "button" value = "����ϱ�" onclick = "javascript:chk()">
	</form>
<?
}//end of else
?>