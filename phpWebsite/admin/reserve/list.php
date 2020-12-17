<?
include "./../../lib/session.php";

if(!$usernum){
  echo("
    <script>
      location.href='../member/login.php';
    </script>
  ");
}

$depth=3;
$title="예약확인/취소|힐링여행 - 여행 상품 판매";
$sliderTitle="예약확인/취소";
$subTitle="마이페이지";
$sliderTitleBg="sliderTitle3";
include "./../../lib/adminHeader.php";
include "./../../lib/dbconn.php";
$table="reserve";
$cntNo="no";
$sortValue=$_GET["sort"];
if(!$sortValue){ $sortValue="no";}


$page=$_GET["page"];
$scale=10;

$sql="SELECT r.no AS 'no', r.tp_no, t.title, r.id, r.name, r.number_of_people, r.reserve_day, r.start_of_date, r.end_of_date, r.status from reserve r, travelpackages t where r.tp_no=t.no order by $sortValue desc";
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
<script src="./../../lib/common.js"></script>
<div class="title01">
  <h4 id="heading">RESERVE&nbsp;&nbsp;|</h4><span>예약확인/취소</span>
  <p class="txtRight floatRight">
      <select name="sortSelect" id="sortSelect" class="select1" onchange="location.href='list.php?table=<?=$table?>&sort='+this.options[this.selectedIndex].value+'&page=<?=$page?>'">
        <option name="sort1" value="no" <? if($sortValue=="no"){?> selected<?}?>>등록일순</option>
        <option name="sort2" value="reserve_day" <? if($sortValue=="reserve_day"){?> selected<?}?>>예약일순</option>
        <option name="sort3" value="start_of_date" <? if($sortValue=="start_of_date"){?> selected<?}?>>최신 여행시작일순</option>
        <option name="sort5" value="status" <? if($sortValue=="status"){?> selected<?}?>>예약상태순</option>
      </select>
  </p>
</div>

<table class="tb_size txtCenter borTop">
  <tr>
    <th class="numType">번호</th>
    <th class="titleType1">여행상품명</th>
    <th class="idType">아이디</th>
    <th class="idType">예약자명</th>
    <th class="numType">인원수</th>
    <th class="dateType">예약일</th>
    <th class="dateType2">희망일</th>
    <th class="nameType">예약상태</th>
    <th class="delType">&nbsp;</th>
  </tr>

<?
$sql="SELECT r.no AS 'no', r.tp_no, t.title, r.id, r.name, r.number_of_people, r.reserve_day, r.start_of_date, r.end_of_date, r.status from reserve r, travelpackages t where r.tp_no=t.no order by $sortValue desc";
$result=mysql_query($sql, $connect);
for($i=$start; $i<$start+$scale && $i<$total_record; $i++){
  mysql_data_seek($result, $i);
  $row = mysql_fetch_array($result);
  $no=$row[no];
  $id=$row[id];
  $name=$row[name];
  $reserve_day=$row[reserve_day];
  $tp_no=$row[tp_no];
  $number_of_people=$row[number_of_people];
  $start_of_date=$row[start_of_date];
  $end_of_date=$row[end_of_date];
  $inquiry_message=str_replace(" ", "&nbsp;", $row[inquiry_message]);
  $status=$row[status];
  $tp_title=str_replace(" ", "&nbsp;", $row[tp_title]);
  $travel_period=$row[travel_period];
  $travel_title=$row[title];
?>
<tr>
    <td><?=$no?></td>
    <td><?=$travel_title?></td>
    <td><?=$id?></td>
    <td><?=$name?></td>
    <td><?=$number_of_people?></td>
    <td><?=$reserve_day?></td>
    <td><?=substr($start_of_date, 0, 10);?><br>~<?=substr($end_of_date, 0, 10);?></td>
    <td><?=$status ?></td>
    <td>
      <a href="view.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>&travel_title=<?=$travel_title?>"><button class="postbutton black">상세보기</button></a>

      <?switch ($status) {
        case "예약완료":
      ?>
        <a href="modify.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>&travel_no=<?=$tp_no?>&travel_title=<?=$travel_title?>"><button class="postbutton black">수정</button></a>
        <a href="javascript:del1('cancel','<?=$table?>','<?=$no?>','<?=$page?>','취소')"><button class="postbutton green">예약취소</button></a>
      <?
        break;
        case "예약취소":?>
        <a href="javascript:del1('delete','<?=$table?>','<?=$no?>','<?=$page?>','삭제')"><button class="postbutton green">예약 삭제</button></a>

        <?
          break;
      }
        ?>
</td>

</tr>
<?
  $number--;
}
if($number < 0){
?>
    <tr>
        <td colspan="9">등록된 글이 없습니다.</td>
    </tr>
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
      ?>
</div>

<?
include "./../../lib/adminFooter.php";
?>
