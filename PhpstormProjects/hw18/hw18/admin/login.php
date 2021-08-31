<?php
session_start();
$errorBag = [
        'user_name' => [],
        'password' => [],
        'wrong_input' => []
];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(empty($_POST['user_name'])) {
        $errorBag ['user_name'][] = 'Вы не ввели имя пользователя';
    }
    if(empty($_POST['password'])) {
        $errorBag ['password'][] = 'Вы не ввели пароль';
    }

    $errorsCounter = count($errorBag['user_name'] + $errorBag['password']);

    if($errorsCounter == 0) {
        if($_POST['user_name'] == '4upokabra' && $_POST['password'] == '123456') {
            $_SESSION['access'] = true;
            header("Location: /admin/");
        }
        else {
            $errorBag ['wrong_input'][] = 'Вы ввели неправильные данные';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<br>
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="col-3">
            <?php if(count($errorBag['wrong_input']) > 0):?>
            <div class="row">
                <?php foreach ($errorBag['wrong_input'] as $error):?>
                    <div class="alert alert-danger" role="alert">
                        <?=$error?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="login" class="form-label">Login:</label>
                    <input type="text" class="form-control" id="login" name="user_name" aria-describedby="emailHelp">
                    <?php if(count($errorBag['user_name']) > 0):?>
                        <div class="row">
                            <?php foreach ($errorBag['user_name'] as $error):?>
                                <div id="emailHelp" class="form-text">
                                    <?=$error?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    <?php if(count($errorBag['password']) > 0):?>
                        <div class="row">
                            <?php foreach ($errorBag['password'] as $error):?>
                                <div id="emailHelp" class="form-text">
                                    <?=$error?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>
                </div>
                <button type="submit" class="btn btn-primary">Enter</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
