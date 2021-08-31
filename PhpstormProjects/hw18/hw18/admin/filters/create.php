<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location: /admin/login.php");
}
require_once ('../bread_crumbs.php');
require_once ('../db.php');
/** @var PDO $pdo */
$errorBag = [
    'data_filter' => [],
    'text' => []
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data_filter = $_POST['Data_filter'];
    if (empty($data_filter)) {
        $errorBag['data_filter'][] = 'Поле не должно быть пустым';
    } else {
        if (mb_strlen($data_filter) < 5) {
            $errorBag['data_filter'][] = 'Название слишком короткое';
        }
        if (mb_strlen($data_filter) > 255) {
            $errorBag['data_filter'][] = 'Название слишком длинное';
        }
    }

    $text = $_POST['Text'];
    if (empty($text)) {
        $errorBag['text'][] = 'Поле не должно быть пустым';
    } else {
        if (mb_strlen($text) < 5) {
            $errorBag['text'][] = 'Название слишком короткое';
        }
        if (mb_strlen($text) > 255) {
            $errorBag['text'][] = 'Название слишком длинное';
        }
    }

        $errorsCounter = count($errorBag['data_filter'] + $errorBag['text']);
        if ($errorsCounter == 0) {
            $sql = "INSERT INTO portfolio_filters (data_filter, text) VALUES (:data_filter, :text);";
            $result = $pdo->prepare($sql);

            $result->bindParam(':data_filter', $_POST['Data_filter']);
            $result->bindParam(':text', $_POST['Text']);
            $result->execute();

            $_SESSION['flash'] = ['status' => 'success', 'message' => 'Фильтр '.$_POST['Text'].' успешно добавлен'];
            header("Location: /admin/filters/");
        }
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Professional skills</title>
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
            'href' => '/admin/filters',
            'title' => 'Filters'
        ],
        [
            'href' => '/admin/filters/index.php',
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
                    <label for="data_filter" class="form-label">Data_filter:</label>
                    <input type="text" class="form-control" id="data_filter" name="Data_filter" aria-describedby="emailHelp" value="<?=$_POST['Data_filter'] ?? ''?>">
                    <?php if (count($errorBag['data_filter']) > 0):?>
                        <?php foreach ($errorBag['data_filter'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="text" class="form-label">Text: </label>
                    <input type="text" class="form-control" id="text" name="Text"  value="<?=$_POST['Text'] ?? ''?>">
                    <?php if (count($errorBag['text']) > 0):?>
                        <?php foreach ($errorBag['text'] as $error):?>
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


