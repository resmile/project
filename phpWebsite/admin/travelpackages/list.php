<?php
  include "./../../lib/session.php";
  $depth=3;
  $title="여행상품 목록보기|힐링여행 - 여행 상품 판매";
  $sliderTitle="여행상품";
  $sliderTitleBg="sliderTitle2";
  include "./../../lib/adminHeader.php";
  include "./../../lib/dbconn.php";
  $table="travelpackages";
  $cntNo="no";
  $pageType="list";
  include "./../../lib/paging.php";

  $sortValue=$_GET["sort"];
  if(!$sortValue){ $sortValue="no";}

  $page=$_GET["page"];
  $scale=10;

  $sql="select * from $table order by $sortValue desc";// 정렬 추가
  //$sql="SELECT r.no AS 'no', r.tp_no, t.title, r.number_of_people, r.reserve_day, r.start_of_date, r.end_of_date, r.status from reserve r, travelpackages t where r.member_no=$usernum and r.tp_no=t.no order by $sortValue desc";

  //$sql="select t.no, t.title, r.cnt, t.country, t.travel_period from travelpackages as t, ( select tp_no, count(tp_no) AS cnt from reserve group by tp_no having count(tp_no) > 1 ) as r where t.no = r.tp_no order by $sortValue desc";


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

?>

<div class="title01">
  <h4 id="heading">TRAVEL PACKAGES&nbsp;&nbsp;|</h4><span>여행상품관리</span>
  <p class="txtRight floatRight">
      <select name="sortSelect" id="sortSelect" class="select1" onchange="location.href='list.php?table=<?=$table?>&sort='+this.options[this.selectedIndex].value+'&page=<?=$page?>'">
        <option name="sort1" value="no" <? if($sortValue=="no"){?> selected<?}?>>등록일순</option>
        <option name="sort2" value="hit" <? if($sortValue=="hit"){?> selected<?}?>>조회수순</option>
      </select>
  </p>
</div>
<table id="qboard" class="tb_size borTop">
  <tr>
   <th scope="col" alt="번호" title="번호"> 번호</th>
   <th scope="col" alt="제목" title="제목">제목</th>
   <th scope="col" alt="나라" title="나라">나라</th>
   <th scope="col" alt="여행기간" title="여행기간">여행기간</th>
   <th scope="col" alt="조회수" title="조회수">조회수</th>
   <th scope="col" alt="관리" title="관리">&nbsp;</th>
  </tr>
  <?
  //while($row = mysql_fetch_array($result)){
  $reserved_sql="select member_no, count(member_no) AS cnt from reserve where status='예약완료' group by member_no";
  $reserved_result=mysql_query($reserved_sql, $connect);
  $reserved_rec=mysql_fetch_array($reserved_result);
  $reserved_total_record=mysql_num_rows($reserved_result);

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
    $hit=$row[hit];
  ?>
  <tr>
   <td scope="row" class="numType txtCenter"><?=$no?></td>
   <td scope="row" class="titleType"><a href="./../../travelpackages/view.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>" target="_blank"><?=$title?> </a> </td>
   <td scope="row" class="idType txtCenter"><?=$country ?></td>
   <td scope="row" class="dateType txtCenter"><?=$travel_period?>일</td>
   <td scope="row" class="dateType txtCenter"><?=$hit?></td>
   <td scope="row" class="delType txtCenter">
     <a href="modify.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>"><button class="postbutton black txtCenter">수정</button></a>
     <a href="javascript:del('<?=$table?>','<?=$no?>','<?=$page?>')"><button class="postbutton black txtCenter">삭제</button></a>
   </td>
  </tr>

  <?
    $number--;
  }
  if($number < 0){
  ?>
      <td scope="row" class="txtCenter" colspan="6">등록된 글이 없습니다.</td>
  <?
  }
  ?>
</table>

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
  include "./../../lib/adminFooter.php";
  ?>
