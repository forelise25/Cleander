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

  // $query = "select * from sub_category";
  // $result = mysql_query($query, $connect);
  // while ($rows = mysql_fetch_array ($result)){ 
  //   echo $rows[contents];
  // }
  if($passwd == 'mirim'){
	echo "<meta http-equiv='Refresh' content='0;url=/admin.php'>";
  }
  $query = "select * from main_category where passwd = '$passwd'";
  $result = mysql_query($query, $connect);
  $rows = mysql_fetch_array($result);
  if($rows ==0){
  	?>
  	<script>
  		alert("�߸��� ��й�ȣ�Դϴ�.");
        window.history.back();
    </script>

  	<?
  	
  }
  $grade_info = $rows[grade];
?>

<?
$yy = $_REQUEST['yy'];
$mm = $_REQUEST['mm'];
if($yy == '') $yy = date('Y');
if($mm == '') $mm = date('m');

function sel_yy($yy, $func) {
	if($yy == '') $yy = date('Y');

	if($func=='') {
		$str = "<select name='yy' class = 'selet_cleander'>\n<option value=''></option>\n";
	} else {
		$str = "<select name='yy'  class = 'selet_cleander' onChange='$func'>\n<option value=''></option>\n";
	}
	$gijun = date('Y');
	for($i=$gijun-1;$i<$gijun+2;$i++) {
		if($yy == $i) $str .= "<option value='$i' selected>$i</option>";
		else $str .= "<option value='$i'>$i</option>";
	}
	$str .= "</select>";
	return $str;
}

function sel_mm($mm, $func) {
	if($func=='') {
		$str = "<select name='mm' class = 'selet_cleander'>\n";
	} else {
		$str = "<select name='mm' onChange='$func' class = 'selet_cleander'>\n";
	}
	for($i=1;$i<13;$i++) {
		if($mm == $i) $str .= "<option value='$i' selected>{$i}</option>";
		else $str .= "<option value='$i'>{$i}</option>";
	}
	$str .= "</select>";
	return $str;
}

// 1. ���ϼ� ���ϱ�
$last_day = date("t", strtotime($yy."-".$mm."-01"));

// 2. ���ۿ��� ���ϱ�
$start_week = date("w", strtotime($yy."-".$mm."-01"));

// 3. �� �� ������ ���ϱ�
$total_week = ceil(($last_day + $start_week) / 7);

// 4. ������ ���� ���ϱ�
$last_week = date('w', strtotime($yy."-".$mm."-".$last_day));
?>
<body background = "img/background.png" style="background-repeat:no-repeat;">
<center>
<form name="form" method="post">

	<input type = "hidden" name = "passwd" value = "<?=$passwd?>">
<table width='1000' cellpadding='10' cellspacing='1'>

<tr cellpadding = "30sp" height = "80sp">
<td rowspan = "2">
<img src = "img/logo.png" width = "80" height = "80" align='center'></img>
</td>
<td align = "right" colspan = "6">
<a href = "javascript:window.history.back()"> <img src = "img/logout.png" width = "80" align = "right"></img> </a>
</td></tr>
<tr>
<td height="50" align="right" colspan="6">
<?=sel_yy($yy,'submit();')?>�� <?=sel_mm($mm,'submit();')?>�� <!-- <input type="submit" value="����"> --></td>
</tr>
<tr>
<td class = "day_table" width="130" height="30" align="center"><b>��</b></td>
<td class = "day_table" width="130" align="center"><b>��</b></td>
<td class = "day_table" width="130" align="center"><b>ȭ</b></td>
<td class = "day_table" width="130" align="center"><b>��</b></td>
<td class = "day_table" width="130" align="center"><b>��</b></td>
<td class = "day_table" width="130" align="center"><b>��</b></td>
<td class = "day_table" width="130" align="center"><b>��</b></td>
</tr>

