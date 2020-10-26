<?php
session_start();
require "header.php";
require "../helper/DBHelper.php";
$db = DBHelper::getInstance();
if (!isset($_SESSION["user"])) {
    header("Location: ../home.php");
} else if (isset($_POST['task'])) {
    $user = $_SESSION["user"];
    $task = $_POST['task'];
    $db->addTask($task, $user['id']);
    header("Location: ../home.php");
} else {
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group row">
            <label for="task"
                   class="col-md-4 col-form-label text-md-right">Task</label>
            <div class="col-md-6">
                <input type="text" id="task" class="form-control" name="task"
                       required autofocus>
            </div>
        </div>
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Add
            </button>
        </div>
        </div>
    </form>
<?php }
require "../footer.php";