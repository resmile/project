<?php
header("Content-Type: text/html; charset=UTF-8");
include "./../../lib/session.php";
include "./../../lib/dbconn.php";


$table=$_GET["table"];


/*  $userid=$_SESSION["userid"];
  $username=$_SESSION["username"];
  $usernick=$_SESSION["usernick"];
  $subject=$_POST["subject"];
  $content=$_POST["content"];
  $html_ok=$_POST["html_ok"];
  $mode=$_GET["mode"];
  $num=$_GET["num"];
  $page=$_GET["page"];*/

  $member_no=$usernum;
  $id=$userid;
  $name=$username;
  $reserve_day=date("Y-m-d (H:i)");
  $tp_no=$_POST["travel_no1"];
  $number_of_people=$_POST["number_of_people"];
  $start_of_date=$_POST["start_of_date"];
  $end_of_date=$_POST["end_of_date"];
  $inquiry_message=$_POST["inquiry_message"];
  $status="예약완료";


  $sql = "INSERT INTO $table (no,member_no,id,name,reserve_day,tp_no,number_of_people,start_of_date,end_of_date,inquiry_message,status) VALUES (0,'$member_no','$id','$name','$reserve_day','$tp_no','$number_of_people','$start_of_date','$end_of_date','$inquiry_message','$status')";



  mysql_query($sql, $connect);
  mysql_close();
  echo("
    <script>
    alert('정상적으로 예약되었습니다.');
    </script>
    ");
  echo("
  <script>
  location.href='list.php';
  </script>
  ");
?>
