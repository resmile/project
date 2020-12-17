<?php
  include "lib/session.php";
  $depth=1;
  $title="힐링여행 - 여행 상품 판매";
  $indexPage=1;
  $page=$_GET["page"];
  include "lib/header.php";
  include "lib/dbconn.php";

?>
<link rel="stylesheet" type="text/css" href="css/slider-pro.min.css" media="screen"/>
<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="js/jquery.sliderPro.min.js"></script>
<script src="js/titleSlider.js"></script>
<div id="indexSlider" class="slider-pro boxShadow2">
  <div class="sp-slides">
    <div class="sp-slide">
      <img class="sp-image" src="img/blank.gif" data-src="img/indexSlider6.jpg" title="리티디언 포인트 피크닉" alt="리티디언 포인트 피크닉"/>
       <div id="indexSliderTitle1" class="sp-layer sp-padding txtCenter" data-show-transition="left" data-show-delay="600" data-position="centerCenter" data-width="500" data-height="210">
         <h1 class="txtColorWhiteColor">리티디언 포인트 피크닉</h1>
         <p class="mgt1 txtColorWhiteColor">신비롭고 아름다운 괌 해변</p>
         <h4 class="txtColorWhiteColor">괌 / 2일 패키지 여행</h4><br>
         <a href="./travelpackages/view.php?table=travelpackages&no=53&page=1"><button class="button gray">자세히 보기</button></a>
       </div>
    </div>
    <div class="sp-slide">
      <img class="sp-image" src="img/blank.gif" data-src="img/indexSlider5.jpg" title="로마 정복콘서트" alt="로마 정복콘서트"/>
       <div id="indexSliderTitle1" class="sp-layer sp-padding txtCenter" data-show-transition="left" data-show-delay="600" data-position="centerCenter" data-width="500" data-height="210">
         <h1 class="txtColorWhiteColor">로마 정복콘서트</h1>
         <p class="mgt1 txtColorWhiteColor">위대한 로마의 영광을 만나보세요.</p>
         <h4 class="txtColorWhiteColor">이탈리아 / 3일 패키지 여행</h4><br>
         <a href="./travelpackages/view.php?table=travelpackages&no=51&page=1"><button class="button gray">자세히 보기</button></a>
       </div>
    </div>
    <div class="sp-slide">
      <img class="sp-image" src="img/blank.gif" data-src="img/indexSlider4.jpg" title="1300년의 역사를 자랑하는 시라하마온천" alt="1300년의 역사를 자랑하는 시라하마온천"/>
       <div id="indexSliderTitle1" class="sp-layer sp-padding txtCenter" data-show-transition="left" data-show-delay="600" data-position="centerCenter" data-width="500" data-height="210">
         <h1 class="txtColorWhiteColor">1300년의 역사를 자랑하는<br>시라하마온천</h1>
         <p class="mgt1 txtColorWhiteColor">온천, 그리고 하얀 모래로 힐링하세요.</p>
         <h4 class="txtColorWhiteColor">일본 / 2일 패키지 여행</h4><br>
         <a href="./travelpackages/view.php?table=travelpackages&no=50&page=1"><button class="button gray">자세히 보기</button></a>
       </div>
    </div>
    <div class="sp-slide">
      <img class="sp-image" src="img/blank.gif" data-src="img/indexSlider3.jpg" title="대학과 낭만의 도시, 하이델베르크" alt="대학과 낭만의 도시, 하이델베르크"/>
       <div id="indexSliderTitle1" class="sp-layer sp-padding txtCenter" data-show-transition="left" data-show-delay="600" data-position="centerCenter" data-width="500" data-height="210">
         <h1 class="txtColorWhiteColor">대학과 낭만의 도시,<br>하이델베르크</h1>
         <p class="mgt1 txtColorWhiteColor">중세의 아름다운 모습을 담아가세요.</p>
         <h4 class="txtColorWhiteColor">독일 / 3일 패키지 여행</h4><br>
         <a href="./travelpackages/view.php?table=travelpackages&no=49&page=1"><button class="button gray">자세히 보기</button></a>
       </div>
    </div>
    <div class="sp-slide">
      <img class="sp-image" src="img/blank.gif" data-src="img/indexSlider2.jpg" title="순수와 은둔의 라오스" alt="순수와 은둔의 라오스"/>
       <div id="indexSliderTitle1" class="sp-layer sp-padding txtCenter" data-show-transition="left" data-show-delay="600" data-position="centerCenter" data-width="500" data-height="210">
         <h1 class="txtColorWhiteColor">순수와 은둔의 라오스</h1>
         <p class="mgt1 txtColorWhiteColor">느릿느릿한 삶을 엿보기</p>
         <h4 class="txtColorWhiteColor">라오스 / 8일 패키지 여행</h4><br>
         <a href="./travelpackages/view.php?table=travelpackages&no=48&page=1"><button class="button gray">자세히 보기</button></a>
       </div>
    </div>
    <div class="sp-slide">
      <img class="sp-image" src="img/blank.gif" data-src="img/indexSlider1.jpg" title="로맨틱 야경 투어" alt="로맨틱 야경 투어"/>
       <div id="indexSliderTitle1" class="sp-layer sp-padding txtCenter" data-show-transition="left" data-show-delay="600" data-position="centerCenter" data-width="500" data-height="210">
         <h1 class="txtColorWhiteColor">로맨틱 야경 투어</h1>
         <p class="mgt1 txtColorWhiteColor">우리의 밤은 당신의 낮보다 아름답다.</p>
         <h4 class="txtColorWhiteColor">파리 / 7일 패키지 여행</h4><br>
         <a href="./travelpackages/view.php?table=travelpackages&no=40&page=1"><button class="button gray">자세히 보기</button></a>
       </div>
    </div>
  </div>
