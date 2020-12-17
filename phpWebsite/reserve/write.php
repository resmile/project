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
  $title="여행상품 예약하기|힐링여행 - 여행 상품 판매";
  $sliderTitle="예약하기";
  $subTitle="예약안내";
  $sliderTitleBg="sliderTitle3";
  $travel_no=$_GET["travel_no"];
  $travel_title=$_GET["travel_title"];
  $page=$_GET["page"];
  $table="reserve";
  include "./../lib/header.php";
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
    //alert(travel_period);
    if(travel_period==0){
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
  }

  function selectProduct(tp_no,tp_title,tp_period) {
    var travel_option_value=tp_no+"/"+tp_period;
    //console.log(travel_option_value);
    var travel_title = document.reserveform.travel_title;
    for(var i=0;i<travel_title.length;i++){
      //console.log(travel_option_value+ " : "+travel_title.options[i].value);
      //console.log(travel_title.options[i].selected);
      //console.log(travel_title.options[i].value);
      //console.log(travel_title.options[i].text);
      travel_title.options[i].removeAttribute("selected");
      if(travel_option_value == travel_title.options[i].value){
        console.log("if true");
        travel_title.options[i].setAttribute('selected','selected');
        changeTravelpackage(travel_option_value, tp_title);
      }
    }
  }
  </script>
<link rel="stylesheet" type="text/css" href="./../css/travelpackages.css">
<div class="title01">
  <h4 id="heading">STEP01. 상품선택&nbsp;&nbsp;|</h4><span>여행상품을 선택해주세요.</span>
</div>
<div style="border-bottom:2px solid #222" class="mgb1"></div>
<ul class="item-container content-center">
  <?
  $sql1="SELECT * from travelpackages order by no desc";
  $result1=mysql_query($sql1, $connect);
  while($row = mysql_fetch_array($result1)){

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
  <li class="item1 mgb1">
  <img src="../data/<?=$thum_copied_0?>" width="100%" height="100%">
  <div class="dark-cover"></div>
  <div class="content content-middle">
  <h4 class="mgb4 txtCenter txtColorWhiteColor"><?=$title ?></h4>
  <div class="sub-title2"><?=$country?> / <?=$travel_period?>일 패키지 여행</div>
  </div>
  <div class="content content-bottom">

  <a href="#step2"><button class="button green" onclick="selectProduct(<?=$no?>,'<?=$title?>',<?=$travel_period?>)">선택하기</button></a>
</div>
  </li>
  <?
    $noArticle++;
  }
  if($noArticle == 0){
  ?>
      <div class="txtCenter">등록된 글이 없습니다.</div>
  <?
  }
  ?>
  </ul>




  <div class="title01">
    <h4 id="heading"><a name="step2">STEP02. 예약정보입력&nbsp;&nbsp;|<a></h4><span>출발일정 및 인원을 입력해주세요.</span>
  </div>

<form name="reserveform" method="post" action="write_ok.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>"  enctype="multipart/form-data">
  <table class="tb_size topPad borTop">
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
    <tr><th>희망일</th><td><input type="date" class="input2" id="start_of_date" name="start_of_date" value="" onchange="changeDate(this.name, this.value)" required> ~ <input  class="input2" type="date" id="end_of_date" name="end_of_date" value="" onchange="changeDate(this.name, this.value)" required></td></tr>
    <tr><th>인원수</th><td><input type="number" class="input2" name="number_of_people" min="2" max="50" value="2"></td></tr>
    <tr><th>추가문의</th><td><textarea name="inquiry_message" rows="10" cols="90"></textarea></td></tr>
  </table>
  <div class="txtCenter mgt1">
    <a href="javascript:history.back();"><button type="button" class="button gray">뒤로가기</button></a>
    <?if($userlevel==1){ ?>
      <button type="button" name="submit" id="submit" class="button black" onclick="alert('관리자는 예약을 할 수 없습니다.')">예약 완료</button></div>
    <?}else{?>
      <button type="submit" name="submit" id="submit" class="button black">예약 완료</button></div>
     <?}?>
    <input type='hidden' name='travel_no1' value="0">
  </form>
  <?
include "../lib/footer.php";
?>
