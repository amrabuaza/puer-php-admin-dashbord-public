<?php
session_start();
require "header.php";
require "../helper/DBHelper.php";
$db = DBHelper::getInstance();

if (isset($_POST['task-id'])) {
    $taskId = $_POST['task-id'];
    $task = $_POST['task'];
    $db->updateTask($taskId, $task);
    header("Location: ../home.php");
}
if (!isset($_SESSION["user"]) || !isset($_GET['id'])) {
    header("Location: ../home.php");
} else {
    $taskId = $_GET['id'];
    $task = $db->findTask($taskId); ?>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="hidden" name="task-id" value="<?=$taskId?>"/>
            <div class="form-group row">
                <label for="task"
                       class="col-md-4 col-form-label text-md-right">Task</label>
                <div class="col-md-6">
                    <input type="text" id="task" class="form-control" name="task" value="<?=$task['task']?>"
                           required autofocus>
                </div>
            </div>
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>
    </div>
    </form>
    </div>
<?php }
require "../footer.php";