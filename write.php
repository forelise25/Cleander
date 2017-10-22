<link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/nanumgothic.css">
<link rel = "stylesheet" href = "css/form.css">
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<body background = "img/background.png">
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
  //mysql ????
  $connect = my_connect($host, $dbid, $dbpass, $dbname);

  $insert_grade = substr($grade, 4,1); //학년저장
		$insert_class = substr($grade, 5,1); //반저장
		switch($insert_class){
			case 1:case 2:
				$class = '인터랙티브미디어';
			    break;
			case 3:case 4:			
				$class = '뉴미디어디자인';
			    break;
			case 5:case 6:
				$class = '뉴미디어솔루션';
		}
    if($mode=='update') {
    $query = " select * from sub_category where sub_pk = $pk and when_date = '$date' and sub_grade = $grade";
    $result = mysql_query($query, $connect);
    $rows = mysql_fetch_array($result);

//echo $subject_name;
    ?>

    <form name="form" method="post" action = "write_post.php?mode=update&pk=<?=$pk?>&grade=<?=$grade?>&date=<?=$date?>">
	<select name='subject_name'><?
	  $query1 = "select * from subject_table where subject_grade = $insert_grade and subject_major = '$class'";
	  $result1 = mysql_query($query1, $connect);
	  for($i=0;$rows1=mysql_fetch_array($result1);$i++){
		  if($rows1[subject_name] == $subject_name){
		?>
			<option value = "<?echo($rows1[subject_name])?>" selected>
			<?=$rows1[subject_name]?></option>
			<?} else{?>
			<option value = "<?echo($rows1[subject_name])?>">
			<?=$rows1[subject_name]?></option>
		<?
		}
	  }
		?>
	  <option value = "<?= $rows1[subject_name]?>">
	  <?
	// }
	  ?>
	</select>
    <input type="text" id='title' name='title' size = '20' value =  '<?=stripslashes($rows[title])?>'>
	<?
	if($rank=='Y'){
	?>
    <input type="checkbox" name="rank" value="중요" checked>중요
	<?
	  }
	else{
		?>
		<input type="checkbox" name="rank" value="중요">중요
		<?
		}
		?>
    <br><br>
    <textarea id='contents' name='contents' rows='13' cols='50'>
      <?=stripslashes($rows[contents])?>
    </textarea>
    <br>
    <input type="submit" name='submit' value="수정">

<? 
} //mode update
else{ ?> 
<form name="form" method="post" action = "write_post.php?mode=insert&grade=<?=$grade?>&date=<?=$date?>">
<center>
<table cellpadding = "5px">
<tr align = "center"><td>
<select class = "selet_cleander" name='subject_name'>
		<?
		//mode=insert&grade=201721&date=2017-10-21
		

		//과목테이블 연결
		$query2 = "select * from subject_table where subject_grade = $insert_grade and subject_major = '$class' order by id";
		$result2 = mysql_query($query2, $connect);
		for($i=0;$rows2=mysql_fetch_array($result2);$i++){
		?>
			<option value = "<?echo($rows2[subject_name])?>">
			<?=$rows2[subject_name]?></option>
		<?
		}
		?>
    </select>
    <input  class = "div_normal" type="text" id='title' name='title' size = '20' placeholder = "  과제 제목을 입력하세요" >
	<input type="checkbox" name="rank" value="중요">중요
	</td></tr>
    <tr align = "center"><td>
    <textarea class = "textarea_w" id='contents' name='contents' rows='17' cols='45' placeholder = "  과제 내용을 입력하세요" >
    </textarea>
	</td></tr>
	<tr align = "right"><td>
    <input class = "inputround" type="submit" name='submit' value="등록">
	</td></tr>
	</table>
	</center>
    <?
}//mode insert
?>
</body>
   