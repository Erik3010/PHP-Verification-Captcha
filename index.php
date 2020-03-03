<?php 
session_start();

$captcha = $_SESSION['captcha'];

$success = "";
$display = false;

if(isset($_POST['submit']) && isset($_POST['captchaField'])) {
    if($_POST['captchaField'] == $captcha) {
        // echo '<div class="w-50 alert alert-primary" role="alert">
        //          Captcha Successfully!
        //     </div>';
        $success = true;
        $display = true;
    }else{
        // echo '<div class="w-50 alert alert-danger" role="alert">
        //         Wrong Captcha! Please try again
        //     </div>';
        $success = false;
        $display = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            height: 100vh;
        }

        img {
            width: 100px;
        }

    </style>
</head>
<body>
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center">
        <?php if($success && $display) : ?>
            <div class="container w-50 alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>Success!</strong> Your captcha is success.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif(!$success && $display) : ?>
            <div class="container w-50 alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>Wrong!</strong> Your captcha is not correct!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="card w-50">
            <h5 class="card-header text-center">Captcha Verification</h5>
            <div class="card-body">
            <form method="POST">
                <div class="form-group d-flex flex-column">
                    <label for="captcha">Captcha</label>
                    <img class="rounded" src="captcha.php" alt="captcha">
                </div>
                <div class="form-group">
                    <label for="captcha">Type the captcha</label>
                    <input type="text" name="captchaField" class="form-control" id="captcha">
                    <small id="captcha" class="form-text text-muted">Type the captcha carefully</small>
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>