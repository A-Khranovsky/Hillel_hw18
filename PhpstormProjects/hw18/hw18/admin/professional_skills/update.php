<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location: /admin/login.php");
}
require_once ('../bread_crumbs.php');
/** @var PDO $pdo */

$errorBag = [
    'name' => [],
    'score' => []
];
$data =null;
require_once ('../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['Name'];
    $score = $_POST['Score'];
    if (empty($name)) {
        $errorBag['name'][] = 'Поле не должно быть пустым';
    }
    else {
        if (mb_strlen($name) < 5) {
            $errorBag['name'][] = 'Название слишком короткое';
        }
        if (mb_strlen($name) > 255) {
            $errorBag['name'][] = 'Название слишком длинное';
        }
    }
    if (empty($score)) {
        $errorBag['score'][] = 'Поле не должно быть пустым';
    }
    else {
        if (!preg_match('/^\d+$/', $score)) {
            $errorBag['score'][] = 'Значение должно быть числом';
        }
        else {
            if (!is_int((int)$score)) {
                $errorBag['score'][] = 'Значение должно быть целым числом';
            }
            if ($score < 0 || $score > 10) {
                $errorBag['score'][] = 'Значение может быть от 0 до 10';
            }
        }

    }

    $errorsCounter = count($errorBag['name'] + $errorBag['score']);
    if ($errorsCounter == 0) {
        $sql = "update professional_skills set name = :name, score = :score where id = :id;";

        $result = $pdo->prepare($sql);
        $result->bindParam(':id', $_POST['Id']);
        $result->bindParam(':name', $_POST['Name']);
        $result->bindParam(':score', $_POST['Score']);
        $result->execute();
        $_SESSION['flash'] = ['status' => 'success', 'message' => 'Professional skill '.$_POST['Name'].' успешно обновлен'];
        header("Location: /admin/professional_skills/");
    }
}
else {
    $sql = "select * from professional_skills where id = :id;";

    $result = $pdo->prepare($sql);
    $result->bindParam(':id', $_GET['id']);
    $result->execute();
    $data = $result->fetch(PDO::FETCH_ASSOC);
}
?>

<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Personal skills</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<br>
<?= breadcrumbs(
    [
        [
            'href' => '/admin',
            'title' => 'Admin'
        ],
        [
            'href' => '/admin/professional_skills',
            'title' => 'Professional skills'
        ],
        [
            'href' => '/admin/professional_skills/update.php',
            'title' => 'Update'
        ]
    ]
)?>
<form action="" method="POST">
    <input type="hidden" name="Id" value="<?=$data['id'] ?? $_GET['id']?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="mb-3">
                    <a href="index.php" class="btn btn-outline-primary"> Back </a><br>
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="Name" aria-describedby="emailHelp" value="<?=$data['name'] ?? $_POST['Name']?>">
                    <?php if (count($errorBag['name']) > 0):?>
                        <?php foreach ($errorBag['name'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="score" class="form-label">Score: </label>
                    <input type="text" class="form-control" id="score" name="Score" aria-describedby="emailHelp" value="<?= $data['score'] ?? $_POST['Score']?>">
                    <?php if (count($errorBag['score']) > 0):?>
                        <?php foreach ($errorBag['score'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <input type="submit" class="btn btn-primary" value="Update">
            </div>
        </div>
    </div>
</form>
</body>
</html>
