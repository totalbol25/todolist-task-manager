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
   }-->
   <!-- Wide card with share menu button -->

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

</style>
</head>
<body>


<div class="demo-card-wide mdl-card mdl-shadow--2dp">
  <div class="mdl-card__title">
    <h2 class="mdl-card__title-text">Edit Todo</h2>
  </div>
  <div class="mdl-card__supporting-text">
    You can change your task
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a href="index.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Back to main
    </a>
  </div>
  
</div>


<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    db();
    global $link;
    $query = "SELECT todoTitle, todoDescription, deadline, done FROM todo WHERE id = '$id'";
    $result = mysqli_query($link, $query);
    if(mysqli_num_rows($result)==1){
        $row=mysqli_fetch_array($result);
        if($row){
            $title = $row['todoTitle'];
            $description = $row['todoDescription'];
            $deadline = $row['deadline'];
            $done = $row['done'];
            if(($done == 'NULL') OR ($done == '0'))
            {
            echo "
                
                
            <form action='edit.php?id=$id' method='post'>
            <p><b>Title</b></p>
             <input class='mdl-textfield__input' type='text' name='title' value='$title'>
             <p><b>Description</b></p>
             <textarea class='mdl-textfield__input' rows='10' name='description'>$description</textarea>
             <br>
             <p>Deadline</p>
            

             <input name='deadline' type='datetime' value='$deadline'>
             <input class='mdl-checkbox__input' type='checkbox' name='check' id='check'><label for='check'>Check?</label>
            
             <br><br>
             <form method='post' action='#'>
             <input type='submit'  name='submit' value='edit'>
             </form>
            ";
        }
            else 
                { echo "
                <br>
                
            <form action='edit.php?id=$id' method='post'>
            <p><b>Title</b></p>
             <input class='mdl-textfield__input' type='text' name='title' value='$title'>
             <p><b>Description</b></p>
             <textarea class='mdl-textfield__input' rows='10' name='description'>$description</textarea>
             <br>
             <p><b>Deadline<b></p>
            

             <input  name='deadline' type='datetime' value='$deadline'>
             <input class='mdl-checkbox__input' type='checkbox' name='check' id='check' checked><label for='check'>Check?</label>
            
             <br><br>
             
             <input type='submit'  name='submit' value='edit'>
            
            ";
        }
        }
    }else {
        echo "no todo";
    }


    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $deadline = $_POST['deadline'];
        $check = (int)isset($_REQUEST['check']);
        db();
        $query = "UPDATE todo SET todoTitle = '$title', todoDescription = '$description', deadline = '$deadline', done = '$check'  WHERE id = '$id'";
        $insertEdited = mysqli_query($link, $query);
        if($insertEdited){
            //echo "successfully updated";
            //location.reload();
            //location.reload();
        }
        else{
            echo mysqli_error($link);
        }
        //echo "<script language='JavaScript' type='text/javascript'>window.location.replace('edit.php')</script>";

        //location.reload();
        //header("Location:index.php");
        //exit;

    }


} 

