<?php
    //관리자 로그인 처리

    include './dbcon.php';

    $id=$_POST['id'];
    $pwd=$_POST['pwd'];

    //관리자의 아이디를 통해 관리자 로그인
    $query="SELECT a_id, a_pwd from administer where a_id='$id'";

    $result = mysqli_query($connect, $query);
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

    if ($num) {
      if ($row['a_pwd'] == $pwd) {
        echo "<form name='logged' action='admin.php' method='post'><input type='hidden' name='login_success' value='1'>";
        echo "<input type='hidden' name='login_id' value='$id'></form>";
        echo "<script>alert('로그인에 성공하였습니다.'); document.logged.submit();</script>";

      } else {
        echo "<script>alert('비밀번호 오류입니다.'); history.go(-1);</script>";
      }
    } else {
      echo "<script>alert('해당 아이디가 존재하지 않습니다. 관리자만 로그인이 가능합니다.');location.href='admin_login.html';</script>";
    }

 ?>
