<?
include "./../../lib/session.php";
$depth=3;
$title="여행상품 수정하기|힐링여행 - 여행 상품 판매";
$sliderTitle="여행상품";
$sliderTitleBg="sliderTitle2";
include "./../../lib/adminHeader.php";
include "./../../lib/dbconn.php";

$table=$_GET["table"];
$no=$_GET["no"];
$page=$_GET["page"];

$sql="select * from $table where no=$no";
$result=mysql_query($sql, $connect);
$row=mysql_fetch_array($result);

$no=$row[no];
$id=$row[id];
$name=$row[name];
$title=$row[title];
$subtitle=$row[subtitle];
$country=$row[country];
$travel_period=$row[travel_period];
$included=$row[included];
$not_included=$row[not_included];
$schedule=$row[schedule];
$infomation=$row[infomation];
$regist_day=$row[regist_day];
$thum_name_0=$row[thum_name_0];
$thum_name_1=$row[thum_name_1];
$thum_name_2=$row[thum_name_2];
$thum_name_3=$row[thum_name_3];
$thum_name_4=$row[thum_name_4];
$thum_name_5=$row[thum_name_5];
$thum_name_6=$row[thum_name_6];
$thum_name_7=$row[thum_name_7];
$thum_copied_0=$row[thum_copied_0];
$thum_copied_1=$row[thum_copied_1];
$thum_copied_2=$row[thum_copied_2];
$thum_copied_3=$row[thum_copied_3];
$thum_copied_4=$row[thum_copied_4];
$thum_copied_5=$row[thum_copied_5];
$thum_copied_6=$row[thum_copied_6];
$thum_copied_7=$row[thum_copied_7];
$thum_type_0=$row[thum_type_0];
$thum_type_1=$row[thum_type_1];
$thum_type_2=$row[thum_type_2];
$thum_type_3=$row[thum_type_3];
$thum_type_4=$row[thum_type_4];
$thum_type_5=$row[thum_type_5];
$thum_type_6=$row[thum_type_6];
$thum_type_7=$row[thum_type_7];
?>
<div class="title01">
  <h4 id="heading">TRAVEL PACKAGES&nbsp;&nbsp;|</h4><span>여행상품수정</span>
</div>
<form name="reserveform" method="post" action="modify_ok.php?table=<?=$table?>&no=<?=$no?>&page=<?=$page?>"   enctype="multipart/form-data">
  <table class="tb_size borTop borBottom">
  <tr><th class="th_size">작성자ID</th><td><?=$userid?></td></tr>
  <tr><th>여행상품명</th><td><input type="text" name="title" class="inputHeight" value="<?=$title?>" required></td></tr>
  <tr><th>여행상품간략소개</th><td><input type="text" name="subtitle"  class="inputHeight"value="<?=$subtitle?>" required></td></tr>
  <tr><th>나라</th><td><input type="text" name="country"  class="inputHeight"value="<?=$country?>" required></td></tr>
  <tr><th>여행기간</th><td><input type="text" name="travel_period" class="inputHeight" value="<?=$travel_period?>" required></td></tr>
  <tr><th>포함</th><td><textarea name="included" rows="10" cols="90" required><?=$included?></textarea></td></tr>
  <tr><th>불포함</th><td><textarea name="not_included" rows="10" cols="90" required><?=$not_included?></textarea></td></tr>
  <tr><th>여행 일정</th><td><textarea name="schedule" rows="10" cols="90" required><?=$schedule?></textarea></td></tr>
  <tr><th>기타 안내</th><td><textarea name="infomation" rows="10" cols="90" required><?=$infomation?></textarea></td></tr>
  <tr><th>썸네일 첨부1</th><td><input type="file" name="upfile[]"></input><br>
    등록된 파일: <?=$thum_name_0?><input type="checkbox" name="del_file[]" value="0">삭제</input></td></tr>
  <tr><th>썸네일 첨부1</th><td><input type="file" name="upfile[]"></input><br>
    등록된 파일: <?=$thum_name_1?><input type="checkbox" name="del_file[]" value="1">삭제</input></td></tr>
  <tr><th>썸네일 첨부2</th><td><input type="file" name="upfile[]"></input><br>
  등록된 파일: <?=$thum_name_2?><input type="checkbox" name="del_file[]" value="2">삭제</input></td></tr>
  <tr><th>썸네일 첨부3</th><td><input type="file" name="upfile[]"></input><br>
  등록된 파일: <?=$thum_name_3?><input type="checkbox" name="del_file[]" value="3">삭제</input></td></tr>
  <tr><th>썸네일 첨부4</th><td><input type="file" name="upfile[]"></input><br>
  등록된 파일: <?=$thum_name_4?><input type="checkbox" name="del_file[]" value="4">삭제</input></td></tr>
  <tr><th>썸네일 첨부5</th><td><input type="file" name="upfile[]"></input><br>
  등록된 파일: <?=$thum_name_5?><input type="checkbox" name="del_file[]" value="5">삭제</input></td></tr>
  <tr><th>썸네일 첨부6</th><td><input type="file" name="upfile[]"></input><br>
  등록된 파일: <?=$thum_name_6?><input type="checkbox" name="del_file[]" value="6">삭제</input></td></tr>
  <tr><th>썸네일 첨부7</th><td><input type="file" name="upfile[]"></input><br>
  등록된 파일: <?=$thum_name_7?><input type="checkbox" name="del_file[]" value="7">삭제</input></td></tr>
  </table>
  <div class="txtCenter mgt1">
    <a href="javascript:history.back();"><button type="button" class="button gray">뒤로가기</button></a>
    <button type="submit" name="submit" id="submit" class="button black">수정 완료</button></div>
</form>
<?
include "./../../lib/adminFooter.php";
?>
