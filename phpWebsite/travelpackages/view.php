<?php
  include "./../lib/session.php";
  $depth=2;
  $title="여행상품 상세보기|힐링여행 - 여행 상품 판매";
  $sliderTitle="여행상품";
  $sliderTitleBg="sliderTitle2";
  include "./../lib/header.php";
  include "./../lib/dbconn.php";

  $table=$_GET["table"];
  $no=$_GET["no"];
  $page=$_GET["page"];
  $upload_dir="../data/";
  $pageType="view";

  if(!$no){
    echo("
    <script>
    history.go(-1);
    </script>
    ");
    exit;
  }

  $sql="select * from $table where no=$no";
  $result=mysql_query($sql, $connect);
  $row=mysql_fetch_array($result);

  $no=$row[no];
  $title=str_replace(" ", "&nbsp;", $row[title]);
  $subtitle=str_replace(" ", "&nbsp;", $row[subtitle]);
  $country=$row[country];
  $travel_period=$row[travel_period];
  $included=str_replace(" ", "&nbsp;", $row[included]);
  $not_included=str_replace(" ", "&nbsp;", $row[not_included]);
  $schedule=str_replace(" ", "&nbsp;", $row[schedule]);
  $infomation=str_replace(" ", "&nbsp;", $row[infomation]);
  $hit=$row[hit];
  $thum_copied_0=$row[thum_copied_0];
  $thum_copied_1=$row[thum_copied_1];
  $thum_copied_2=$row[thum_copied_2];
  $thum_copied_3=$row[thum_copied_3];
  $thum_copied_4=$row[thum_copied_4];
  $thum_copied_5=$row[thum_copied_5];
  $thum_copied_6=$row[thum_copied_6];


  $new_hit=$hit+1;
  $sql="update $table set hit=$new_hit where no=$no";
  mysql_query($sql, $connect);
?>
 <script src="./../lib/common.js"></script>
 <link rel="stylesheet" type="text/css" href="./../css/travelpackages.css">
 <link rel="stylesheet" type="text/css" href="./../css/tapStyles.css">
 <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
 <script src="./../js/jquery.tabslet.min.js"></script>
 <script src="./../js/initializers.js"></script>
 <script src="./../js/jquery.cycle2.js"></script>


 <ul class="item-container content-center">
 <li class="item">
 <a href="view.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>">
 <img src="../data/<?=$thum_copied_0?>">
 <div class="dark-cover"></div>
 <div class="content content-middle">
 <h2 class="mgb4 txtCenter txtColorWhiteColor"><?=$title ?></h2>
 <h3 class="txtCenter mgb6 txtColorWhiteColor"><?=$subtitle?></h3>
 <div class="sub-title2"><?=$country?> / <?=$travel_period?>일 패키지 여행</div>
 </div>
 <div class="content content-bottom">
   <?if($userid){?>
   <a href="../reserve/write.php?no=<?=$no?>&page=<?=$page?>&travel_no=<?=$no?>&travel_title=<?=$title?>#step2"><button class="button green">예약하기</button></a>
   <? }else{ ?>
     <a href="../member/login.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>&pageType=<?=$pageType?>"><button class="button green">예약하기</button></a>
   <? }
   ?></div>
 </a>
 </li>
 </ul>
 <p class="box"><?=$schedule?></p>
 <div class="cycle-slideshow" data-cycle-fx="scrollHorz" data-cycle-pause-on-hover="true" data-cycle-speed="300">
   <div class="cycle-pager"></div>
    <img src="../data/<?=$thum_copied_1?>" title="<?=$title?>" alt="<?=$title ?>">
    <img src="../data/<?=$thum_copied_2?>" title="<?=$title?>" alt="<?=$title ?>">
    <img src="../data/<?=$thum_copied_3?>" title="<?=$title?>" alt="<?=$title ?>">
    <img src="../data/<?=$thum_copied_4?>" title="<?=$title?>" alt="<?=$title ?>">
    <img src="../data/<?=$thum_copied_5?>" title="<?=$title?>" alt="<?=$title ?>">
    <img src="../data/<?=$thum_copied_6?>" title="<?=$title?>" alt="<?=$title ?>">
 </div>
 <div>
  <div class="mgt4 floatLeft colHalf"><h4 class="mgb4">01 / 포함·불포함 사항</h4>
    <p><ul><li>포함 : <?=$included?></li><li>불포함 : <?=$not_included?></li></p>
  </div>
  <div class="mgt4 floatRight colHalf"><h4 class="mgb4">02 / 기타안내</h4>
    <p class="mgb1"><?=$infomation?></p>
  </div>
 </div>

<div class="clearBoth txtCenter mgt1">
  <a href="list.php?table=<?=$table?>&page=<?=$page?>"><button class="button gray">목록</button></a>
  <?if($userid){?>
  <a href="../reserve/write.php?no=<?=$no?>&page=<?=$page?>&travel_no=<?=$no?>&travel_title=<?=$title?>"><button class="button green">예약하기</button></a>
  <? }else{ ?>
    <a href="../member/login.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>&pageType=<?=$pageType?>"><button class="button green">예약하기</button></a>
  <? }
    if($userlevel==1){
          ?>
          <a href="modify.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>"><button class="button black">수정</button></a>
          <a href="javascript:del('<?=$table?>','<?=$no?>','<?=$page?>')"><button class="button black">삭제</button></a>

          <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?
include "./../lib/footer.php";
?>
