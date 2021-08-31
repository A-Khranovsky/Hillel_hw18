<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location: /admin/login.php");
}
require_once ('../bread_crumbs.php');
/** @var PDO $pdo */
$errorBag = [
    'date' => [],
    'company' => [],
    'position' => [],
    'description' => []
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['Date'];
    $company = $_POST['Company'];
    $position = $_POST['Position'];
    $description = $_POST['Description'];

    if (empty($date)) {
        $errorBag['date'][] = 'Поле не должно быть пустым';
    } else {
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            $errorBag['date'][] = 'Формат даты должен быть YYYY-MM-DD';
        }
    }

    if (empty($company)) {
        $errorBag['company'][] = 'Поле не должно быть пустым';
    } else {
        if (is_numeric($company)) {
            $errorBag['company'][] = 'Значение не должно быть числом';
        } else {
            if (mb_strlen($company) < 5) {
                $errorBag['company'][] = 'Значене менее 5 символов';
            }
            if (mb_strlen($company) > 255) {
                $errorBag['company'][] = 'Значение более 255 символов';
            }
        }
    }

    if (empty($position)) {
        $errorBag['position'][] = 'Поле не должно быть пустым';
    } else {
        if (is_numeric($position)) {
            $errorBag['position'][] = 'Значение не должно быть числом';
        } else {
            if (mb_strlen($position) < 5) {
                $errorBag['position'][] = 'Значене менее 5 символов';
            }
            if (mb_strlen($position) > 255) {
                $errorBag['position'][] = 'Значение более 255 символов';
            }
        }
    }

    if (empty($description)) {
        $errorBag['description'][] = 'Поле не должно быть пустым';
    } else {
        if (is_numeric($description)) {
            $errorBag['description'][] = 'Значение не должно быть числом';
        } else {
            if (mb_strlen($description) < 5) {
                $errorBag['description'][] = 'Значене менее 5 символов';
            }
            if (mb_strlen($description) > 255) {
                $errorBag['description'][] = 'Значение более 255 символов';
            }
        }
    }
    $errorsCounter = count($errorBag['date'] + $errorBag['company'] + $errorBag['position'] + $errorBag['description']);
    if ($errorsCounter == 0) {
        require_once ('../db.php');
        $sql = "insert into diplomas (date, company, position, description) 
            values (:date, :company, :position, :description);";
        $result = $pdo->prepare($sql);

        $result->bindParam(':date', $_POST['Date']);
        $result->bindParam(':company', $_POST['Company']);
        $result->bindParam(':position', $_POST['Position']);
        $result->bindParam(':description', $_POST['Description']);
        $result->execute();

        $_SESSION['flash'] = ['status' => 'success', 'message' => 'Диплом '.$_POST['Company'].' успешно добавлен'];

        header("Location: /admin/diplomas/");
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Education & Diplomas</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<body>
<br>
<?= breadcrumbs(
    [
        [
            'href' => '/admin',
            'title' => 'Admin'
        ],
        [
            'href' => '/admin/diplomas',
            'title' => 'Diplomas & Education'
        ],
        [
            'href' => '/admin/diplomas/create.php',
            'title' => 'Create'
        ]
    ]
)?>
<form action="" method="POST">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="mb-3">
                    <a href="index.php" class="btn btn-outline-primary"> Back </a><br>
                    <label for="name" class="form-label">Date:</label>
                    <input type="text" class="form-control" name="Date" aria-describedby="emailHelp" value="<?=$_POST['Date'] ?? ''?>">
                    <?php if (count($errorBag['date']) > 0):?>
                        <?php foreach ($errorBag['date'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="company">Company: </label>
                    <input type="text" class="form-control" name="Company" id="company" aria-describedby="emailHelp" value="<?=$_POST['Company'] ?? ''?>">
                    <?php if (count($errorBag['company']) > 0):?>
                        <?php foreach ($errorBag['company'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="position">Position: </label>
                    <input type="text" class="form-control" name="Position" id="position" aria-describedby="emailHelp" value="<?=$_POST['Position'] ?? ''?>">
                        <?php if (count($errorBag['position']) > 0):?>
                        <?php foreach ($errorBag['position'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="description">Description: </label><input type="text" class="form-control" name="Description" id="description" aria-describedby="emailHelp" value="<?=$_POST['Description'] ?? ''?>">
                    <?php if (count($errorBag['description']) > 0):?>
                        <?php foreach ($errorBag['description'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <input type="submit" class="btn btn-primary" value="Create">
            </div>
        </div>
    </div>
</form>
</body>
</html>