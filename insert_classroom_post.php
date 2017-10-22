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

  $passwd = addslashes($passwd);

  if($mode!='update'){ //새로 등록할 경우, grade가 같다면 '이미 존재하는 학급입니다'라고 해줌
	  $query1 = "select * from main_category where grade = $grade";  //$grade에는 201711이 넘어옴
	  $result1 = mysql_query($query1, $connect);
	  $rows1 = mysql_fetch_array($result1);
	  if(mysql_num_rows($result1)!=0){ 
		  if(($grade==$rows1[grade])&&($passwd==$rows1[passwd])){
			  echo"<script> self.close(); </script>";
		  }else{
				echo "<script> 
				alert('이미 존재하는 학급입니다.');
				location.href='insert_classroom.php';
				</script>";
				$is_continue = 'N';
		  }
	  }
  }
  
  $query = "select * from main_category where passwd = $passwd"; 
  $result = mysql_query($query, $connect);
  //$rows = mysql_fetch_array($result);  <-필요없는 문장이라 우선 주석쳐놈
  if($mode!='update'){
	  if(mysql_num_rows($result)!=0){ // 입력한 passwd가 이미 존재하는 비밀번호니? (update, insert모드 모두 해당)
		   echo "<script> 
		   alert('이미 존재하는 비밀번호입니다.');
			location.href='insert_classroom.php';
		   </script>";
			$is_continue = 'N';  //이걸로 나중에 인설트 하기 전에 한번 더 체크할거야 'N'은 이미 존재하는 비밀번호의 의미
	  }
  }

  if($mode != 'update'){ //새로 등록의 경우
	  if( $is_continue != 'N'){ //비번이 존재하지 않는다면
		  $query2 = "insert into main_category(passwd, grade)
					 values( '$passwd', $grade)";
		  mysql_query($query2, $connect);
	  }
  }
  else{ //update의 경우
	  $query2 = "select * from main_category where grade = $grade"; 
	  $result2 = mysql_query($query2, $connect);
	  $rows2 = mysql_fetch_array($result2);
	  if(mysql_num_rows($result2)!=0){
		  if(($grade==$rows2[grade])&&($passwd==$rows2[passwd])&&($pk==$rows2[pk])){
			echo"<script> self.close(); </script>";
		  }else{
			echo "<script> 
				alert('이미 존재하는 학급입니다.');
				location.href='insert_classroom.php';
				</script>";
				$is_continue = 'N';
		  }
	  }
  }

  if( $is_continue != 'N'){
			$query3 = "update main_category
				   set passwd = '$passwd', grade = $grade 
				   where pk = '$pk'";
			mysql_query($query3, $connect);
  }

   if($mode == 'update'){
	   echo "<script> 
		 alert('수정 완료'); 
		 opener.location.reload();
		 self.close();
		  </script> "; 
   }
   else{
	   echo "<script> 
     alert('등록 완료'); 
	 opener.location.reload();
	 self.close();
	  </script> "; 
   }
   

	  //update모드 설정 안해줌 
	?>