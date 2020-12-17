function del(table, no)
{
    if(confirm('글을 삭제 하시겠습니까?')){
        location.href='./delete_ok.php?table='+table+'&no='+no;
    }
}

function del1(page, table, no, paging,message)
{
    if(confirm('예약을 '+message+' 하시겠습니까?')){
        location.href='./'+page+'_ok.php?table='+table+'&no='+no+'&page='+paging;
    }
}

function adminSubmit(page, table, no)
{

switch (page) {
    case "reserve":
    if(confirm('대기 예약을 승인하시겠습니까?')){
        location.href='./'+page+'_submit_ok.php?table='+table+'&no='+no;
    }
    break;
    case "cancel":
    if(confirm('예약취소를 승인하시겠습니까?')){
        location.href='./'+page+'_submit_ok.php?table='+table+'&no='+no;
    }
     break;
  }
}
