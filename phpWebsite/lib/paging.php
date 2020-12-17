<?
if($_GET[page] && $_GET[page] > 0){
    $page = $_GET[page];
}else{
    $page = 1;
}
$page_row = 10;
$page_scale = 10;
$paging_str = "";

$sql = "select count($cntNo) as cnt from $table";
$total_count = sql_total($sql);
$paging_str = paging($page, $page_row, $page_scale, $total_count);
$from_record = ($page - 1) * $page_row;

$query = "select * from $table order by $cntNo desc limit ".$from_record.", ".$page_row;
$result = mysql_query($query, $connect);
$noArticle = 0;


// 쿼리 함수
function sql_query($sql)
{
    global $connect;
    $result = @mysql_query($sql, $connect) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    return $result;
}

// 갯수 구하는 함수
function sql_total($sql)
{
    global $connect;
    $result_total = sql_query($sql, $connect);
    $data_total = mysql_fetch_array($result_total);
    $total_count = $data_total[cnt];
    return $total_count;
}

// 4. 페이징 사용자 함수
function paging($page, $page_row, $page_scale, $total_count)
{
    // 4-1. 전체 페이지 계산
    $total_page  = ceil($total_count / $page_row);

    // 4-2. 페이징을 출력할 변수 초기화
    $paging_str = "<p class='paging'>";

    // 4-3. 처음 페이지 링크 만들기
    if ($page > 1) {
        $paging_str .= "<a href='".$_SERVER[PHP_SELF]."?page=1&' class='page_btn btn_first'>&lt;&lt;</a>";
    }

    // 4-4. 페이징에 표시될 시작 페이지 구하기
    $start_page = ( (ceil( $page / $page_scale ) - 1) * $page_scale ) + 1;

    // 4-5. 페이징에 표시될 마지막 페이지 구하기
    $end_page = $start_page + $page_scale - 1;
    if ($end_page >= $total_page) $end_page = $total_page;

    // 4-6. 이전 페이징 영역으로 가는 링크 만들기
    if ($start_page > 1){
        $paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".($start_page - 1).">&lt;&lt;</a>";
    }

    // 4-7. 페이지들 출력 부분 링크 만들기
    if ($total_page > 1) {
        for ($i=$start_page;$i<=$end_page;$i++) {
            // 현재 페이지가 아니면 링크 걸기
            if ($page != $i){
                $paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".$i."' class='num'><span>$i</span></a>";
            // 현재페이지면 굵게 표시하기
            }else{
                //$paging_str .= " &nbsp;<b>$i</b> ";
                $paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".$i."' class='num  active'><span>$i</span></a>";
            }
        }
    }

    // 4-8. 다음 페이징 영역으로 가는 링크 만들기
    if ($total_page > $end_page){
        $paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".($end_page + 1)."' class='page_btn btn_next'>&gt;</a>";
    }

    // 4-9. 마지막 페이지 링크 만들기
    if ($page < $total_page) {
        $paging_str .= " &nbsp;<a href='".$_SERVER[PHP_SELF]."?page=".$total_page."' class='page_btn btn_end'>&gt;&gt;</a>";
    }

    $paging_str .= "</p>";
    return $paging_str;
}
?>
