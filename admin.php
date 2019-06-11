<!--관리자 페이지입니다-->
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8">
    <meta name="description" content="Administer's page, You can update the data">
    <meta name="author" content="Seulgi Kim">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>관리자 페이지</title>
  </head>

  <body style="padding:50px 200px 50px 200px;">
    <a href="main.html" style="float:right;">홈으로 돌아가기</a>
    <h1 style="text-decoration:underline;"><CENTER>관리자 페이지</h1>

    <div style="border:2px solid black;padding:50px;">
      <p style="font-size:20px;"><strong>강의 추가</strong></p>
      <!--데이터 추가하기-->
      <div style="border-style:outset;padding:20px;">
        <form action='./addData.php' name='' method='post'>
          학수번호
          <input type="text" name="lnum" required><br><br>
           강의명
          <input type="text" name="lname" required><br><br>
          <!--교수이름
          <input type="text" name="pname" required><br><br>-->
          교수번호
          <input type="text" name="pnum" required><br><br>
           강의실
          <input type="text" name="rname" required><br><br>


          <input class="checkbox-inline" type="checkbox" value="mon" name="weekdays[]">월
          <input class="checkbox-inline" type="checkbox" value="tue" name="weekdays[]">화
          <input class="checkbox-inline" type="checkbox" value="wed" name="weekdays[]">수
          <input class="checkbox-inline" type="checkbox" value="thu" name="weekdays[]">목
          <input class="checkbox-inline" type="checkbox" value="fri" name="weekdays[]">금


          <br><br>

          <input type="text" name="start_t" size="10" required> 부터~
          <input type="text" name="end_t" size="10" required> 까지
          <i>(시간은 HH:MM:SS의 형태로 입력하여 주십시오.)</i>

          <br><br>

          <input type="submit" value="추가"/><br>
        </form>
      </div>

    </div>
    <br>
    <!--데이터 삭제-->
    <div style="border:2px solid black;padding:50px;">
      <p style="font-size:20px;"><strong>학수번호로 강의 삭제하기</strong></p>

      <div style="border-style:outset;padding:20px;">
        <form action='./delData.php' name='' method='post'>
          학수번호
          <input type="text" name="num" required><br><br>
          <input type="submit" value="삭제"/><br>
        </form>
      </div>
    </div>

    <!--현재 존재하는 강의실 모두 보여주기-->
    <div style="padding:10px;float:left;">
      <table width= "200" border="1" cellspacing="0" cellpadding="10">
        <caption>강의실</caption>
        <tr align="center">
          <th bgcolor="#cccccc"><CENTER>강의실 목록</th>
        </tr>
        <?
          include './dbcon.php';
          //강의실 이름 순으로 출력
          $bq="SELECT r_name from room order by r_name;";
          $bre = mysqli_query($connect, $bq) or die(mysqli_error($connect));;

          while ($row = mysqli_fetch_array($bre)) {
        ?>
              <tr><td><CENTER><?=$row['r_name']?></td></tr>
        <?
          }
        ?>
    </table>
    </div>

    <!--교수 이름과 번호 보여주기-->
    <div style="padding:10px;float:left;">
      <table width= "200" border="1" cellspacing="0" cellpadding="10">
        <caption>교수 목록</caption>
        <tr align="center">
          <th bgcolor="#cccccc"><CENTER>교수 이름</th>
          <th bgcolor="#cccccc"><CENTER>교수 번호</th>
        </tr>
        <?
          include './dbcon.php';
          //강의실 이름 순으로 출력
          $pq="SELECT p_name,p_num from professor order by p_num;";
          $pre = mysqli_query($connect, $pq) or die(mysqli_error($connect));;

          while ($row = mysqli_fetch_array($pre)) {
        ?>
              <tr>
                <td><CENTER><?=$row['p_name']?></td>
                <td><CENTER><?=$row['p_num']?></td>
              </tr>
        <?
          }
        ?>
    </table>
    </div>

    <!--개설된 강의 보여주기-->
    <div style="padding:10px;float:left;">
      <table width= "1000" border="1" cellspacing="0" cellpadding="10">
        <caption>개설 강의</caption>
        <tr align="center">
          <th bgcolor="#cccccc"><CENTER>강의 학수번호</th>
          <th bgcolor="#cccccc"><CENTER>강의명</th>
          <th bgcolor="#cccccc"><CENTER>요일</th>
          <th bgcolor="#cccccc"><CENTER>강의 시작 시간</th>
          <th bgcolor="#cccccc"><CENTER>강의 종료 시간</th>
          <th bgcolor="#cccccc"><CENTER>교수 이름</th>
          <th bgcolor="#cccccc"><CENTER>교수 번호</th>
          <th bgcolor="#cccccc"><CENTER>강의실</th>
        </tr>
        <?
          include './dbcon.php';
          //강의실 이름 순으로 출력
          $lq="SELECT l_num,l_name,week,start_time,end_time,p_name,p_num,r_name
                from lecture L join professor P on L.p_id=P.p_id
                join room R on L.r_id=R.r_id
                order by l_num;";
          $lre = mysqli_query($connect, $lq) or die(mysqli_error($connect));;

          while ($row = mysqli_fetch_array($lre)) {
        ?>
              <tr>
                <td><CENTER><?=$row['l_num']?></td>
                <td><CENTER><?=$row['l_name']?></td>
                <td><CENTER><?=$row['week']?></td>
                <td><CENTER><?=$row['start_time']?></td>
                <td><CENTER><?=$row['end_time']?></td>
                <td><CENTER><?=$row['p_name']?></td>
                <td><CENTER><?=$row['p_num']?></td>
                <td><CENTER><?=$row['r_name']?></td>

              </tr>
        <?
          }
        ?>
    </table>
    </div>



  </body>
</html>
