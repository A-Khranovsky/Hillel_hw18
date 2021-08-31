<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location: /admin/login.php");
}
require_once ('../bread_crumbs.php');
/** @var PDO $pdo */
$errorBag = [
    'start_date' => [],
    'end_date' => [],
    'company' => [],
    'position' => [],
    'description' => []
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start_date = $_POST['Start_date'];
    $end_date = $_POST['End_date'];
    $company = $_POST['Company'];
    $position = $_POST['Position'];
    $description = $_POST['Description'];

    if (empty($start_date)) {
        $errorBag['start_date'][] = 'Поле не должно быть пустым';
    } else {
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $start_date)) {
            $errorBag['start_date'][] = 'Формат даты должен быть YYYY-MM-DD';
        } else {
            $buff_start_date = new DateTime($start_date);
        }
    }

    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $end_date)) {
        $errorBag['end_date'][] = 'Формат даты должен быть YYYY-MM-DD';
    } else {
        $buff_end_date = new DateTime($end_date);
    }
    if ($buff_end_date < $buff_start_date) {
        $errorBag['end_date'][] = 'Конечная дата не может быть меньше начальной';
    }
    if ($buff_end_date == $buff_start_date) {
        $errorBag['start_date'][] = 'Начальна дата не должна быть равна конечной';
        $errorBag['end_date'][] = 'Конечная дата не может быть равна начальной';
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
    $errorsCounter = count($errorBag['start_date'] + $errorBag['end_date'] + $errorBag['company'] + $errorBag['position'] + $errorBag['description']);
    if ($errorsCounter == 0) {
        require_once('../db.php');
        $sql = "INSERT INTO work_experience (start_date, end_date, company, position, description) VALUES (:start_date, :end_date, :company, :position, :description);";
        $result = $pdo->prepare($sql);

        $result->bindParam(':start_date', $_POST['Start_date']);
        $result->bindParam(':end_date', $_POST['End_date']);
        $result->bindParam(':company', $_POST['Company']);
        $result->bindParam(':position', $_POST['Position']);
        $result->bindParam(':description', $_POST['Description']);
        $result->execute();

        $_SESSION['flash'] = ['status' => 'success', 'message' => 'Work experience '.$_POST['Company'].' успешно добавлен'];
        header("Location: /admin/work_experience/");
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
    <title>Work experience</title>
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
            'href' => '/admin/work_experience',
            'title' => 'Work experience'
        ],
        [
            'href' => '/admin/work_experience/create.php',
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
                    <label for="start_date">Start date: </label><input type="text" class="form-control" name="Start_date" id="start_date" aria-describedby="emailHelp" value="<?=$_POST['Start_date'] ?? ''?>">
                    <?php if (count($errorBag['start_date']) > 0):?>
                        <?php foreach ($errorBag['start_date'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="end_date">End date: </label><input type="text" class="form-control" name="End_date" id="end_date" aria-describedby="emailHelp" value="<?=$_POST['End_date'] ?? ''?>">
                    <?php if (count($errorBag['end_date']) > 0):?>
                        <?php foreach ($errorBag['end_date'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="company">Company: </label><input type="text" class="form-control" name="Company" id="company" aria-describedby="emailHelp" value="<?=$_POST['Company'] ?? ''?>">
                    <?php if (count($errorBag['company']) > 0):?>
                        <?php foreach ($errorBag['company'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="position">Position: </label><input type="text" class="form-control" name="Position" id="position" aria-describedby="emailHelp" value="<?=$_POST['Position'] ?? ''?>">
                    <?php if (count($errorBag['position']) > 0):?>
                        <?php foreach ($errorBag['position'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="description">Description: </label><input type="text" class="form-control" name="Description" id="Description" aria-describedby="emailHelp" value="<?=$_POST['Description'] ?? ''?>">
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