<html>
<head>
 <title>Create Todo list</title>
 <style>
body { background: url(background57.png);}
</style>

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

 <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>
<body>
 
 <div class="demo-card-wide mdl-card mdl-shadow--2dp">
  <div class="mdl-card__title">
    <h2 class="mdl-card__title-text">Create</h2>
  </div>
  <div class="mdl-card__supporting-text">
    You can Create task 
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a href="index.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Back to main
    </a>
  </div>
  
</div>

<h4>Create Todo List</h4>
<form method="post" action="create.php">
 <p><b>Todo title: </b></p>
 <input name="todoTitle" type="text">
 <p><b>Todo description: </b></p>
 <textarea name="todoDescription" cols="40" rows="3"></textarea>
 <br>
 <br>
 <br>
 <input name="deadline" type="datetime-local" value="0000-00-00 00:00:00">
 <br>
 <br>
 <br>
<!-- <p><a href=""><input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="submit" value="submit"></a></p> -->
<input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="submit" value="submit">
 <br><br><br><br>
</form>

</body>
</html>


<?php
	require_once("db_connect.php");
	if(isset($_POST['submit'])) {
		$title = $_POST['todoTitle'];
		$description = $_POST['todoDescription'];
		$deadline = $_POST['deadline'];
//connect to database
		db();
		global $link;
		$query = "INSERT INTO todo(todoTitle, todoDescription, date1, deadline)     VALUES ('$title', '$description', now(), '$deadline' )";
		$insertTodo = mysqli_query($link, $query);
		if($insertTodo){
			echo '<script type="text/javascript">location.replace("index.php");</script>';
			    
		}else{
			echo mysqli_error($link);
		}
		
		mysqli_close($link);
	}
?>