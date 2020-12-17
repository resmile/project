<?php

if($userlevel!=1){
  echo("
    <script>
      location.href='../member/login.php';
    </script>
  ");
}

    switch ($depth) {
      case 1:
        $path="./";
        break;
      case 2:
        $path="./../";
        break;
      case 3:
        $path="./../../";
        break;
    }
  ?>
<!doctype html>
<html lang="kr">
 <head>
  <meta charset="UTF-8">
  <title>관리자|<? echo $title; ?></title>
  <link rel="stylesheet" type="text/css" href="<? echo $path;?>css/common.css">
 </head>
 <body>
 <div id="adminWrap">
 <header class="wrap">
 <div class="aLink1 aVisited1 aHover1 ">
       <span class="absolute position2"><?= $userid ?> 님 | <a href="<? echo $path;?>index.php">프론트 | <a href="<? echo $path;?>admin/member/logout.php">로그아웃</a></span>
 </div>
  <div id="logo" class="clearboth aLink1 aVisited1 aHover1 txtCenter">
   <a href="<? echo $path;?>admin/reserve/list.php" title="힐링여행 - 여행 상품 판매" alt="힐링여행 - 여행 상품 판매">
    <img src="<? echo $path;?>img/lib_img_logo.jpg" title="힐링여행로고" alt="힐링여행로고"></a>
  </div>
  <div id="menu1" class="aLink4 aVisited4 aHover4">
    <ul id="mainMenu1" class="listStyle txtCenter clear mgl2">
      <li><a href="<? echo $path;?>admin/reserve/list.php" title="예약관리" alt="예약관리"><strong>예약관리</strong></a></li>
	  <li><a href="<? echo $path;?>admin/review/list.php" title="여행후기관리" alt="여행후기관리"><strong>여행후기관리</strong></a></li>
     <li><a href="<? echo $path;?>admin/member/list.php" title="회원관리" alt="회원관리"><strong>회원관리</strong></a></li>
      <li><a href="<? echo $path;?>admin/notice/list.php" title="공지사항관리" alt="공지사항관리"><strong>공지사항관리</strong></a></li>
      <li><a href="<? echo $path;?>admin/qna/list.php" title="QnA관리" alt="QnA관리"><strong>Q&A관리</strong></a></li>
      <li><a href="<? echo $path;?>admin/event/list.php" title="이벤트관리" alt="이벤트관리"><strong>이벤트관리</strong></a></li>
    </ul>
 </div>

 </header>

  <section id="admin mg_auto" class="clearboth mgt borTop1">
  <div class="contentsWrap mgt1">
