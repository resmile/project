<?php
  include "./../lib/session.php";

  if($userlevel==1){
    echo("
      <script>
        location.href='reserve/list.php';
      </script>
    ");
  }else{
    echo("
      <script>
        location.href='member/login.php';
      </script>
    ");
  }
  ?>
