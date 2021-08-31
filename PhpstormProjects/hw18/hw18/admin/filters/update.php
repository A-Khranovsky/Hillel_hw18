<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location: /admin/login.php");
}
require_once ('../db.php');
require_once ('../bread_crumbs.php');
/** @var PDO $pdo */
$errorBag = [
    'data_filter' => [],
    'text' => []
];
$filters = null;

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
        $sql = "update portfolio_filters set data_filter = :data_filter, text = :text where id = :id;";

        $result = $pdo->prepare($sql);
        $result->bindParam(':id', $_POST['Id']);
        $result->bindParam(':data_filter', $_POST['Data_filter']);
        $result->bindParam(':text', $_POST['Text']);
        $result->execute();

        $_SESSION['flash'] = ['status' => 'success', 'message' => 'Фильтр '.$_POST['Text'].' успешно обновлен'];
        header("Location: /admin/filters/");
    }
}
else {
    $sql = "select * from portfolio_filters where id= :id;";
    $result = $pdo->prepare($sql);
    $result->bindParam(':id', $_GET['id']);
    $result->execute();
    $filters = $result->fetch(PDO::FETCH_ASSOC);
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
    <title>Filters</title>
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
            'href' => '/admin/filters',
            'title' => 'Filters'
        ],
        [
            'href' => '/admin/filters/update.php',
            'title' => 'Update'
        ]
    ]
)?>
<form action="" method="POST">
    <input type="hidden" name="Id" value="<?=$filters['id'] ?? $_GET['id']?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="mb-3">
                    <a href="index.php" class="btn btn-outline-primary"> Back </a><br>
                    <label for="data_filter" class="form-label">Data_filter:</label>
                    <input type="text" class="form-control" id="data_filter" name="Data_filter" aria-describedby="emailHelp" value="<?=$filters['data_filter'] ?? $_POST['Data_filter']?>">
                    <?php if (count($errorBag['data_filter']) > 0):?>
                        <?php foreach ($errorBag['data_filter'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="text" class="form-label">Text: </label>
                    <input type="text" class="form-control" id="text" name="Text" aria-describedby="emailHelp" value="<?=$filters['text'] ?? $_POST['Text']?>">
                    <?php if (count($errorBag['text']) > 0):?>
                        <?php foreach ($errorBag['text'] as $error):?>
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
