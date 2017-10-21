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

		$query = "update sub_category 
             set del_chk = 'Y'
             where sub_pk = '$pk'";
   mysql_query($query, $connect);



	echo "<script>
			window.alert('삭제되었습니다.');
		 opener.location.reload();
	 location.href='details.php?grade=$grade&year=$yy&month=$mm&date=$day';
	  </script> ";

?>