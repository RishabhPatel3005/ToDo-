<!DOCTYPE html>
<?php
$errors="";
$con=mysqli_connect('localhost','root','','todo');
if(isset($_POST['submit'])){
    $task=$_POST['task'];
    if(empty($task)){
        $errors="You can't have empty task. You must have something to do";
    } else{
    $insert_query="INSERT INTO todo.tasks (task) VALUES('$task')";
    $insert_query_result=mysqli_query($con,$insert_query) or die(mysqli_error($con));
    header('location:index.php');
    }
}
if(isset($_GET['del_task'])){
    $id=$_GET['del_task'];
    $delete_query="DELETE FROM tasks WHERE id=$id";
    $delete_query_result=mysqli_query($con,$delete_query);
    header('location: index.php');
}
$select_query="SELECT * FROM tasks";
$tasks=mysqli_query($con,$select_query);
?>
<html>
    <head>
        <title>ToDo Application using PHP & MySql</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="heading">
            <h2>ToDo Application with PHP & MySql</h2>
        </div>
        <form method="POST" action="index.php" class="col-md-6 margin">
            <?php if(isset($errors)){ ?>
            <p> <?php echo $errors; ?> </p>
            <?php } ?>
            <div class="form-group">
                <input type="text" name="task" class="form-control task_btn" placeholder="Enter your task.">
            </div>
            <div class="form-group">
                <button type="submit" class="add_btn" name="submit">Add Task</button>
            </div>
        </form>
        <table class="table-hover">
            <thead>
                <tr>
                    <th>N</th>
                    <th>Task</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;
                while($row=mysqli_fetch_array($tasks)){
                    ?>
                <tr>
                    <td> <?php echo $i; ?> </td>
                    <td class="task"> <?php echo $row['task']; ?> </td>
                    <td class="delete"><a href="index.php?del_task=<?php echo $row['id']; ?>">X</a></td>
                </tr>
                <?php 
                $i++;
                } ?>
            </tbody>
        </table>
    </body>
</html>
<!-- Rishabh Patel -->