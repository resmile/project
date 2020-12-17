<?php
include "./../../lib/session.php";
  $depth=3;
  $title="여행상품 글쓰기|힐링여행 - 여행 상품 판매";
  $sliderTitle="여행상품";
  $sliderTitleBg="sliderTitle2";
  include "./../../lib/adminHeader.php";
  include "../../lib/dbconn.php";

  $table=$_GET["table"];
  $page=$_GET["page"];
?>
<div class="title01">
  <h4 id="heading">TRAVEL PACKAGES&nbsp;&nbsp;|</h4><span>여행상품작성</span>
</div>
<form name="reserveform" method="post" action="write_ok.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>"  enctype="multipart/form-data">
  <table class="tb_size borTop">
    <tr><th class="th_size">작성자ID</th><td><?=$userid?></td></tr>
    <tr><th>작성자명</th><td><?=$username?></td></tr>
    <tr><th>여행상품명</th><td><input type="text" name="title" value="" class="textarea1" required></td></tr>
    <tr><th>여행상품간략소개</th><td><input type="text" name="subtitle" class="textarea1" value="" required></td></tr>
    <tr><th>나라</th><td><input type="text" name="country" value="" class="textarea1" required></td></tr>
    <tr><th>여행기간</th><td><input type="text" name="travel_period" value="" class="textarea1" required></td></tr>
    <tr><th>포함</th><td><textarea name="included" rows="10" cols="90" required></textarea></td></tr>
    <tr><th>불포함</th><td><textarea name="not_included" rows="10" cols="90" required></textarea></td></tr>
    <tr><th>여행 일정</th><td><textarea name="schedule" rows="10" cols="90" required></textarea></td></tr>
    <tr><th>기타 안내</th><td><textarea name="infomation" rows="10" cols="90" required></textarea></td></tr>
    <tr><th>썸네일 첨부1</th><td><input type="file" name="upfile[]" required></input></td></tr>
    <tr><th>썸네일 첨부2</th><td><input type="file" name="upfile[]" required></input></td></tr>
    <tr><th>썸네일 첨부3</th><td><input type="file" name="upfile[]" required></input></td></tr>
    <tr><th>썸네일 첨부4</th><td><input type="file" name="upfile[]" required></input></td></tr>
    <tr><th>썸네일 첨부5</th><td><input type="file" name="upfile[]" required></input></td></tr>
    <tr><th>썸네일 첨부6</th><td><input type="file" name="upfile[]" required></input></td></tr>
    <tr><th>썸네일 첨부7</th><td><input type="file" name="upfile[]" required></input></td></tr>
    </table>
  <div class="txtCenter mgt1">
    <a href="javascript:history.back();"><button type="button" class="button gray">뒤로가기</button></a>
    <button type="submit" name="submit" id="submit" class="button black">글쓰기 완료</button></div>
  </form>
  <?
  include "./../../lib/adminFooter.php";
  ?>
