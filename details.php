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

  if($month<10 && $date <10) $dtstr = $year."-0".$month."-0".$date;
    else if($month>=10 && $date < 10) $dtstr = $year."-".$month."-0".$date;
    else if($month<10 && $date >= 10) $dtstr = $year."-0".$month."-".$date;
    else $dtstr = $year."-".$month."-".$date;

    $query = "select * from sub_category where when_date = '$dtstr' and sub_grade = $grade and del_chk = 'N'";
    $result = mysql_query($query, $connect);
    ?>
    
      <?
    while ($rows = mysql_fetch_array ($result)){ 
    ?>
     <table border = "1" cellspacing="0" cellpadding="1">
    <tr>
       <td >
          <?= stripslashes($rows[subject]) ?>
        </td>
        <td>
          <?= stripslashes($rows[title]) ?>
        </td>
       
      </tr>
      <tr>
       <td colspan="2">
          <?= stripslashes($rows[contents]) ?>
        </td>
       </tr>
      <tr>
        <td colspan="2">
		
          <a href ="write.php?mode=update&pk=<?=$rows[sub_pk]?>&grade=<?=$grade?>&date=<?=$dtstr?>&subject_name=<?=stripslashes($rows[subject])	?>&rank=<?=$rows[rank]?>"> ���� </a> | 
		  <a href="work_del.php?pk=<?=$rows[sub_pk]?>&grade=<?=$grade?>&yy=<?=$year?>&mm=<?=$month?>&day=<?=$date?>" onclick="return confirm('���� �����Ͻðڽ��ϱ�?')"> ���� </a> <!--grade,yy, mm, day, sub_pk �ѱ��!-->
        </td>
      </tr>
      </table>
      <br>
     <?
         } //while
     ?>
     <form name = "form" action = "write.php?mode=insert&grade=<?=$grade?>&date=<?=$dtstr?>" method="post">
     <input type="submit" name="submit" value = "����ϱ�">
    </form>

