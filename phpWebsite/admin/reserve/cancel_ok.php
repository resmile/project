<?php
header("Content-Type: text/html; charset=UTF-8");
include "./../../lib/session.php";
include "./../../lib/dbconn.php";


$table=$_GET["table"];
$no=$_GET["no"];
$page=$_GET["page"];
$reserve_day=date("Y-m-d (H:i)");

  $status="예약취소";
  $sql = "update $table set reserve_day='$reserve_day',status='$status' where no=$no";

  mysql_query($sql, $connect);
  mysql_close();
  echo("
    <script>
    alert('예약이 정상적으로 취소되었습니다.');
    </script>
    ");
  echo("
  <script>
  location.href='list.php?page=$page';
  </script>
  ");
?>
