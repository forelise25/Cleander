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
	<form name = "insert_major" method="post" action = "insert_major_post.php?mode=update&pk=<?=$pk?>" >
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
	과목명: <input type = "text" name = "subject_name" value = <?=stripslashes($rows[subject_name])?>>
	<input type = "button" value = "수정하기" onclick = "javascript:chk()">
    </form>
	<?
    } //if($mode == 'update')
  
  else{
?>
<form name = "insert_major" method="post" action = "insert_major_post.php" >
 <select name='subject_grade'> <!-- 여기서 php로 if문걸어서 select 걸기!-->
			<option value = "1">1
			<option value = "2">2
			<option value = "3">3
	</select>
	학년<br>
	 <select name='subject_major'>
			<option value = "인터랙티브미디어">인터랙티브미디어
			<option value = "뉴미디어디자인">뉴미디어디자인
			<option value = "뉴미디어솔루션">뉴미디어솔루션
	</select>
	과<br>
	과목명: <input type = "text" name = "subject_name">
	<br>
	<input type = "button" value = "추가하기" onclick = "javascript:chk()">
<?
	}
?>