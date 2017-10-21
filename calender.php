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
  		alert("잘못된 비밀번호입니다.");
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
		$str = "<select name='yy'>\n<option value=''></option>\n";
	} else {
		$str = "<select name='yy' onChange='$func'>\n<option value=''></option>\n";
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
		$str = "<select name='mm'>\n";
	} else {
		$str = "<select name='mm' onChange='$func'>\n";
	}
	for($i=1;$i<13;$i++) {
		if($mm == $i) $str .= "<option value='$i' selected>{$i}</option>";
		else $str .= "<option value='$i'>{$i}</option>";
	}
	$str .= "</select>";
	return $str;
}

// 1. 총일수 구하기
$last_day = date("t", strtotime($yy."-".$mm."-01"));

// 2. 시작요일 구하기
$start_week = date("w", strtotime($yy."-".$mm."-01"));

// 3. 총 몇 주인지 구하기
$total_week = ceil(($last_day + $start_week) / 7);

// 4. 마지막 요일 구하기
$last_week = date('w', strtotime($yy."-".$mm."-".$last_day));
?>
<form name="form" method="post">
    <input type='button' value='로그아웃' onclick="javascript:window.history.back();">
	<input type = "hidden" name = "passwd" value = "<?=$passwd?>">

<table width='80%' cellpadding='0' cellspacing='1' bgcolor="#999999">
<tr>
<td height="50" align="center" bgcolor="#FFFFFF" colspan="7">
<?=sel_yy($yy,'submit();')?>년 <?=sel_mm($mm,'submit();')?>월 <!-- <input type="submit" value="보기"> --></td>
</tr>
<tr>
<td width="130" height="30" align="center" bgcolor="#DDDDDD"><b>일</b></td>
<td width="130" align="center" bgcolor="#DDDDDD"><b>월</b></td>
<td width="130" align="center" bgcolor="#DDDDDD"><b>화</b></td>
<td width="130" align="center" bgcolor="#DDDDDD"><b>수</b></td>
<td width="130" align="center" bgcolor="#DDDDDD"><b>목</b></td>
<td width="130" align="center" bgcolor="#DDDDDD"><b>금</b></td>
<td width="130" align="center" bgcolor="#DDDDDD"><b>토</b></td>
</tr>

<?
$today_yy = date('Y');
$today_mm = date('m');
// 5. 화면에 표시할 화면의 초기값을 1로 설정
$day=1;
$cnt =0;
// 6. 총 주 수에 맞춰서 세로줄 만들기
for($i=1; $i <= $total_week; $i++){?>
<tr>
<?
	// 7. 총 가로칸 만들기
	for ($j=0; $j<7; $j++){
		$cnt++;
		if($cnt > $start_week){
?>

<td width="130" height="120" align="left" valign="top" bgcolor="#FFFFFF" onclick="window.open('details.php?grade=<?=$grade_info?>&year=<?=$yy?>&month=<?=$mm?>&date=<?=$day?>', '', 'width=500, height=500')">
  <?
		}
else{
	?>
	<td width="130" height="120" align="left" valign="top" bgcolor="#FFFFFF">
	<?
}
	// 8. 첫번째 주이고 시작요일보다 $j가 작거나 마지막주이고 $j가 마지막 요일보다 크면 표시하지 않아야하므로
	//    그 반대의 경우 -  ! 으로 표현 - 에만 날자를 표시한다.
	if (!(($i == 1 && $j < $start_week) || ($i == $total_week && $j > $last_week))){

		if($j == 0){
			// 9. $j가 0이면 일요일이므로 빨간색
			echo "<font color='#FF0000'><b>";
		}else if($j == 6){
			// 10. $j가 0이면 일요일이므로 파란색
			echo "<font color='#0000FF'><b>";
		}else{
			// 11. 그외는 평일이므로 검정색
			echo "<font color='#000000'><b>";
		}

		// 12. 오늘 날자면 굵은 글씨
		if($today_yy == $yy && $today_mm == $mm && $day == date("j")){
			echo "<u>";
		}
		
		// 13. 날자 출력
		echo $day;
		echo "<br>";

		if($mm<10 && $day <10) $dtstr = $yy."-0".$mm."-0".$day;
		else if($mm>=10 && $day < 10) $dtstr = $yy."-".$mm."-0".$day;
		else if($mm<10 && $day >= 10) $dtstr = $yy."-0".$mm."-".$day;
		else $dtstr = $yy."-".$mm."-".$day;

	    $query = "select * from sub_category where when_date = '$dtstr' and sub_grade = $grade_info and del_chk='N'";
	    $result = mysql_query($query, $connect);
		/*$num =mysql_num_rows($result);
		echo $num;*/
	    // $rows = mysql_num_rows($result);
	    // echo $rows;
	    while($rows = mysql_fetch_array($result)){
	    	echo stripslashes($rows[subject]);
	    	echo "&nbsp;|&nbsp;";
			echo stripslashes($rows[title]);
			echo "<br>";
	    }




		if($today_yy == $yy && $today_mm == $mm && $day == date("j")){
			echo "</u>";
		}

		echo "</b></font> &nbsp;";

		//스케줄 출력
		//$schstr = get_schedule($yy,$mm,$day);
		//echo $schstr;


		// 14. 날자 증가
		$day++;
	}
	?>
</td>
<?}?>
</tr>
<?}?>
</table> 
</form>