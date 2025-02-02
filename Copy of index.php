<?php

    $errors ="";

    $db = mysqli_connect('localhost','root', '','todo');

    if (isset($_POST['submit'])){
        $task = $_POST['task'];
        if (empty($task)) {
            $errors = "You must fill in the task";
        } else {
            mysqli_query($db,"INSERT INTO tasks (task) VALUES ('$task')");
            header('location: index.php');
        }
    }

    if (isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
        header('location: index.php');
    }

    $tasks = mysqli_query($db,'SELECT * FROM tasks');
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Group 4 | To-Do List with HTML, CSS, JAVASCRIPT, AND PHP</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script> 
</head>
        <body>

        <?php include('header.php'); ?>
            <div class="heading">
                <h3>To-Do List</h3>
            </div>

            <form method="POST" action="index.php">
            <?php if (isset($errors)) { ?>
                <p><?php echo $errors; ?> </p>
            <?php } ?>

            <input type="text" name="task" class="task_input">
            <button type="submit" class="add_btn" name="submit">Add Task</button>
            </form>

            <table>
                <thead>
                <tr>
                    <th>N</th>                
                    <th>Task</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>

                    <?php $i = 1; while ($row = mysqli_fetch_array($tasks)){ ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td class="task"><?php echo $row['task']; ?></td>
                        <td class="delete">
                            <a href="index.php?del_task=<?php echo $row['id']; ?>">x</a>
                        </td>
                    </tr>
                    <?php $i++;} ?>
                    
                </tbody>
            </table>

            <?php include('footer.php'); ?>
        </body>
</html>
