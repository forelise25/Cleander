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
  if($mode!='update'){ //���� ����� ����ε� grade�� ���ٸ� '�̹� �����ϴ� �б��Դϴ�'��� ����
	  $query1 = "select * from main_category where grade = $grade"; 
	  $result1 = mysql_query($query1, $connect);
	  //$rows1 = mysql_fetch_array($result1);  <- ��� �Ǵ� ����
  
	  if(mysql_num_rows($result1)!=0){ //��й�ȣ�� �����Ϸ��� update�� ��� grade�� ���� �� �ִ�. �׷��� ������ �ϳ� �̻��� ���ڵ�� ���õ� ���̸� �� �������� �ݵ�� �ɸ��� �ȴ�. �� �������� ���� ����� ��� �Ǵ��ؾ��ϴ� üũ�����̹Ƿ� ���� if���� ���� update�� ���� ���ε���� ��츦 �Ÿ���
		  echo "<script> 
	      alert('�̹� �����ϴ� �б��Դϴ�.');
	      location.href='insert_classroom.php';
	      </script>";
	      $is_continue = 'N';
	  }
  }
  $query = "select * from main_category where passwd = $passwd"; 
  $result = mysql_query($query, $connect);
  //$rows = mysql_fetch_array($result);  <-�ʿ���� �����̶� �켱 �ּ��ĳ�
  if(mysql_num_rows($result)!=0){ // �Է��� passwd�� �̹� �����ϴ� ��й�ȣ��? (update, insert��� ��� �ش�)
	   echo "<script> 
	   alert('�̹� �����ϴ� ��й�ȣ�Դϴ�.');
		location.href='insert_classroom.php';
	   </script>";
		$is_continue = 'N';  //�̰ɷ� ���߿� �μ�Ʈ �ϱ� ���� �ѹ� �� üũ�Ұž� 'N'�� �̹� �����ϴ� ��й�ȣ�� �ǹ�
  }

  if($mode != 'update'){ //���� ����� ���
	  if( $is_continue != 'N'){ //����� �������� �ʴ´ٸ�
		  $query2 = "insert into main_category(passwd, grade)
					 values( '$passwd', $grade)";
		  mysql_query($query2, $connect);
	  }
  } //insert mode

  else{ //update�� ���
	   if( $is_continue != 'N'){
			$query2 = "update main_category
				   set passwd = '$passwd', grade = $grade 
				   where pk = '$pk'";
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
   

	  //update��� ���� ������ 
	?>