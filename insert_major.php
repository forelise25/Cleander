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
  //mysql ����
  $connect = my_connect($host, $dbid, $dbpass, $dbname);

?>
 <script>

  function chk(){
	  if(!document.insert_major.subject_name.value){
		  alert("������� �Է��ϼ���");
		  document.insert_major.subject_name.focus();
		  return false;
	  }
	document.insert_major.submit();
}
</script>
<?
  if($mode == 'update'){
	  $query = "select * from subject_table where subject_pk = $pk";
    $result = mysql_query($query, $connect);
	$rows=mysql_fetch_array($result);
	?>
	<center>
	<form name = "insert_major" method="post" action = "insert_major_post.php?mode=update&pk=<?=$pk?>" >
	<table cellpadding = "5px"><tr><td>
	<select name='subject_grade'>
	<? 
	
	$cnt = 1;
	while($cnt <= 3){
	  if($rows[subject_grade] == $cnt){
	?>
	   <option value = "<?=$cnt?>" selected><?=$cnt?>
	   <?
	}
	else{
	?>
	<option value = "<?=$cnt?>"><?=$cnt?>
<?}

$cnt++;
 
	}?>
		
	</select>
	�г�<br>
	</td></tr>
	<tr><td>
  <select name='subject_major'>
  <? if($rows[subject_major] == "���ͷ�Ƽ��̵��"){ ?>
    <option value = "���ͷ�Ƽ��̵��" selected>���ͷ�Ƽ��̵��
  <? } else{ ?>
    <option value = "���ͷ�Ƽ��̵��">���ͷ�Ƽ��̵��
  <? } ?>

   <? if($rows[subject_major] == "���̵�������"){ ?>
    <option value = "���̵�������" selected>���̵�������
  <? } else{ ?>
    <option value = "���̵�������">���̵�������
  <? } ?>
	
  <? if($rows[subject_major] == "���̵��ַ��"){ ?>
    <option value = "���̵��ַ��" selected>���̵��ַ��
  <? } else{ ?>
    <option value = "���̵��ַ��">���̵��ַ��
  <? } ?>
	</select>��<br>
	</td></tr>
	<tr><td>
	�����: <input class = "input_text_2" type = "text" name = "subject_name" value = <?=stripslashes($rows[subject_name])?>>
	<input type = "button" value = "�����ϱ�" onclick = "javascript:chk()">
	</td></tr></table>
    </form>
	</center>
	<?
    } //if($mode == 'update')
  
  else{
?>
<form name = "insert_major" method="post" action = "insert_major_post.php" >
<center>
<br/>
<table cellpadding = "5px" height = "200xp"><tr><td>
 <select class = "input_select"  name='subject_grade'> <!-- ���⼭ php�� if���ɾ select �ɱ�!-->
			<option value = "1">1
			<option value = "2">2
			<option value = "3">3
	</select>
	�г�<br>
	</td></tr>
	<tr><td>
	 <select class = "input_select" name='subject_major'>
			<option value = "���ͷ�Ƽ��̵��">���ͷ�Ƽ��̵��
			<option value = "���̵�������">���̵�������
			<option value = "���̵��ַ��">���̵��ַ��
	</select>
	��<br>
	</td></tr>
	<tr><td>
	�����: <input class = "input_text_2" type = "text" name = "subject_name">
	</td></tr>
	<tr><td align = "right">
	<input class = "input_but" type = "button" value = "�߰��ϱ�" onclick = "javascript:chk()">
	</td><tr>
	</table>
	</center>
<?
	}
?>