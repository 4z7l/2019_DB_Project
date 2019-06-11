<?
  include './dbcon.php';

  $bname = $_POST['building_name'];
  $weekday = $_POST['weekdays'];
  $startt = $_POST['start_t'];
  $endt = $_POST['end_t'];

  //해당 요일, 시간에 강의가 없는 강의실 찾기
/*
  $query = "SELECT DISTINCT r_name from room join lecture
            on room.r_id=lecture.r_id
            join building
            on room.b_num=building.b_num
            where b_name='$bname'
            and ((week like '%$weekday%'
            and (('$endt' <= start_time)
            or (end_time <= '$startt')))
            or week not like '%$weekday%');";*/

$query = "SELECT DiSTINCT r_name from room join lecture
            on room.r_id=lecture.r_id
            join building
            on room.b_num=building.b_num
            where b_name='$bname'
            and (((week like '%$weekday%' and (('$endt' <= start_time) or (end_time <= '$startt'))))
            or (week not like '%$weekday%'
            and r_name NOT IN (
            SELECT r_name from room join lecture
            on room.r_id=lecture.r_id
            join building
            on room.b_num=building.b_num
            where b_name='$bname'
            and (week like '%$weekday%'
            and (('$startt' < start_time and start_time < '$endt')
            or (start_time <='$startt' and '$endt'<=end_time)
            or ('$startt' < end_time and end_time < '$endt'))))));";

  //강의가 아예 열리지 않는 강의실 찾기
  $query2 = "SELECT DISTINCT r_name from room
            join building on room.b_num=building.b_num
            where r_id not in (select r_id from lecture)
            and b_name='$bname';";

  $result = mysqli_query($connect, $query) or die(mysqli_error($connect));;
  $result2 = mysqli_query($connect, $query2) or die(mysqli_error($connect));;
?>

<!--메인 페이지에서의 결과를 보여주는 페이지입니다.-->

<html>

  <head>
    <meta charset="utf-8">
    <meta name="description" content="The website's result page">
    <meta name="author" content="Seulgi Kim">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>검색 결과</title>

  </head>

  <body>
    <div>
      <a href="main.html">홈으로 돌아가기</a>


      <h2>검색 결과</h2>

      <?
      //확인용
      //echo $bname,'관',$weekday,'요일',$startt,'부터',$endt,'까지';
      ?>

      <table width= "400" border="1" cellspacing="0" cellpadding="10">
      <tr align="center">
        <th bgcolor="#cccccc">빈 강의실 검색 결과</th>
      </tr>
      <?
        while ($row = mysqli_fetch_array($result)) {
      ?>
            <tr><td><CENTER><?=$row['r_name']?></td></tr>
      <?
        }
      ?>
      <?
        while ($row = mysqli_fetch_array($result2)) {
      ?>
            <tr><td><CENTER><?=$row['r_name']?></td></tr>
      <?
        }
      ?>
    </div>
    <pre>
s : 세종관
j : 진관
d : 대양 AI 센터
c : 충무관
g : 군자관
     </pre>

  </body>

</html>
