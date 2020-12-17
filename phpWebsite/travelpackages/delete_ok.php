<?php
//include "./../lib/session.php";
include "../lib/dbconn.php";

$table=$_GET["table"];
$no=$_GET["no"];
$page=$_GET["page"];
//기존 source
/*  $table=$_GET["table"];
  $num=$_GET["num"];
  $upload_dir="../data/";

  $sql="select * from $table where num=$num";
  $result=mysql_query($sql, $connect);
  $row=mysql_fetch_array($result);

  $copied_name[0]=$row[file_copied_0];
  $copied_name[1]=$row[file_copied_1];
  $copied_name[2]=$row[file_copied_2];

  for($i=0; $i<3; $i++){
    if($copied_name[$i]){
      $image_name=$upload_dir.$copied_name[$i];
      unlink($image_name);
    }
  }
*/
  $sql="delete from $table where no=$no";
  mysql_query($sql, $connect);
  mysql_close();

  echo("
    <script>
    alert('정상적으로 글이 삭제되었습니다.');
    </script>
    ");


  echo("
  <script>
  location.href='list.php?table=$table&page=$page';
  </script>
  ");
?>
