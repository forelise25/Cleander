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

   $subject_name = addslashes($subject_name);
//  echo $subject_grade;
//  echo $subject_major;
// echo $subject_name;

//if($mode!='update'){  <-기존 이 문장을 아래의 문장으로 수정
if(!$mode){// [과목 추가]의 경우 
	  $query = "select * from subject_table where subject_grade = $subject_grade and subject_major = '$subject_major' and subject_name = '$subject_name'";
	  $result = mysql_query($query, $connect);
	  if(mysql_num_rows($result)!=0){
		  echo "<script> 
	      alert('이미 존재합니다.');
	      self.close();
	      </script>";
	  }
	  $query1 = "select * from subject_table order by id desc limit 1";
	  $result1 = mysql_query($query1, $connect);
	  $rows1 = mysql_fetch_array($result1);
	  $id_info = $rows1[id]+1;

	  $query2 = "insert into subject_table(subject_grade, subject_major, subject_name, id)
				 values($subject_grade, '$subject_major','$subject_name',$id_info)";
	  mysql_query($query2, $connect);
}
else if($mode == 'update'){ //mode update
	 $query2 = "update subject_table
	           set subject_grade = $subject_grade, subject_major = '$subject_major', subject_name = '$subject_name'
			   where subject_pk = '$pk'";
	mysql_query($query2, $connect);
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
?>