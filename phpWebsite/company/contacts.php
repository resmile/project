<?php
  include "./../lib/session.php";
  $depth=2;
  $title="오시는 길|힐링여행 - 여행 상품 판매";
  $sliderTitle="오시는 길";
  $subTitle="회사소개";
  $sliderTitleBg="sliderTitle1";
  include "./../lib/header.php";
?>
  <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
  <script src="./../js/googlemap.js"></script>
 <body onload="initialize()">
    <h2 class="mgb3 txtCenter"><span>CONTACT US</span></h2>
    <h3 class="txtCenter mgb1">서울시 강남구 역삼동 815-4</h3>
    <div id="map_view" style="width:980px; height:300px;" class="mgb5"></div>
    <ul class="mgl3">
    <li>지하철2호선 강남역 11번 출구에서 50m 직진(만이빌딩 5층)</li>
  </ul>
  <?
  include "./../lib/footer.php";
  ?>