<?
$today_yy = date('Y');
$today_mm = date('m');
// 5. ȭ�鿡 ǥ���� ȭ���� �ʱⰪ�� 1�� ����
$day=1;
$cnt =0;
// 6. �� �� ���� ���缭 ������ �����
for($i=1; $i <= $total_week; $i++){?>
<tr>
<?
	// 7. �� ����ĭ �����
	for ($j=0; $j<7; $j++){
		$cnt++;
		if($cnt > $start_week){
?>

<td width="130" height="120" align="right" valign="top" bgcolor="#FFFFFF" onclick="window.open('details.php?grade=<?=$grade_info?>&year=<?=$yy?>&month=<?=$mm?>&date=<?=$day?>', '', 'width=430, height=445, top=100,left=450')">
  <?
		}
else{
	?>
	<td width="130" height="30" align="left" valign="top" bgcolor="#FFFFFF">
	<?
}
	// 8. ù��° ���̰� ���ۿ��Ϻ��� $j�� �۰ų� ���������̰� $j�� ������ ���Ϻ��� ũ�� ǥ������ �ʾƾ��ϹǷ�
	//    �� �ݴ��� ��� -  ! ���� ǥ�� - ���� ���ڸ� ǥ���Ѵ�.
	if (!(($i == 1 && $j < $start_week) || ($i == $total_week && $j > $last_week))){

		if($j == 0){
			// 9. $j�� 0�̸� �Ͽ����̹Ƿ� ������
			echo "<font color='#FF0000'><b>";
		}else if($j == 6){
			// 10. $j�� 0�̸� �Ͽ����̹Ƿ� �Ķ���
			echo "<font color='#0000FF'><b>";
		}else{
			// 11. �׿ܴ� �����̹Ƿ� ������
			echo "<font color='#000000'><b>";
		}

		// 12. ���� ���ڸ� ���� �۾�
		if($today_yy == $yy && $today_mm == $mm && $day == date("j")){
			echo "<u>";
		}
		
		// 13. ���� ���
		echo $day;
		echo "<br>";
		if($mm<10 && $day <10) $dtstr = $yy."-0".$mm."-0".$day;
		else if($mm>=10 && $day < 10) $dtstr = $yy."-".$mm."-0".$day;
		else if($mm<10 && $day >= 10) $dtstr = $yy."-0".$mm."-".$day;
		else $dtstr = $yy."-".$mm."-".$day;

	    $query = "select * from sub_category where when_date = '$dtstr' and sub_grade = $grade_info and del_chk='N'";
	    $result = mysql_query($query, $connect);
		$num =mysql_num_rows($result);
		//echo $num;
	    //echo $rows;
		if($num < 4){
	    while($rows = mysql_fetch_array($result)){
			if($rows[rank] == 'Y'){
			echo "<div class = div_normal_important>";
			}
			else{
				echo "<div class = div_normal>";
	    	}
				echo stripslashes($rows[subject]);
	    	echo "&nbsp;|&nbsp;";
			$output = substr(stripslashes($rows[title]), 0,8);
			echo $output;
			echo "</div>";
	    }}
		else{
			for($i = 0; $i < 3; $i++){
			$rows = mysql_fetch_array($result);
			if($rows[rank] == 'Y'){
			echo "<div class = div_normal_important>";
			}
			else{
				echo "<div class = div_normal>";
	    	}
	    	echo stripslashes($rows[subject]);
	    	echo "&nbsp;|&nbsp;";
			$output = substr(stripslashes($rows[title]), 0,8);
			echo $output;
			echo "</div>";
			}
			echo "+" . ($num - $i) . "��";
		}



		if($today_yy == $yy && $today_mm == $mm && $day == date("j")){
			echo "</u>";
		}

		echo "</b></font> &nbsp;";

		//������ ���
		//$schstr = get_schedule($yy,$mm,$day);
		//echo $schstr;


		// 14. ���� ����
		$day++;
	}
	?>
</td>
<?}?>
</tr>
<?}?>
</table> 
</form>
</center>
</body>