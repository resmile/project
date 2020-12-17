<?
  function latest_article($tid, $loop, $char_limit, $d){
	 if($d="custom"){
		$tid1="custom/".$tid;
	 }
    include "lib/dbconn.php";
    
    $sql="select num,subject,id,regist_day from $tid order by num desc limit $loop";
    $result=mysql_query($sql, $connect);
    
    while($row=mysql_fetch_array($result)){
      $num=$row[num];
      $len_subject=strlen($row[subject]);//strlen()는 글자수를 세고 조건문에서 사용
      $subject=$row[subject];
     

      if($len_subject>$char_limit){
        $subject=mb_substr($row[subject], 0, $char_limit, 'utf-8');//mb_substr(), 문자열, 시작, 가져오는 문자개수, 인코딩(문자의 개수를 샐때 한글은 2byte이므로 글자 세는게 깨진다.
        $subject=$subject."...";
      }
      
      $regist_day=substr($row[regist_day], 5, 5);
      
  echo("
	   <div id='notice'>
        <a href='$tid1/view.php?table=$tid&num=$num'><span id='subject'>$subject</span>
        <span class='right'>$regist_day&nbsp;&nbsp; $id</span></a>
		</div>
      ");

}
   mysql_close();
  }
?>
