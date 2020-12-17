<?
//include "./../lib/session.php";
include "./../lib/dbconn.php";

$table=$_GET["table"];
$no=$_GET["no"];
$page=$_GET["page"];



$title=$_POST["title"];
$subtitle=$_POST["subtitle"];
$country=$_POST["country"];
$travel_period=$_POST["travel_period"];
$included=$_POST["included"];
$not_included=$_POST["not_included"];
$schedule=$_POST["schedule"];
$infomation=$_POST["infomation"];
$regist_day = date("Y-m-d (H:i)");
/*$thum_name_0="$upthum_name[0]";
$thum_name_1="$upthum_name[1]";
$thum_name_2="$upthum_name[2]";
$thum_name_3="$upthum_name[3]";
$thum_name_4="$upthum_name[4]";
$thum_name_5="$upthum_name[5]";
$thum_name_6="$upthum_name[6]";
$thum_copied_0="$copied_thum_name[0]";
$thum_copied_1="$copied_thum_name[1]";
$thum_copied_2="$copied_thum_name[2]";
$thum_copied_3="$copied_thum_name[3]";
$thum_copied_4="$copied_thum_name[4]";
$thum_copied_5="$copied_thum_name[5]";
$thum_copied_6="$copied_thum_name[6]";
$thum_type_0="$typed_file[0]";
$thum_type_1="$typed_file[1]";
$thum_type_2="$typed_file[2]";
$thum_type_3="$typed_file[3]";
$thum_type_4="$typed_file[4]";
$thum_type_5="$typed_file[5]";
$thum_type_6="$typed_file[6]";
*/


$files=$_FILES["upfile"];
$count=count($files["name"]);
$upload_dir="../data/";

for($i=0; $i<$count; $i++){
  $upthum_name[$i]=$files["name"][$i];
  $upfile_tmp_name[$i]=$files["tmp_name"][$i];
  $upthum_type[$i]=$files["type"][$i];
  $upfile_size[$i]=$files["size"][$i];
  $upfile_error[$i]=$files["error"][$i];

  $file=explode(".", $upthum_name[$i]);
  $thum_name=$file[0];
  $file_ext=$file[1];

  if(!$upfile_error[$i])
  {
    $new_thum_name=date("Y_m_d_H_i_s");
    $new_thum_name.="_".$i;
    $copied_thum_name[$i]=$new_thum_name.".".$file_ext;
    $uploaded_file[$i]=$upload_dir.$copied_thum_name[$i];
    $typed_file[$i]=$upthum_type[$i];//추가

    if($upfile_size[$i]>5242880){
      echo("
      <script>
      alert('파일 크기 5MB 이하로 등록해 주세요.');
      history.go(-1);
      </script>
      ");
      exit;
    }
    if(!move_uploaded_file($upfile_tmp_name[$i], $uploaded_file[$i])){// 이동할 파일 시작, 도착
      //echo $upfile_tmp_name[$i];
      echo("
      <script>
      alert('파일 복사에 실패하였습니다.');
      </script>
      ");
      exit;
    }
  }
}

$num_checked=count($_POST['del_file']);
echo $num_checked;
$position=$_POST['del_file'];//del_file는 배열

for($i=0; $i<$num_checked; $i++){
  $index=$position[$i];
  $del_ok[$index]="y";
}

$sql="select * from $table where no=$no";
$result=mysql_query($sql, $connect);
$row=mysql_fetch_array($result);

for($i=0; $i<$count; $i++){
  // 추가
  $filed_org_name="thum_name_".$i;
  $filed_real_name="thum_copied_".$i;
  $filed_type_name="thum_type_".$i;

  $org_name_value=$upthum_name[$i];
  $org_real_value=$copied_thum_name[$i];
  $org_type_value=$typed_file[$i];

  if($del_ok[$i]=="y"){
    $delete_field="thum_copied_".$i;
    $delete_name=$row[$delete_field];
    $delete_path=$upload_dir.$delete_name;

    unlink($delete_path);//삭제

    $sql="update $table set ";
    $sql.="$filed_org_name='$org_name_value', $filed_real_name='$org_real_value', $filed_type_name='$org_type_value'";
    $sql.=" where no=$no";
    //echo $sql;
    mysql_query($sql, $connect);
  }else{//체크박스 선택 안한 항목에 대해서
    if(!$upfile_error[$i]){//오류가 없다면 파일 올리기
      $sql="update $table set ";
      $sql.="$filed_org_name='$org_name_value', $filed_real_name='$org_real_value', $filed_type_name='$org_type_value'";
      $sql.=" where no=$no";
      //echo $sql;
      mysql_query($sql, $connect);
    }
  }
}
$sql = "update $table set title='$title', subtitle='$subtitle', country='$country', travel_period='$travel_period', included='$included', not_included='$not_included', schedule='$schedule', infomation='$infomation', regist_day='$regist_day where no=$no";
mysql_query($sql, $connect);


/*$sql = "update $table set title='$title', subtitle='$subtitle', country='$country', travel_period='$travel_period', included='$included', not_included='$not_included', schedule='$schedule', infomation='$infomation', regist_day='$regist_day', thum_name_0='$thum_name_0', thum_name_1='$thum_name_1', thum_name_2='$thum_name_2', thum_name_3='$thum_name_3', thum_name_4='$thum_name_4', thum_name_5='$thum_name_5', thum_name_6='$thum_name_6', thum_name_7='$thum_name_7', thum_copied_0='$thum_copied_0', thum_copied_1='$thum_copied_1', thum_copied_2='$thum_copied_2', thum_copied_3='$thum_copied_3', thum_copied_4='$thum_copied_4', thum_copied_5='$thum_copied_5', thum_copied_6='$thum_copied_6', thum_copied_7='$thum_copied_7', thum_type_0='$thum_type_0',  thum_type_1='$thum_type_0', thum_type_2='$thum_type_0', thum_type_3='$thum_type_0', thum_type_4='$thum_type_0', thum_type_5='$thum_type_0', thum_type_6='$thum_type_0', thum_type_7='$thum_type_0' where no=$no";

mysql_query($sql, $connect);*/

mysql_close();
echo("
  <script>
  alert('정상적으로 글이 수정되었습니다.');
  </script>
  ");
echo("
  <script>
  location.href='view.php?table=$table&no=$no&page=$page';
  </script>
  ");
?>
