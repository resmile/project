<?php
  include "./../../lib/session.php";
  include "./../../lib/dbconn.php";

  $table=$_GET["table"];
  $no=$_GET["no"];
  $page=$_GET["page"];

  $sql="delete from $table where no=$no";
  mysql_query($sql, $connect);
  mysql_close();
  echo("
    <script>
    alert('예약이 정상적으로 삭제되었습니다.');
    </script>
    ");
  echo("
  <script>
  location.href='list.php?table=$table&page=$page';
  </script>
  ");
?>
