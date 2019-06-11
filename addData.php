<?php

    include './dbcon.php';

    $lnum = (int) $_POST['lnum'];         //학수번호
    $lname = $_POST['lname'];             //강의명
    //$pname = $_POST['pname'];              //교수명
    $pnum = (int) $_POST['pnum'];         //교수번호
    $rname = $_POST['rname'];              //강의실

    $startt = $_POST['start_t'];          //시작 시간
    $endt = $_POST['end_t'];               //종료 시간

    $day = "";       //요일

    $search_pid=mysqli_query($connect,"SELECT * FROM professor WHERE p_num=$pnum;");
    $pid = mysqli_fetch_row($search_pid);

    if(!empty($_POST['weekdays'])) {
  		foreach($_POST['weekdays'] as $selected) {
          //데이터 삽입 전 삽입 가능한지 체크하는 쿼리
          //강의실이 해당 시간에 다른 강의가 있는지 검사
          $checkQ="SELECT * from room
                  join lecture on room.r_id=lecture.r_id
                  join building on room.b_num=building.b_num
                  where r_name='$rname'
                  and (week like '%$selected%'
                  and (('$startt' < start_time and start_time < '$endt')
                  or (start_time <='$startt' and '$endt'<=end_time)
                  or ('$startt' < end_time and end_time < '$endt')));";
          //교수가 해당 시간에 강의가 있는지 검사
          $checkQ2="SELECT * from professor
                  join lecture on professor.p_id=lecture.p_id
                  where professor.p_id=$pid[0]
                  and (week like '%$selected%'
                  and (('$startt' < start_time and start_time < '$endt')
                  or (start_time <='$startt' and '$endt'<=end_time)
                  or ('$startt' < end_time and end_time < '$endt')));";

          $check_sql=mysqli_query($connect,$checkQ);
          $check = mysqli_num_rows($check_sql);

          $check_sql=mysqli_query($connect,$checkQ2);
          $check += mysqli_num_rows($check_sql);

          if($check > 0){
            echo "<script>
                  alert('강의를 추가할 수 없습니다.값이 잘못되었습니다.');
                  location.href='./admin.php';
                  </script>" . mysqli_error($check);
          }
          $day .= $selected;
  		}
    }

    //강의 테이블에 데이터 추가, 강의실의 번호는 아직 모르므로 강의실 번호를 제외한 나머지 데이터 추가
    $query=" INSERT INTO lecture(l_num,l_name,week,start_time,end_time,p_id)
             VALUES($lnum,'$lname','$day','$startt','$endt',$pid[0]);";
    //강의실 이름을 받아 강의실의 번호를 모르므로 subquery를 통해 강의실번호를 찾아 강의 테이블에 갱신
    $query.=" UPDATE lecture
              SET r_id = (SELECT r_id FROM room WHERE r_name='$rname')
              WHERE l_num=$lnum;";

/*
    $query="INSERT INTO professor(p_name,p_num) VALUES('$pname',$pnum);";
    $query.="INSERT INTO lecture(l_num,l_name,week,start_time,end_time) VALUES($lnum,'$lname','$day','$startt','$endt');";
    $query.="UPDATE lecture SET p_id= (SELECT MAX(p_id) FROM professor) WHERE l_num=$lnum;";
    $query.="UPDATE lecture SET r_id = (SELECT r_id FROM room WHERE r_name='$rname') WHERE l_num=$lnum;";

*/

    if (mysqli_multi_query($connect, $query)) {
        echo "<script>alert('강의가 추가되었습니다');location.href='./admin.php';</script>";
    } else {
        //echo "<script>alert('강의가 추가되지 않았습니다.');location.href='./admin.php';</script>" . mysqli_error($query);
        echo $pid[0];
    }

 ?>
