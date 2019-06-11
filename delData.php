<?php

    include './dbcon.php';

    $lnum = $_POST['num'];

    //강의 학수번호를 통해 강의 삭제
    $query="DELETE from lecture where l_num = '$lnum'";
    //$query2="DELETE from professor where l_num = '$lnum'";


    //if (mysqli_query($connect, $query) && mysqli_query($connect, $query2)) {
    if (mysqli_query($connect, $query)) {
        echo "<script>alert('삭제완료');location.href='./admin.php';</script>";
    } else {
        echo "<script>alert('삭제가 되지않았습니다.');location.href='./admin.php';</script>" . mysqli_error($query);
    }

 ?>
