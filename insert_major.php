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
	  if(!document.insert_major.subject_name.value){
		  alert("과목명을 입력하세요");
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
	학년<br>
	</td></tr>
	<tr><td>
  <select name='subject_major'>
  <? if($rows[subject_major] == "인터랙티브미디어"){ ?>
    <option value = "인터랙티브미디어" selected>인터랙티브미디어
  <? } else{ ?>
    <option value = "인터랙티브미디어">인터랙티브미디어
  <? } ?>

   <? if($rows[subject_major] == "뉴미디어디자인"){ ?>
    <option value = "뉴미디어디자인" selected>뉴미디어디자인
  <? } else{ ?>
    <option value = "뉴미디어디자인">뉴미디어디자인
  <? } ?>
	
  <? if($rows[subject_major] == "뉴미디어솔루션"){ ?>
    <option value = "뉴미디어솔루션" selected>뉴미디어솔루션
  <? } else{ ?>
    <option value = "뉴미디어솔루션">뉴미디어솔루션
  <? } ?>
	</select>과<br>
	</td></tr>
	<tr><td>
	과목명: <input class = "input_text_2" type = "text" name = "subject_name" value = <?=stripslashes($rows[subject_name])?>>
	<input type = "button" value = "수정하기" onclick = "javascript:chk()">
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
 <select class = "input_select"  name='subject_grade'> <!-- 여기서 php로 if문걸어서 select 걸기!-->
			<option value = "1">1
			<option value = "2">2
			<option value = "3">3
	</select>
	학년<br>
	</td></tr>
	<tr><td>
	 <select class = "input_select" name='subject_major'>
			<option value = "인터랙티브미디어">인터랙티브미디어
			<option value = "뉴미디어디자인">뉴미디어디자인
			<option value = "뉴미디어솔루션">뉴미디어솔루션
	</select>
	과<br>
	</td></tr>
	<tr><td>
	과목명: <input class = "input_text_2" type = "text" name = "subject_name">
	</td></tr>
	<tr><td align = "right">
	<input class = "input_but" type = "button" value = "추가하기" onclick = "javascript:chk()">
	</td><tr>
	</table>
	</center>
<?
	}
?>