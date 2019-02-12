<?php
require_once("db_connect.php"); ?>
<html>
<head>
 <title>my todo</title>
 <meta charset="utf-8">
 <link rel="stylesheet" href="style/My.css" type="text/css">
<script src="script/min.js"></script>
<style type="text/css">body { background: url(background75.jpg);}</style>


</head>
<body>



	<h4>
 		This is todo list!
	</h4>
<form method="post" action="#">
  <select name="selectedValue">
  <option value="deadline" <?=($_POST['selectedValue']=='deadline'?'selected':'')?>>Сортировка по дедлайну</option>
  <option value="date" <?=($_POST['selectedValue']=='date'?'selected':'')?>>Сортировка по дате создания</option>
  </select>
  <input type="submit" name="add" value="go">
</form>
<?php
	db();
	global $link;

  
switch($_POST['selectedValue']){
    case 'deadline' : 
        $query = "SELECT id, deadline, todoTitle, todoDescription, date1, done FROM todo ORDER BY deadline";
        $result = mysqli_query($link, $query);
        break;
    case 'date':
        $query = "SELECT id, deadline, todoTitle, todoDescription, date1, done FROM todo ORDER BY date1";
        $result = mysqli_query($link, $query);
        break;
    default:
        $query = "SELECT id, deadline, todoTitle, todoDescription, date1, done FROM todo ORDER BY deadline";
        $result = mysqli_query($link, $query);
}

  if(mysqli_num_rows($result) >= 1){
    while($row = mysqli_fetch_array($result)){
      $id = $row['id'];
      $title = $row['todoTitle'];
      $date = $row['date1'];
      $deadline = $row['deadline'];
?>
<ul class="demo-list-item mdl-list">
  

  <div> 
      <li class="mdl-list__item"><a href="detail.php?id=<?php echo $id?>"><?php echo $title ?></a></li> <div><div style="float: left;">

        <b>Создание задания:</b> <?php echo $date ?></div> <div style="float: right;"><b>Дедлайн:</b> <?php echo $deadline ?></div>
      <?php if (($row['done']==NULL) OR ($row['done']==0)){ 
        echo "<img src='uncheck.jpg' width='100' height='111'>";
        //echo "Не выполненено"; 
      }
         else{  
          echo "<img src='img.png' width='100' height='111'>";
        //  echo "Выполнено";
        }
        ?>
  </div>
  <br>
  <a href="edit.php?id=<?php echo $id?>"><button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Edit</button></a>
  <a href="delete.php?id=<?php echo $id?>"><button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Delete</button></a> </div>
</ul>
<?php
 }
}
?>

	

<p><a href="create.php"><button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">add todo</button></a></p>

</body>
</html>