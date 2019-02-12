<?php
require_once("db_connect.php"); ?>
<html>
<head>
 <title>my todo</title>
 <meta charset="utf-8">
 <link rel="stylesheet" href="style/My.css" type="text/css">
<script src="script/min.js"></script>


</head>
<body>
	<h4>
 		This is todo list!
	</h4>
  <select name="selectValue">
  <option selected value="deadline">deadline</option>
  <option value="date1">date1</option>
</select>
<?php
	db();
	global $link;
	$sort = ['deadline','date1'];
if($_GET['selectValue']){
	//$sort = ['deadline','date1'];
	
	//if(in_array($_GET['selectValue'],$sort)){
	if($_GET['selectValue'] AND in_array($_GET['selectValue'],$sort)){

	 $query = "SELECT id, deadline, todoTitle, todoDescription, date1 FROM todo ORDER BY $sort";	
	}else {
			 $query = "SELECT id, deadline, todoTitle, todoDescription, date1 FROM todo ORDER BY deadline";
	}
		
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
	

	<div> <li class="mdl-list__item"><a href="detail.php?id=<?php echo $id?>"><?php echo $title ?></a></li> <div><div style="float: left;"><b>Создание задания:</b> <?php echo $date ?></div> <div style="float: right;"><b>Дедлайн:</b> <?php echo $deadline ?></div></div>
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