</div>
  <div id="fontIndex" class="contentsWrap">
  <h3 class="mgt1 letterSp txtColorGray2">REVIEW</h3>
  <div class=""> </div>
  <section>
    <?php
						 $sql="select * from review order by hit desc limit 3 offset 0";
						  $result=mysql_query($sql, $connect);
						  // for문을 $i=0; $i<4; $i++로 하면 페이징처리에 영향을 받지 않고 출력할 수 있다.
						 for($i=0; $i<3; $i++)
						{

						  mysql_data_seek($result, $i);// 가져올 레코드 위치(포인터)로 이동, for문에서 요긴하게 사용됨
						  $row=mysql_fetch_array($result);
						  $table="review";

						  $item_num=$row[num];
						  $item_id=$row[id];
						  $item_name=$row[name];
						  $item_hit=$row[hit];
						  $item_date=$row[regist_day];
						  $item_date=substr($item_date, 0, 40);// 문자열 자르기(문자열, 자르기 시작지점, 문자개수)
						  $item_subject=str_replace(" ", "&nbsp;", $row[subject]);
						  $item_contents=str_replace(" ", "&nbsp;", $row[contents]);
						  $upload_dir="/data/";

					 ?>
	<table id="review<?=$i?>">
		<?
			$sql="select num,file_copied_0 from review";
			mysql_data_seek($result, $i);
			$item_img=$row[file_copied_0];
		?>
		<tr><td class="td1"><a href="custom/review/view.php?table=<?=$table?>&num=<?=$item_num?>"><img src="<?=$upload_dir?><?=$item_img?>" width="319px"></a></td></tr>
		<tr ><td class="td2"><br><a href="custom/review/view.php?table=<?=$table?>&num=<?=$item_num?>"><?echo mb_strimwidth($item_contents, 0, 216, "...", "UTF-8"); ?></a><br></td></tr>

	</table>
	<?php   }       ?>
	<div class="clearBoth"></div>

   <div id="newBoard" class=" txtJustify mgt2">
    <table class="news">
	  <tr >
			<td class="txtLeft"><h3 class="mgb5 txtColorGray2 letterSp">NOTICE<span  class="aLink1 aVisited1 aHover2 fontSize12 floatRight2"><a href="custom/notice/list.php">더보기&gt;&gt;</a></span><div class="underbar">&nbsp;</div></h3>
			<?php
			 include"./lib/func.php";
			latest_article("notice", 5, 30,$d);
			?>
			</td>
			<td class="txtLeft" style="vertical-align:top;"><h3 class="mgb5 txtColorGray2 letterSp">EVENT<span  class="aLink1 aVisited1 aHover2 fontSize12 floatRight2 "><a href="event/list.php">더보기&gt;&gt;</a></span><div class="underbar">&nbsp;</div></h4>
        <?php
                 $sql1="select * from event order by num desc limit 2 offset 0";
                  $result1=mysql_query($sql1, $connect);
                  $row=mysql_fetch_array($result1);
                  $item_num=$row[num];
                  $item_subject=str_replace(" ", "&nbsp;", $row[subject]);
                  $upload_dir="/data/";
                  $item_img=$row[file_copied_0];
                  $start_day=$row[start_day];
                  $end_day=$row[end_day];


               ?>
               <center>
        <a href="event/view.php?num=<?=$item_num?>"><img src="<?=$upload_dir?><?=$item_img?>" width="430px" height="130px;"></a><br>
        <a href="event/view.php?num=<?=$item_num?>"><?echo mb_strimwidth($item_subject, 0, 76, "...", "UTF-8");?></a>
        <span style="font-size:13px; color:#777;"> (<?=$start_day?> ~ <?=$end_day?>)</span></center>
			</td>
			</tr>
		</table >

   </div>
 </section>
</div>
<?
include "lib/footer.php";
?>
