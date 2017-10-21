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
<form name = "form1" method = "post" action = "javascript:window.open('insert_classroom.php', '', 'width=500, height=500')">
<table width='80%' cellpadding='0' cellspacing='1' bgcolor="#999999">
	<tr>
		<td align="center">
		 classroom 관리
		</td>
	</tr>
	<tr>
		<td align="center">
		교실
		</td>
		<td align="center">
		비밀번호
		</td>
	</tr>
	<?
	  $query = "select * from main_category order by grade";//201721, 201722 이렇게 정렬해옴
	  $result = mysql_query($query,$connect);
	  while ($rows = mysql_fetch_array($result)){ 
		  if($rows[passwd] =='mirim') continue;//관리자의 정보를 제외하고 테이블에 출력
	?>
	<tr>
		<td>
		<?=$rows[grade]?>
		</td>
		<td>
		<?=stripslashes($rows[passwd])?>
		</td>
		<td>
			<a href = "javascript:window.open('insert_classroom.php?mode=update&pk=<?=$rows[pk]?>','','width=500,height=500')">수정</a> | <a href = "classroom_del.php?pk=<?=$rows[pk]?>" onclick = "return confirm('정말 삭제하시겠습니까?')">삭제</a>
		</td>
	</tr>
	<?
	  }//end of while
	?>
</table>
<input type = "submit" name = "insert_classroom" value = "교실등록">
</form>

<!--------------------------------------------------------------------------------------------------------------------->

<form name = "form2" method = "post" action = "javascript:window.open('insert_major.php', '', 'width=500, height=500')">
<table width='80%' cellpadding='0' cellspacing='1' bgcolor="#999999">
	<tr>
		<td align="center">
		 과목 관리
		</td>
	</tr>
	<?
	$query1 = "select * from subject_table ORDER BY subject_grade ASC , subject_major ASC, id ASC";
    $result1 = mysql_query($query1,$connect);
	
	while ($rows = mysql_fetch_array($result1)){ 
	?>
		<tr>
			<td><?=$rows[subject_grade]?>학년</td>
			<td><?=$rows[subject_major]?>과</td>
			<td><?=stripslashes($rows[subject_name])?></td>
			<td>
				<a href = "javascript:window.open('insert_major.php?mode=update&pk=<?=$rows[subject_pk]?>','','width=500,height=500')">수정</a> | <a href = "major_del.php?pk=<?=$rows[subject_pk]?>" onclick = "return confirm('정말 삭제하시겠습니까?')">삭제</a>
			</td>
		</tr>
	<?
	}//end of while
	?>

</table>
<input type = "submit" name = "insert_subject" value = "과목추가">
</form>