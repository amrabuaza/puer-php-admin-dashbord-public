<?php
session_start();
require "header.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
} else if (isset($_POST['user-id'])) {
    require "helper/DBHelper.php";
    $db = DBHelper::getInstance();
    $email = $_POST['email-address'];
    $pass = $_POST['password'];
    $birth = $_POST['birth_date'];
    $fullName = $_POST['full_name'];
    $id = $_POST['user-id'];
    if (!isset($pass)) {
        $pass = null;
    }
    $db->updateUser($id, $fullName, $birth, $email, $pass);
    header("Location: home.php");
} else {
    $user = $_SESSION['user'];
    ?>

    <div class="container p-t-10per">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="hidden" name="user-id" value="<?=$user['id']?>"/>
            <div class="form-group row">
                <label for="full_name"
                       class="col-md-4 col-form-label text-md-right">Full Name</label>
                <div class="col-md-6">
                    <input type="text" id="full_name" class="form-control" name="full_name"
                           value="<?=$user['full_name']?>"
                           required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="email_address"
                       class="col-md-4 col-form-label text-md-right">Email</label>
                <div class="col-md-6">
                    <input type="email" id="email_address" class="form-control" name="email-address"
                           value="<?=$user['email']?>"
                           required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="birth_date"
                       class="col-md-4 col-form-label text-md-right">Birth Data</label>
                <div class="col-md-6">
                    <input type="text" id="birth_date" class="form-control" name="birth_date"
                           value="<?=$user['birth_date']?>"
                           required autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                <div class="col-md-6">
                    <input type="password" id="password" class="form-control" name="password"
                    >
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
require "footer.php"; ?>
