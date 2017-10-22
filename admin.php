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
<script language="javascript">
		function open_win(theURL, winName,features){
			window.open(theURL, winName, features);
		}
</script>
<center>
<a href = "javascript:window.history.back()">로그아웃</a><br>
<br>
<form name = "form1" method = "post" action = "javascript:window.open('insert_classroom.php', '', 'width=500, height=500')">
<table width='80%' cellpadding='0' cellspacing='1' bgcolor="#cccccc" style="padding:5px;">
	<tr>
		<td align="center" colspan='3'>
		<h3>classroom 관리</h3>
		</td>
	</tr>
	<tr style="margin-bottom:2pt;">
		<td align="center"><b>교실</b></td>
		<td align="center"><b>비밀번호</b></td>
		<td align="center"><b>비고</b></td>
	</tr>
<?
  $query = "select * from main_category order by grade";
  $result = mysql_query($query,$connect);

  while ($rows = mysql_fetch_array($result)){ 
	  if($rows[passwd] =='mirim') continue;
?>
	<tr>
		<td align="center">
		<?=$rows[grade]?>
		</td>
		<td align="center">
		<?=stripslashes($rows[passwd])?>
		</td>
		<td align="center">
			<a href = "javascript:window.open('insert_classroom.php?mode=update&pk=<?=$rows[pk]?>','','width=500,height=350, top=160,left=420')">수정</a> <font color="#999999"> | </font> <a href = "classroom_del.php?pk=<?=$rows[pk]?>" onclick = "return confirm('정말 삭제하시겠습니까?')">삭제</a>
		</td>
	</tr>
<?
    }
?>
</table>
<br>
<input type = "submit" name = "insert_classroom" value = "교실등록">
</form>
<!------------------------------------------------------------------------------>
<br>
<form name = "form2" method = "post" action = "javascript:window.open('insert_major.php', '', 'width=500, height=500')">
<table width='80%' cellpadding='0' cellspacing='1' bgcolor="#cccccc" style="padding:5px;">
	<tr align="center">
		<td align="center" colspan="4"><h3>과목 관리</h3></td>
	</tr>
	<tr align="center">
		<td align="center"><b>학년</b></td>
	    <td align="center"><b>학과</b></td>
	    <td align="center"><b>과목</b></td>
	    <td align="center"><b>비고</b></td>
	</tr>
<?
	$query1 = "select * from subject_table ORDER BY subject_grade ASC , subject_major ASC, id ASC";
	$result1 = mysql_query($query1,$connect);
	
	while ($rows = mysql_fetch_array($result1)){ 

?>
	<tr align="center">
	    <td align="center"><?=$rows[subject_grade]?>학년</td>
	    <td align="center"><?=$rows[subject_major]?>과</td>
	    <td align="center"><?=stripslashes($rows[subject_name])?></td>
	    <td align="center">
		  <a href = "javascript:window.open('insert_major.php?mode=update&pk=<?=$rows[subject_pk]?>','','width=400,height=250, left=460, top=200')">수정</a> <font color="#999999">| </font><a href = "major_del.php?pk=<?=$rows[subject_pk]?>" onclick = "return confirm('정말 삭제하시겠습니까?')">삭제</a>
	    </td>
	</tr>
<?
     }
?>
</table>
<br>
<input type = "submit" name = "insert_subject" value = "과목추가">
</form>
</center>