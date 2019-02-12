<?php 
require_once "db_connect.php"; ?>
<html>
<head>
	<meta charset="utf-8">
  <link rel="stylesheet" href="style/My.css" type="text/css">

	<!--<style type="text/css"> 
	h2 { 
   	text-align:center;
    font-family: Arial, Helvetica, Verdana, sans-serif; /* Гарнитура шрифта */ 
    font-size: 150%; /* Размер текста */ 
    font-weight: lighter; /* Светлое начертание */ 
   }
	textarea {
   	height: 20%;
   	width: 100%;
   }-->
<style>
body { background: url(background17.png);}
</style> 

<style>
.demo-card-wide.mdl-card {
  width: 512px;
}
.demo-card-wide > .mdl-card__title {
  color: #fff;
  height: 176px;
  background: url('edit.jpg') center / cover;
}
.demo-card-wide > .mdl-card__menu {
  color: #fff;
}
body { background: url(background53.png);}
</style>

</head>
<body>

  <div class="demo-card-wide mdl-card mdl-shadow--2dp">
  <div class="mdl-card__title">
    <h2 class="mdl-card__title-text">Detail</h2>
  </div>
  <div class="mdl-card__supporting-text">
    You can see the details 
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a href="index.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Back to main
    </a>
  </div>
  
</div>



<?php 
if(isset($_GET['id'])) {
 $id = $_GET['id'];
 db();
 global $link;
 $query = "SELECT todoTitle, todoDescription, date1, deadline FROM todo WHERE id = '$id'";
 $result = mysqli_query($link, $query);
 if(mysqli_num_rows($result)==1){
 $row = mysqli_fetch_array($result);
 if($row){
 $title = $row['todoTitle'];
 $description = $row['todoDescription'];
 $date = $row['date1'];
 $deadline = $row['deadline'];
 $now_date = date("Y-m-d H:i:s");
 
 $begin_now = date_diff(date_create($now_date),date_create($date));
 $now_deadline = date_diff(date_create($deadline),date_create($now_date));
 //$begin_deadline = date_diff(date_create($date),date_create($deadline));
 //$begin_now = date_diff(date_create($begin_deadline),date_create($now_deadline));

echo "
 <h2>$title</h2>
 <textarea class='mdl-textfield__input' rows='10' readonly>$description</textarea>
 <br>
 <small>Дата добавления задачи: $date</small>
 <br>
 ";
 //<h5>$omg</h5>";
 //<small>$now_date</small>
 //";

  
  $begin_now_s=(((($begin_now->format("%d"))*24)*60+($begin_now->format("%h"))*60)+($begin_now->format("%i")))*60+($begin_now->format("%s"));
  $now_deadline_s=(((($now_deadline->format("%d"))*24)*60+($now_deadline->format("%h"))*60)+($now_deadline->format("%i")))*60+($now_deadline->format("%s"));
  $begin_now_d=$begin_now->format("%d");
  $begin_now_h = $begin_now->format("%h");
  $begin_now_i = $begin_now->format("%i");

  $now_deadline_d = $now_deadline->format("%d");
  $now_deadline_h = $now_deadline->format("%h");
  $now_deadline_i = $now_deadline->format("%i");
  //$hm=($omg->format("%h"))*60;
 
 }
 }else{
 echo 'no todo';
 }
}
?>

<?php
echo "
С момента добавления задачи прошло дней: $begin_now_d, часов $begin_now_h, минут $begin_now_i;
<br>
До дедлайна осталось: $now_deadline_d, часов $now_deadline_h, минут $now_deadline_i";
 $arr = array (
  'Прошло с момента добавления задачи:'=>$begin_now_s,
  'Осталось до дедлайна:'=>$now_deadline_s
 ); //Массив с парами данных "подпись"=>"значение"
 require_once('SimplePlot.php'); //Подключить скрипт
 $plot = new SimplePlot($arr); //Создать диаграмму
 $plot->show(); //И показать её
?>

</body>
</html>