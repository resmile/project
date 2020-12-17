<?php
  include "./../lib/session.php";
  $depth=2;
  $title="예약 상세보기|힐링여행 - 여행 상품 판매";
  $sliderTitle="예약확인/취소";
  $subTitle="예약안내";
  $sliderTitleBg="sliderTitle3";
  include "./../lib/header.php";
  include "../lib/dbconn.php";

  $table=$_GET["table"];
  $no=$_GET["no"];
  $page=$_GET["page"];
  //$travel_title =$_GET["travel_title"];
  $sql="select * from $table where no=$no";

  $sql="SELECT r.name, r.no AS 'no', r.tp_no, t.title AS 'title', r.number_of_people, r.inquiry_message, r.reserve_day, r.start_of_date, r.end_of_date, r.status from reserve r, travelpackages t where r.member_no=$usernum and r.tp_no=t.no and r.no=$no";

  $result=mysql_query($sql, $connect);
  $row = mysql_fetch_array($result);

  if(!$no){
    echo("
    <script>
    history.go(-1);
    </script>
    ");
    exit;
  }

$id=$row[id];
$name=$row[name];
$travel_title=$row[title];
$reserve_day=$row[reserve_day];
$tp_no=$row[tp_no];
$number_of_people=$row[number_of_people];
$start_of_date=$row[start_of_date];
$end_of_date=$row[end_of_date];
$inquiry_message=str_replace(" ", "&nbsp;", $row[inquiry_message]);
$status=$row[status];
$tp_title=str_replace(" ", "&nbsp;", $row[tp_title]);
$travel_period=$row[travel_period];

/*
$is_html=$row[is_html];
if($is_html!="y"){
  $item_content=str_replace(" ","&nbsp;",$item_content);
  $item_content=str_replace("\n","<br>",$item_content);
}
*/

?>
 <script src="./../lib/common.js"></script>
 <div class="title01">
  <h4 id="heading">RESERVE&nbsp;&nbsp;|</h4><span>예약정보입니다.</span>
</div>
 <table class="tb_size borTop">
 <tr><th class="th_size">상품명</th><td><?=$travel_title?></td></tr>
<tr><th>예약자명</th><td><?=$name?></td></tr>
  <tr><th>예약일</th><td><?=$reserve_day?></td></tr>
    <tr><th>인원수</th><td><?=$number_of_people?> 명</td></tr>
  <tr><th>희망일</th><td><?=substr($start_of_date, 0, 10);?> ~ <?=substr($end_of_date, 0, 10);?></td></tr>
  <tr><th>추가문의</th><td><?=$inquiry_message?></td></tr>
  <tr><th>예약상태</th><td><?=$status ?></td></tr>

  <tr><td colspan="2" class="txtCenter view_area noborder">
    <?switch ($status) {
      case "예약완료":
    ?>
      <a href="modify.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>&travel_no=<?=$tp_no?>&travel_title=<?=$travel_title?>"><button class="button black">수정</button></a>
      <a href="javascript:del1('cancel','<?=$table?>','<?=$no?>')"><button class="button green">예약취소</button></a>
    <?
      break;
    }
      ?>
      <a href="list.php?table=<?=$table?>&page=<?=$page?>"><button class="button gray">목록</button></a>
</td>
</tr>
</table>




<?
mysql_query($sql, $connect);
mysql_close();
include "./../lib/footer.php";
?>
