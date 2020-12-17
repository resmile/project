<?php
header("Content-Type: text/html; charset=UTF-8");
include "./../../lib/session.php";
include "./../../lib/dbconn.php";

$table=$_GET["table"];
$no=$_GET["no"];
$page=$_GET["page"];


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

  $sql = "update $table set reserve_day='$reserve_day', name='$name',tp_no='$tp_no',number_of_people='$number_of_people',start_of_date='$start_of_date',end_of_date='$end_of_date',inquiry_message='$inquiry_message',status='$status' where no=$no";
  //-------------
/*
  $id=$_POST["id"];
  $name=$_POST["name"];
  $reserve_day=date("Y-m-d (H:i)");
  $tp_no=$_POST["tp_no"];
  $number_of_people=$_POST["number_of_people"];
  $start_of_date=$_POST["start_of_date"];
  $end_of_date=$_POST["end_of_date"];
  $inquiry_message=$_POST["inquiry_message"];
  $status=$_POST["status"];
  //$tp_title=$_POST["tp_title"];
  //$travel_period=$_POST["travel_period"];
*/

  mysql_query($sql, $connect);
  mysql_close();
  echo("
    <script>
    alert('예약내역이 정상적으로 수정되었습니다.');
    </script>
    ");

echo("
  <script>
  location.href='view.php?table=$table&no=$no&page=$page&travel_title=$travel_title';
  </script>
  ");
?>
