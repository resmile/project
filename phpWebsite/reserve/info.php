<?
include "./../lib/session.php";
$depth=2;
$title="예약안내|힐링여행 - 여행 상품 판매";
$sliderTitle="예약안내";
$sliderTitleBg="sliderTitle3";
include "./../lib/header.php";
?>
<style>
#process { height:200px;}
#process h4 { float:left; width:110px; height: 110px; margin:5px;padding:15px;border-radius: 50%; background-color: #ddd;}
#process h4:hover { background-color: #71bf44; color:#fff;}
</style>
<h2 class="mgb3 txtCenter"><span>예약안내</span></h2>
 <h4 class="mgb4">01 / 예약안내</h4>
 <ul style="margin-left:25px;">
   <li>여행상품의 예약은 온라인상에서, 전화, 또는 e-mail을 통해 문의 및 예약하실수 있습니다.<br>(단, 전화상담 가능시간 월~금 09:00 - 18:00 / 토 09:00 - 13:00 )</li>
   <li>예약시 필요한 정보는 여행일정(시작일~종료일), 인원수, 연락처(핸드폰, 메일주소)입니다.</li>
   <li>예약후 24시간내에 고객님께 전화나 메일로 여행 출발일로부터 종료일까지 예약의 전반적인 사항을 체크하여 처리해 드립니다.</li>
   <li>온라인상 예약은 최소 여행 출발일 3일전에 하셔야 하며, 그외의 경우 담당자에게 문의후 예약 바랍니다. </li>
   <li>일부 상품은 출발 최소인원(보통 4명)이 모집되지 않았을 때 출발하지 않는 상품도 있습니다. 이 경우 담당자가 연락을 드립니다.</li>
   <li>예약확인은 로그인을 하시면 우측 상단 [예약확인/취소] 메뉴에서 고객님의 예약상황을 확인하실 수 있습니다.</li>
   <li>여행요금은 예약후 5일 이내 예약금을 입금하셔야 하며, 잔금은 여행 시작 당일 현장에서 결제하시면 됩니다.</li>
   <li class="mgb1">예약금은 보통 여행경비의 10%정도 입금하면 되며 입금 후 전화나 e-mail 주시면 더욱 신속하게 처리됩니다</li>
 </ul>
 <h4 class="mgb4">02 / 예약 프로세스</h4>
  <div id="process">
   <h4 class="txtCenter">01<br>로그인</h4>
    <h4 class="txtCenter">02<br>여행상품선택</h4>
    <h4 class="txtCenter">03<br>출발일정<br>/인원 선택</h4>
    <h4 class="txtCenter">04<br>예약확인</h4>
    <h4 class="txtCenter">05<br>예약금 입금</h4>
    <h4 class="txtCenter">06<br>잔금 현장<br>결제</h4>
  </div>

<h2 class="mgb3 txtCenter"><span>취소안내</span></h2>
 <h4 class="mgb4">01 / 취소안내</h4>
 <ul style="margin-left:25px;">
   <li>예약취소는 로그인을 하시면 우측 상단 [예약확인/취소] 메뉴에서 예약을 취소하실 수 있습니다.</li>
   <li>최소 예약인원 미달로 여행이 취소 되는 경우 예약금 전액 환불 처리 됩니다.</li>
   <li>예약 취소시 필요한 정보는 환불받을 계좌의 은행명과 예금주, 계좌번호입니다.</li>
   <li class="mgb1">예약 취소 후 24시간내에 고객님께 전화나 메일로 예약취소의 전반적인 사항을 체크하여 처리해 드립니다.</li>
 </ul>
 <h4 class="mgb4">02 / 취소 프로세스</h4>
  <div id="process">
   <h4 class="txtCenter">01<br>로그인</h4>
    <h4 class="txtCenter">02<br>예약 내역<br>확인</h4>
    <h4 class="txtCenter">03<br>예약 취소<br>신청</h4>
    <h4 class="txtCenter">04<br>예약 취소<br>완료</h4>
    <h4 class="txtCenter">05<br>예약금 환불</h4>
  </div>

<?
include "./../lib/footer.php";
?>
<script type="text/javascript" src="../js/accordion.js"></script>
