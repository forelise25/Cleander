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
<form name = "form1" method = "post" action = "javascript:window.open('insert_classroom.php', '', 'width=500, height=500')">
<table width='80%' cellpadding='0' cellspacing='1' bgcolor="#999999">
	<tr>
		<td align="center">
		 classroom ����
		</td>
	</tr>
	<tr>
		<td align="center">
		����
		</td>
		<td align="center">
		��й�ȣ
		</td>
	</tr>
	<?
	  $query = "select * from main_category order by grade";//201721, 201722 �̷��� �����ؿ�
	  $result = mysql_query($query,$connect);
	  while ($rows = mysql_fetch_array($result)){ 
		  if($rows[passwd] =='mirim') continue;//�������� ������ �����ϰ� ���̺� ���
	?>
	<tr>
		<td>
		<?=$rows[grade]?>
		</td>
		<td>
		<?=stripslashes($rows[passwd])?>
		</td>
		<td>
			<a href = "javascript:window.open('insert_classroom.php?mode=update&pk=<?=$rows[pk]?>','','width=500,height=500')">����</a> | <a href = "classroom_del.php?pk=<?=$rows[pk]?>" onclick = "return confirm('���� �����Ͻðڽ��ϱ�?')">����</a>
		</td>
	</tr>
	<?
	  }//end of while
	?>
</table>
<input type = "submit" name = "insert_classroom" value = "���ǵ��">
</form>

<!--------------------------------------------------------------------------------------------------------------------->

<form name = "form2" method = "post" action = "javascript:window.open('insert_major.php', '', 'width=500, height=500')">
<table width='80%' cellpadding='0' cellspacing='1' bgcolor="#999999">
	<tr>
		<td align="center">
		 ���� ����
		</td>
	</tr>
	<?
	$query1 = "select * from subject_table ORDER BY subject_grade ASC , subject_major ASC, id ASC";
    $result1 = mysql_query($query1,$connect);
	
	while ($rows = mysql_fetch_array($result1)){ 
	?>
		<tr>
			<td><?=$rows[subject_grade]?>�г�</td>
			<td><?=$rows[subject_major]?>��</td>
			<td><?=stripslashes($rows[subject_name])?></td>
			<td>
				<a href = "javascript:window.open('insert_major.php?mode=update&pk=<?=$rows[subject_pk]?>','','width=500,height=500')">����</a> | <a href = "major_del.php?pk=<?=$rows[subject_pk]?>" onclick = "return confirm('���� �����Ͻðڽ��ϱ�?')">����</a>
			</td>
		</tr>
	<?
	}//end of while
	?>

</table>
<input type = "submit" name = "insert_subject" value = "�����߰�">
</form>