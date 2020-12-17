<?php
  include "./../lib/session.php";
  include "./../lib/dbconn.php";

  if(!$usernum){
    echo("
      <script>
        location.href='../member/login.php';
      </script>
    ");
  }

  $depth=2;
  $title="여행상품 수정하기|힐링여행 - 여행 상품 판매";
  $sliderTitle="예약확인/취소";
  $subTitle="예약안내";
  $sliderTitleBg="sliderTitle3";
  $travel_no=$_GET["travel_no"];
  $travel_title=$_GET["travel_title"];
  $page=$_GET["page"];
  $table="reserve";
  $no=$_GET["no"];
  include "./../lib/header.php";

  if(!$no){
    echo("
    <script>
    history.go(-1);
    </script>
    ");
    exit;
  }
?>
<body onload="init(<?=$travel_no?>)">
<script>
function init(no) {
  var travel_no1 = document.reserveform.travel_no1.value=Number(no);
  return travel_no1;
}
function changeTravelpackage(travel_option_value, travel_title) {
  var start_of_date = document.getElementById("start_of_date");
  if(start_of_date.value!=""){
      changeDate("start_of_date",start_of_date.value);
  }

var travel_option_value = travel_option_value.split('/');
//alert(travel_option_value[0]+" "+travel_option_value[1]+" "+travel_title);

var travel_no1 = document.reserveform.travel_no1.value=Number(travel_option_value[0]);
return travel_no1;


}

function changeDate(name, date) {
  var target = document.getElementById("travel_title");
  var travel_option_value=target.options[target.selectedIndex].value;
  var travel_period= travel_option_value.split('/');
  if(Number(travel_period[1])=="0"){
    alert("여행상품을 선택해주세요.");
    var a=document.reserveform.start_of_date.value="";
    var b=document.reserveform.end_of_date.value="";
    return a,b;
  }
  if(name=='start_of_date'){
      var arr1 = date.split('-');
      var date1 = new Date(arr1[0], arr1[1], arr1[2]);
      date1.setDate(date1.getDate() + (Number(travel_period[1])-1));
      if(date1.getMonth() < 10){
        var date2 =date1.getFullYear() + "-0" + date1.getMonth();
      }else{
      var date2 =date1.getFullYear() + "-" + date1.getMonth();
      }

      if(date1.getDate() < 10){
      date2+="-0" + (date1.getDate());
    }else{
      date2+="-" + (date1.getDate());
    }
      //console.log(date2);
      return document.reserveform.end_of_date.value=date2;
  }
  if(name=='end_of_date'){
      var arr2 = date.split('-');
      var date3 = new Date(arr2[0], arr2[1], arr2[2]);
      date3.setDate(date3.getDate() - (Number(travel_period[1])-1));
      if(date3.getMonth() < 10){
        var date4 =date3.getFullYear() + "-0" + date3.getMonth();
      }else{
      var date4 =date3.getFullYear() + "-" + date3.getMonth();
      }

      if(date3.getDate() < 10){
      date4+="-0" + (date3.getDate());
    }else{
      date4+="-" + (date3.getDate());
    }
      //console.log(date2);
      return document.reserveform.start_of_date.value=date4;
  }
}</script>

<?
$sql="select * from $table where no=$no";
$result=mysql_query($sql, $connect);
$row = mysql_fetch_array($result);

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
?>

<div class="title01">
  <h4 id="heading">RESERVE&nbsp;&nbsp;|</h4><span>예약정보 수정</span>
</div>
<form name="reserveform" method="post" action="modify_ok.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>">
  <table class="tb_size borTop">
  <tr><th class="th_size">상품명</th><td>
  <select name="travel_title" id="travel_title" class="select1" onchange="changeTravelpackage(this.options[this.selectedIndex].value, this.options[this.selectedIndex].text)" required>
    <option name="default" value="0" selected>상품을 선택해주세요</option>
  <?
    $sql="SELECT no, title, travel_period from travelpackages order by no desc";
    $result=mysql_query($sql, $connect);
    while($row = mysql_fetch_array($result)){
      $no=$row[no];
      $title=$row[title];
      $travel_period=$row[travel_period];
  ?>
    <option name="<?=$no?>" value="<?=$no."/".$travel_period?>" <? if($no==$travel_no){?> selected<?}?>><?=$title?> / <?=$travel_period-1?>박 <?=$travel_period?>일 패키지 여행</option>
  <? }?>
  </select>
  </td></tr>
    <tr><th>희망일</th><td><input type="date" class="input2" id="start_of_date" name="start_of_date" value="<?=substr($start_of_date, 0, 10);?>" onchange="changeDate(this.name, this.value)" required> ~ <input  class="input2" type="date" id="end_of_date" name="end_of_date" value="<?=substr($end_of_date, 0, 10);?>" onchange="changeDate(this.name, this.value)" required></td></tr>
    <tr><th>인원수</th><td><input class="input2" type="number" name="number_of_people" min="2" max="50" value="<?=$number_of_people?>"></td></tr>
    <tr><th>추가문의</th><td><textarea name="inquiry_message" rows="10" cols="90"><?=$inquiry_message?></textarea></td></tr>
    <tr><th>예약상태</th><td><?=$status ?></td></tr>

  </table>
  <div class="txtCenter mgt1">
    <a href="javascript:history.back();"><button type="button" class="button gray">뒤로가기</button></a>
    <button type="submit" name="submit" id="submit" class="button black">수정 완료</button></div>
    <input type='hidden' name='travel_no1' value="0">
  </form>

  <?
  mysql_query($sql, $connect);
  mysql_close();
  include "./../lib/footer.php";
  ?>
