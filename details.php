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

  if($month<10 && $date <10) $dtstr = $year."-0".$month."-0".$date;
    else if($month>=10 && $date < 10) $dtstr = $year."-".$month."-0".$date;
    else if($month<10 && $date >= 10) $dtstr = $year."-0".$month."-".$date;
    else $dtstr = $year."-".$month."-".$date;

    $query = "select * from sub_category where when_date = '$dtstr' and sub_grade = $grade and del_chk = 'N'";
    $result = mysql_query($query, $connect);
    ?>
	<center>
      <?
    while ($rows = mysql_fetch_array ($result)){ 
    ?>
     <table border = "1" cellspacing="0" cellpadding="5" style="border-color:#ffffff">
		<tr>
		   <td width = "150sp" align = "center" bgcolor = #419fff color = "white">
			  <?= stripslashes($rows[subject]) ?>
			</td>
			<td width = "250sp" bgcolor = #419fff color = "white">
			  <?= stripslashes($rows[title]) ?>
			</td>
		   
		  </tr>
		  <tr>
		   <td colspan="2" width = "400" height = "130" bgcolor = #E7FFFF>
			  <?= stripslashes($rows[contents]) ?>
			</td>
		   </tr>
		  <tr>
			<td colspan="2" align="center">
			
			  <a href ="write.php?mode=update&pk=<?=$rows[sub_pk]?>&grade=<?=$grade?>&date=<?=$dtstr?>&subject_name=<?=stripslashes($rows[subject])	?>&rank=<?=$rows[rank]?>">수정</a> &nbsp;&nbsp;|&nbsp;&nbsp; 
			  <a href="work_del.php?pk=<?=$rows[sub_pk]?>&grade=<?=$grade?>&yy=<?=$year?>&mm=<?=$month?>&day=<?=$date?>" onclick="return confirm('정말 삭제하시겠습니까?')">삭제</a> <!--grade,yy, mm, day, sub_pk 넘기기!-->
			</td>
		  </tr>
      </table>
      <br>
     <?
         } //while
     ?>
     <form name = "form" action = "write.php?mode=insert&grade=<?=$grade?>&date=<?=$dtstr?>" method="post">
     <input class = "inputround" type="submit" name="submit" value = "등록하기">
    </form>
	</center>
