<?
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
<html lang="ko">
 <head>
  <meta charset="UTF-8">
  <title><? echo $title; ?></title>
  <link rel="stylesheet" type="text/css" href="<? echo $path;?>css/common.css">
  <link href='http://fonts.googleapis.com/earlyaccess/nanumgothic.css' rel='stylesheet' type='text/css'>
</head>
 <body>
 <header class="wrap">
   <div id="top_login" class="txtRight absolute aLink1 aVisited1 aHover2 fontSize12 more">
<?php
  if(!$userid){
?>
  <a href="<? echo $path;?>member/login.php">로그인</a> |
  <a href="<? echo $path;?>member/register.php">회원가입</a>
<?php
  }else{
?>

  <? if($userlevel==1){ ?>
    <div class="utilMenu2">
  <?= $userid ?>님&nbsp;&nbsp;&nbsp;|
  <a href="<? echo $path;?>admin/index.php">&nbsp;&nbsp;&nbsp;관리자모드&nbsp;&nbsp;&nbsp;|</a>
  <a href="<? echo $path;?>member/logout.php">&nbsp;&nbsp;&nbsp;로그아웃</a>
  </div>
  <?}?>
  <? if($userlevel==9){ ?>

    <div class="utilMenu1">
    <ul id="utilMenu" class="listStyle txtCenter">
      <li><a href="<? echo $path;?>member/logout.php">로그아웃</a></li>
      <li>마이페이지&nbsp;&nbsp;&nbsp;|
       <ul class="listStyle">
         <li style="line-height:20px; font-size:12px;"><a href="<? echo $path;?>reserve/list.php">예약확인/취소</a></li>
         <li style="line-height:20px; font-size:12px;"><a href="<? echo $path;?>member/modify.php">정보수정</a></li>
         <li style="line-height:20px; font-size:12px;"><a href="<? echo $path;?>member/delete.php?tbg=8">회원탈퇴</a></li>
       </ul>
       </li>
       <li><?= $userid ?>님&nbsp;&nbsp;&nbsp;|</li>
    </ul>
   </div>
  <?}?>
<?php
  }
?>
</div>
  <div id="logo" class="floatLeft aLink1 aVisited1 aHover1 txtCenter" style="margin-right:50px;">
    <a href="<? echo $path;?>index.php" title="힐링여행 - 여행 상품 판매" alt="힐링여행 - 여행 상품 판매">
    <img src="<? echo $path;?>img/lib_img_logo.jpg" title="힐링여행로고" alt="힐링여행로고"></a>
  </div>
  <div id="menu" class="aLink1 aVisited1 aHover1">
    <ul id="mainMenu" class="listStyle txtCenter">
      <li class="menu"><a href="<? echo $path;?>company/intro.php" title="회사소개" alt="회사소개"><strong>회사소개</strong></a>
        <ul class="listStyle absolute aLink2 aVisited2 aHover2">
          <li><a href="<? echo $path;?>company/intro.php" title="회사소개" alt="회사소개">회사소개</a></li>
          <li><a href="<? echo $path;?>company/contacts.php" title="오시는 길" alt="오시는 길">오시는 길</a></li>
        </ul>
      </li>
      <li><a href="<? echo $path;?>travelpackages/list.php" title="여행상품" alt="여행상품"><strong>여행상품</strong></a></li>
    <li class="menu">
      <?if($userid){?>
      <a href="<? echo $path;?>reserve/write.php" title="예약하기" alt="예약하기"><strong>예약하기</strong></a>
      <? }else{ ?>
          <a href="<? echo $path;?>member/login.php?table=gnb" title="예약하기" alt="예약하기"><strong>예약하기</strong></a>
          <? } ?>
     <ul class="listStyle absolute aLink2 aVisited2 aHover2">
       <?if($userid){?>
         <li><a href="<? echo $path;?>reserve/write.php" title="예약하기" alt="예약하기">예약하기</a></li>
       <? }else{ ?>
         <li><a href="<? echo $path;?>member/login.php?table=gnb&tbg=3" title="예약하기" alt="예약하기">예약하기</a></li>
       <? } ?>

    <li><a href="<? echo $path;?>reserve/info.php" title="예약안내" alt="예약안내">예약안내</a></li>

      </ul>
       </li>
     <li class="menu"><a href="<? echo $path;?>custom/notice/list.php" title="고객센터" alt="고객센터"><strong>고객센터</strong></a>
      <ul class="listStyle absolute aLink2 aVisited2 aHover2">
     <li><a href="<? echo $path;?>custom/notice/list.php" title="공지시항" alt="공지시항">공지사항</a></li>
     <li><a href="<? echo $path;?>custom/review/list.php" title="여행후기" alt="여행후기">여행후기</a></li>
     <li><a href="<? echo $path;?>custom/qna/list.php" title="Q&A" alt="Q&A">Q&A</a></li>
        </ul>
     </li>
       <li><a href="<? echo $path;?>event/list.php" title="이벤트" alt="이벤트"><strong>이벤트</strong></a></li>
    </ul>
 </div>
 </header>
 <? if($indexPage!=1 && $depth==2){ ?>
 <div id="<?=$sliderTitleBg?>" class="sliderTitle boxShadow2">
  <h1 class="txtCenter txtColorWhiteColor txtShadowGray"><?=$sliderTitle?></h1>
 </div>
 <div id="subnavi">
  <ul>
    <li>
    <a href="<? echo $path;?>index.php" title="메인페이지이동" alt="메인페이지이동">
    <img src="<? echo $path;?>img/icoHome.jpg" title="홈아이콘" alt="홈아이콘"></a></li>
    <li><span><?=$subTitle?></span></li>
    <li><span>>&nbsp;&nbsp;&nbsp;&nbsp;<?=$sliderTitle?></span></li>
  </ul>
 </div>
 <div class="contentsWrap mgt1">
 <?}?>

 <?if($indexPage!=1 && $depth==3){ ?>
 <div id="<?=$sliderTitleBg?>" class="sliderTitle boxShadow2">
  <h1 class="txtCenter txtColorWhiteColor txtShadowGray"><?=$sliderTitle?></h1>
 </div>
 <div id="subnavi">
  <ul>
    <li>
    <a href="<? echo $path;?>index.php" title="메인페이지이동" alt="메인페이지이동">
    <img src="<? echo $path;?>img/icoHome.jpg" title="홈아이콘" alt="홈아이콘"></a></li>
    <li>>&nbsp;&nbsp;&nbsp;&nbsp;고객센터</li>
    <li><span>>&nbsp;&nbsp;&nbsp;&nbsp;<?=$sliderTitle?></span></li>
  </ul>
 </div>
 <div class="contentsWrap mgt1">
 <?}?>
