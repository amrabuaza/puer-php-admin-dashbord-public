<?php
session_start();
require "header.php";
if (!isset($_SESSION["user"])) {
    header("Location: login.php");

} else {
    require "helper/DBHelper.php";
    $user = $_SESSION["user"];
    $db = DBHelper::getInstance();
    $userTasks = $db->getTasksByUserId($user['id']);
    ?>
    <div class="container full-width">
        <h1 class="full-name">Welcome <?=$user['full_name']?></h1>
        <div class="tasks">
            <div class="p-b-5">
                <p>Tasks</p>
                <a href="task/add.php" type="button" class="btn btn-primary">Add Task</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Task</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($task = mysqli_fetch_array($userTasks)) {
                    $taskId = $task['id'];
                    ?>
                    <tr>
                        <th scope="row"><?=$taskId?></th>
                        <td><?=$task['task']?></td>
                        <td class="flex"><a href="task/edit.php?id=<?=$taskId?>">Edit</a>
                            <a href="task/delete.php?id=<?=$taskId?>">Delete</a>
                        </td>
                    </tr>
                <?php }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}
require "footer.php";
