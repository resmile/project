<?
//include "./../lib/session.php";
include "./../../lib/dbconn.php";

$table=$_GET["table"];

// 다중 파일, 배열형식
$files=$_FILES["upfile"];
$count=count($files["name"]);

$upload_dir="./../../data/";

for($i=0; $i<$count; $i++){
  $upfile_name[$i]=$files["name"][$i];
  $upfile_tmp_name[$i]=$files["tmp_name"][$i];
  $upfile_type[$i]=$files["type"][$i];
  $upfile_size[$i]=$files["size"][$i];
  $upfile_error[$i]=$files["error"][$i];

  $file=explode(".", $upfile_name[$i]);
  $file_name=$file[0];
  $file_ext=$file[1];

  if(!$upfile_error[$i])
  {
    $new_file_name=date("Y_m_d_H_i_s");
    $new_file_name.="_".$i;
    $copied_file_name[$i]=$new_file_name.".".$file_ext;
    $uploaded_file[$i]=$upload_dir.$copied_file_name[$i];
    $typed_file[$i]=$upfile_type[$i];//추가

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
      echo $upfile_tmp_name[$i];
      echo("
      <script>
      alert('파일 복사에 실패하였습니다.');
      </script>
      ");
      exit;
    }
  }
}

$id=$userid;
$name=$username;
$title=$_POST["title"];
$subtitle=$_POST["subtitle"];
$country=$_POST["country"];
$travel_period=$_POST["travel_period"];
$included=$_POST["included"];
$not_included=$_POST["not_included"];
$schedule=$_POST["schedule"];
$infomation=$_POST["infomation"];
$regist_day = date("Y-m-d (H:i)");
$thum_name_0="$upfile_name[0]";
$thum_name_1="$upfile_name[1]";
$thum_name_2="$upfile_name[2]";
$thum_name_3="$upfile_name[3]";
$thum_name_4="$upfile_name[4]";
$thum_name_5="$upfile_name[5]";
$thum_name_6="$upfile_name[6]";
$thum_copied_0="$copied_file_name[0]";
$thum_copied_1="$copied_file_name[1]";
$thum_copied_2="$copied_file_name[2]";
$thum_copied_3="$copied_file_name[3]";
$thum_copied_4="$copied_file_name[4]";
$thum_copied_5="$copied_file_name[5]";
$thum_copied_6="$copied_file_name[6]";
$thum_type_0="$typed_file[0]";
$thum_type_1="$typed_file[1]";
$thum_type_2="$typed_file[2]";
$thum_type_3="$typed_file[3]";
$thum_type_4="$typed_file[4]";
$thum_type_5="$typed_file[5]";
$thum_type_6="$typed_file[6]";


$sql = "INSERT INTO $table (no, id, name, title, subtitle, country, travel_period, included, not_included, schedule, infomation, regist_day, hit, thum_name_0, thum_name_1, thum_name_2, thum_name_3, thum_name_4, thum_name_5, thum_name_6, thum_copied_0, thum_copied_1, thum_copied_2, thum_copied_3, thum_copied_4, thum_copied_5, thum_copied_6, thum_type_0, thum_type_1, thum_type_2, thum_type_3, thum_type_4, thum_type_5, thum_type_6) VALUES ( 0 ,'$id', '$name', '$title', '$subtitle', '$country', '$travel_period', '$included', '$not_included', '$schedule', '$infomation', '$regist_day',  0,  '$thum_name_0', '$thum_name_1', '$thum_name_2', '$thum_name_3', '$thum_name_4', '$thum_name_5', '$thum_name_6', '$thum_copied_0', '$thum_copied_1', '$thum_copied_2', '$thum_copied_3', '$thum_copied_4', '$thum_copied_5', '$thum_copied_6', '$thum_type_0','$thum_type_1','$thum_type_2', '$thum_type_3','$thum_type_4','$thum_type_5','$thum_type_6')";

$result=mysql_query($sql, $connect);
mysql_close();
echo("
  <script>
  alert('정상적으로 글이 등록되었습니다.');
  </script>
  ");
echo("
<script>
location.href='list.php?table=$table&page=$page';
</script>
");
?>
