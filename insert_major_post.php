<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<?
//[����]�� ������ data������ ���ؽ� �ٵ� �̹� �����ϴ� ����Դϴ� ��� ������ ��
//���� �����
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

   $subject_name = addslashes($subject_name);
//  echo $subject_grade;
//  echo $subject_major;
// echo $subject_name;

//if($mode!='update'){  <-���� �� ������ �Ʒ��� �������� ����
if(!$mode){// [���� �߰�]�� ��� 
	  $query = "select * from subject_table where subject_grade = $subject_grade and subject_major = '$subject_major' and subject_name = '$subject_name'";
	  $result = mysql_query($query, $connect);
	  if(mysql_num_rows($result)!=0){
		  echo "<script> 
	      alert('�̹� �����մϴ�.');
	      location.href='insert_major.php';
	      </script>";
		  $is_continue = 'N';
	  }
	  $query1 = "select * from subject_table order by id desc limit 1";
	  $result1 = mysql_query($query1, $connect);
	  $rows1 = mysql_fetch_array($result1);
	  $id_info = $rows1[id]+1;
	  if($is_continue != 'N'){
			$query2 = "insert into subject_table(subject_grade, subject_major, subject_name, id)
					   values($subject_grade, '$subject_major','$subject_name',$id_info)";
			mysql_query($query2, $connect);
	  }
}
else if($mode == 'update'){ //mode update 
	  $query = "select * from subject_table where subject_grade = $subject_grade and subject_major = '$subject_major' and               subject_name = '$subject_name'";
	  $result = mysql_query($query, $connect);
	  $rows = mysql_fetch_array($result);
	  if(mysql_num_rows($result)!=0){
		  if(($pk==$rows[subject_pk])&&($subject_grade==$rows[subject_grade])&&($subject_major = $rows[subject_major])&&($subject_name = $rows[subject_name])){
				echo "<script> self.close();</script>";
				$is_continue ='N';
		  }else{
				echo "<script> 
				alert('�̹� �����ϴ� �����Դϴ�');
				location.href='insert_major.php';
				</script>";
				$is_continue ='N';
		  }
	  }
	  $query1 = "select * from subject_table order by id desc limit 1";
	  $result1 = mysql_query($query1, $connect);
	  $rows1 = mysql_fetch_array($result1);
	  $id_info = $rows1[id]+1;
	  if($is_continue !='N'){
			$query2 = "update subject_table
	                   set subject_grade = $subject_grade, subject_major = '$subject_major', subject_name = '$subject_name'
			           where subject_pk = '$pk'";
			mysql_query($query2, $connect);
	  }
}

if($mode == 'update'){
   echo "<script> 
     alert('���� �Ϸ�'); 
	 opener.location.reload();
	 self.close();
	  </script> "; 
}
else{
	echo "<script> 
    alert('��� �Ϸ�'); 
	opener.location.reload();
	self.close();
	</script> "; 
}
?>