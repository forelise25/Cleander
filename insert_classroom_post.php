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

  $passwd = addslashes($passwd);

  if($mode!='update'){ //���� ����� ���, grade�� ���ٸ� '�̹� �����ϴ� �б��Դϴ�'��� ����
	  $query1 = "select * from main_category where grade = $grade";  //$grade���� 201711�� �Ѿ��
	  $result1 = mysql_query($query1, $connect);
	  $rows1 = mysql_fetch_array($result1);
	  if(mysql_num_rows($result1)!=0){ 
		  if(($grade==$rows1[grade])&&($passwd==$rows1[passwd])){
			  echo"<script> self.close(); </script>";
		  }else{
				echo "<script> 
				alert('�̹� �����ϴ� �б��Դϴ�.');
				location.href='insert_classroom.php';
				</script>";
				$is_continue = 'N';
		  }
	  }
  }
  
  $query = "select * from main_category where passwd = $passwd"; 
  $result = mysql_query($query, $connect);
  //$rows = mysql_fetch_array($result);  <-�ʿ���� �����̶� �켱 �ּ��ĳ�
  if($mode!='update'){
	  if(mysql_num_rows($result)!=0){ // �Է��� passwd�� �̹� �����ϴ� ��й�ȣ��? (update, insert��� ��� �ش�)
		   echo "<script> 
		   alert('�̹� �����ϴ� ��й�ȣ�Դϴ�.');
			location.href='insert_classroom.php';
		   </script>";
			$is_continue = 'N';  //�̰ɷ� ���߿� �μ�Ʈ �ϱ� ���� �ѹ� �� üũ�Ұž� 'N'�� �̹� �����ϴ� ��й�ȣ�� �ǹ�
	  }
  }

  if($mode != 'update'){ //���� ����� ���
	  if( $is_continue != 'N'){ //����� �������� �ʴ´ٸ�
		  $query2 = "insert into main_category(passwd, grade)
					 values( '$passwd', $grade)";
		  mysql_query($query2, $connect);
	  }
  }
  else{ //update�� ���
	  $query2 = "select * from main_category where grade = $grade"; 
	  $result2 = mysql_query($query2, $connect);
	  $rows2 = mysql_fetch_array($result2);
	  if(mysql_num_rows($result2)!=0){
		  if(($grade==$rows2[grade])&&($passwd==$rows2[passwd])&&($pk==$rows2[pk])){
			echo"<script> self.close(); </script>";
		  }else{
			echo "<script> 
				alert('�̹� �����ϴ� �б��Դϴ�.');
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
   

	  //update��� ���� ������ 
	?>