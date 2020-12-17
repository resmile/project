<?php
  include "./../lib/session.php";
  $depth=2;
  $title="여행상품 목록보기|힐링여행 - 여행 상품 판매";
  $sliderTitle="여행상품";
  $sliderTitleBg="sliderTitle2";
  include "./../lib/header.php";
  include "./../lib/dbconn.php";
  $table="travelpackages";
  $cntNo="no";
  $pageType="list";
  include "./../lib/paging.php";

  $page=$_GET["page"];
  $scale=10;


  $sql="select * from $table order by no desc";// 정렬 추가
  $result=mysql_query($sql, $connect);
  $total_record=mysql_num_rows($result);
  if($total_record%$scale==0){
    $total_page=floor($total_record/$scale);
  }else{
    $total_page=floor($total_record/$scale)+1;
  }
  if(!$page or $page<1){
    $page=1;
  }
  $start=($page-1)*$scale;
  $number=$total_record-$start;

  /*$mode=$_GET["mode"];
  $find=$_POST["find"];
  $search=$_POST["search"];
  $scale=10;

  if($mode=="search"){
    $sql="select * from $table where $find like '%$search%' order by no desc";
  }else{
    $sql="select * from $table order by no desc";
  }*/
?>
<link rel="stylesheet" type="text/css" href="./../css/travelpackages.css">
<!--
<form name="board_form" method="post" action="list.php?table=<?=$table?>&mode=search">
  <div id="list_search">
    <div id="list_search_total_text">
      * 총 <b><?=$total_record?></b> 개의 게시물이 있습니다.
    </div>
    <div id="list_search_select_menu">
      <span>SELECT</span>
      <select name="find">
        <option value="title">여행상품명</option>
        <option value="content">내용</option>
        <option value="nick">나라</option>
        <option value="name">이름</option>
      </select>
    </div>
    <div id="list_search_input">
      <input type="text" name="search"></input>
      <input type="submit" value="검색하기"></input>
    </div>
  </div>
</form> -->
<ul class="item-container content-center">
  <?
  //while($row = mysql_fetch_array($result)){
  for($i=$start; $i<$start+$scale && $i<$total_record; $i++)
    {
    mysql_data_seek($result, $i);
    $row = mysql_fetch_array($result);
    $no=$row[no];
    $title=str_replace(" ", "&nbsp;", $row[title]);
    $subtitle=str_replace(" ", "&nbsp;", $row[subtitle]);
    $country=$row[country];
    $travel_period=$row[travel_period];
    $included=str_replace(" ", "&nbsp;", $row[included]);
    $not_included=str_replace(" ", "&nbsp;", $row[not_included]);
    $schedule=str_replace(" ", "&nbsp;", $row[schedule]);
    $infomation=str_replace(" ", "&nbsp;", $row[infomation]);
    $thum_copied_0=$row[thum_copied_0];
  ?>
  <li class="item mgb1">
  <a href="view.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>">
  <img src="../data/<?=$thum_copied_0?>">
  <div class="dark-cover"></div>
  <div class="content content-middle">
  <h2 class="mgb4 txtCenter txtColorWhiteColor"><?=$title ?></h2>
  <h3 class="txtCenter mgb6 txtColorWhiteColor"><?=$subtitle?></h3>
  <div class="sub-title2"><?=$country?> / <?=$travel_period?>일 패키지 여행</div>
  </div>
  <div class="content content-bottom">
  <a href="view.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>"><button class="button gray">자세히 보기</button></a>
  <?if($userid){?>
  <a href="../reserve/write.php?no=<?=$no?>&page=<?=$page?>&travel_no=<?=$no?>&travel_title=<?=$title?>#step2"><button class="button green">예약하기</button></a>
  <? }else{ ?>
    <a href="../member/login.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>&pageType=<?=$pageType?>"><button class="button green">예약하기</button></a>
  <? }
  ?></div>
  </a>
  </li>
  <?
    $number--;
  }
  if($number < 0){
  ?>
      <div class="txtCenter">등록된 글이 없습니다.</div>
  <?
  }
  ?>
  </ul>

  <div id="page_num" class="mgt1 mgb1 txtCenter">
<?php
    if(!$_GET["page"])
      $pages=1;
    else
      $pages=$_GET["page"];
  ?>
    <? if($page == 1) {
     } else {
    ?>
      <a href="list.php?page=<?=($pages-1)?>"><span class="backpage">&lt;</span></a>
    <?
    }
    ?>
    <?php
      for($i=1; $i<=$total_page;$i++){
        if($page==$i)
          echo "<b><span class='nowpage'> $i </span></b>";
        else
          echo "&nbsp;<a href='list.php?page=$i'><span class='pagenum'>$i</span></a>&nbsp;";
      }
    ?>
    <? if($page != $total_page) {
    ?>
      <a href="list.php?page=<?=($pages+1)?>"><span class="nextpage">&gt;</span></a>
        <? }
        if($userlevel==1){
        ?>
        <div class="txtRight"><a href="write.php?table=<?=$table?>&page=<?=$page?>"><button class="button black">글쓰기</button></a></div>
        <?php
        }
        ?>
  </div>


  <?
  include "./../lib/footer.php";
  ?>
