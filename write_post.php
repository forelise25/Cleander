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

  $title = addslashes($title);
  $contents = addslashes($contents);
  

  if($mode=='update'){
 if($rank){
   $query = "update sub_category 
             set title='$title', contents='$contents' , subject = '$subject_name', rank = 'Y'
             where sub_pk = '$pk'";
 }
 else{
	 $query = "update sub_category 
             set title='$title', contents='$contents' , subject = '$subject_name', rank = 'N'
             where sub_pk = '$pk'";
 }
   mysql_query($query, $connect);
   //http://localhost/details.php?grade=201721&year=2017&month=10&date=7
   //echo "<meta http-equiv='Refresh'content='0;url=list.php'>";
   // echo $date;
   // echo $grade;
   

   
  }
  else{
	  /*echo $grade;
	  echo "<br>";
	echo $subject_name;
	echo "<br>";
	 echo $title;
	 echo "<br>";
	 echo $contents;
	 echo "<br>";
	 echo $date;*/
	 if($rank){ //
	$query = "insert into sub_category(sub_grade, title, contents, rank, subject,when_date)
	           values($grade, '$title','$contents', 'Y', '$subject_name','$date')";
	 }
	 else{
		 $query = "insert into sub_category(sub_grade, title, contents,  subject,when_date)
	           values($grade, '$title','$contents','$subject_name','$date')";
	 }
	 
     mysql_query($query, $connect);

	 
	
  }//mode == insert

    $yy = substr($date, 0, 4); // 0부터 2에 해당하는 구간까지 반환 : ez 

   if(substr($date, 5, 2) < 10){
	    $mm = substr($date, 6, 1);
   }
   else{
	    $mm = substr($date, 5, 2);
   }
  
   if(substr($date,8,2) < 10){
	    $day = substr($date, 9, 1);
   }
   else{
	    $day = substr($date, 8, 2);
   }


  echo "<script> 
     alert('수정 완료'); 
	 opener.location.reload();
	 location.href='details.php?grade=$grade&year=$yy&month=$mm&date=$day';
	  </script> "; 
	?>