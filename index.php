
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

?>

<html>
<head>
<title></title>
</head>
<body>
  <center>
    <img src="img/main_logo.png" width="100" height = "100"><br>
    <form name="form1" method="post" action="calender.php">
      <input type="password" name="passwd" maxlength="20">
      <input type="submit" name="submit" value = "login">
      <input type="hidden" name = "mode" value = "search">
    </form>
  </center>
</body>
</html>