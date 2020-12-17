<?php
$connect=mysql_connect("localhost", "healingtour", "south1234") or die("SQL server에 연결할 수 없습니다.");

mysql_select_db("healingtour",$connect);
mysql_query("set names utf8");
?>
