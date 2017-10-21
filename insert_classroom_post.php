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

  /*echo $grade;
  echo "<br>";
  echo $passwd;
   echo "<br>";
  echo $passwd_rechk;*/

  $passwd = addslashes($passwd);

  /*

  	  $query4 = "select * from main_category where grade = $grade";
	  $result4 = mysql_query($query4, $connect);
	  $rows4 = mysql_fetch_array($result4);
	  if(stripslashes($row4[grade]) == stripslashes($grade)) $is_continue = 'Y';
  */
  if($mode!='update'){ //새로 등록할 경우인데 grade가 같다면 '이미 존재하는 학급입니다'라고 해줌
	  $query1 = "select * from main_category where grade = $grade"; 
	  $result1 = mysql_query($query1, $connect);
	  //$rows1 = mysql_fetch_array($result1);  <- 없어도 되는 문장
  
	  if(mysql_num_rows($result1)!=0){ //비밀번호만 수정하려는 update의 경우 grade는 같을 수 있다. 그러면 무조건 하나 이상의 레코드는 선택될 것이며 위 이프문에 반드시 걸리게 된다. 이 이프문은 새로 등록할 경우 판단해야하는 체크조건이므로 상위 if문을 통해 update의 경우와 새로등록의 경우를 거른다
		  echo "<script> 
	      alert('이미 존재하는 학급입니다.');
	      location.href='insert_classroom.php';
	      </script>";
	      $is_continue = 'N';
	  }
  }
  $query = "select * from main_category where passwd = $passwd"; 
  $result = mysql_query($query, $connect);
  //$rows = mysql_fetch_array($result);  <-필요없는 문장이라 우선 주석쳐놈
  if(mysql_num_rows($result)!=0){ // 입력한 passwd가 이미 존재하는 비밀번호니? (update, insert모드 모두 해당)
	   echo "<script> 
	   alert('이미 존재하는 비밀번호입니다.');
		location.href='insert_classroom.php';
	   </script>";
		$is_continue = 'N';  //이걸로 나중에 인설트 하기 전에 한번 더 체크할거야 'N'은 이미 존재하는 비밀번호의 의미
  }

  if($mode != 'update'){ //새로 등록의 경우
	  if( $is_continue != 'N'){ //비번이 존재하지 않는다면
		  $query2 = "insert into main_category(passwd, grade)
					 values( '$passwd', $grade)";
		  mysql_query($query2, $connect);
	  }
  } //insert mode

  else{ //update의 경우
	   if( $is_continue != 'N'){
			$query2 = "update main_category
				   set passwd = '$passwd', grade = $grade 
				   where pk = '$pk'";
			mysql_query($query2, $connect);
	   }
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