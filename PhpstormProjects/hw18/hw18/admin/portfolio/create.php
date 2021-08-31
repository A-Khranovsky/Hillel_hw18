<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location: /admin/login.php");
}
require_once ('../bread_crumbs.php');
require_once ('../db.php');
/** @var PDO $pdo */
$errorBag = [
    'text' => [],
    'title' => [],
    'href' => [],
    'src' => [],
    'filters' => []
];
$sql = "select * from portfolio_filters;";
$result = $pdo->prepare($sql);
$result->execute();
$filters = $result->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

    $title = $_POST['Title'];
    if (empty($title)) {
        $errorBag['title'][] = 'Поле не должно быть пустым';
    } else {
        if (mb_strlen($title) < 5) {
            $errorBag['title'][] = 'Название слишком короткое';
        }
        if (mb_strlen($title) > 255) {
            $errorBag['title'][] = 'Название слишком длинное';
        }
    }

    $href = $_POST['Href'];
    if (empty($href)) {
        $errorBag['href'][] = 'Поле не должно быть пустым';
    } else {
        if (filter_var($href, FILTER_VALIDATE_URL) === false) {
            $errorBag['href'][] = 'Нужно указать URL';
        }
    }

    $src = $_POST['Src'];
    if (empty($src)) {
        $errorBag['src'][] = 'Поле не должно быть пустым';
    } else {
        if (filter_var($src, FILTER_VALIDATE_URL) === false) {
            $errorBag['src'][] = 'Нужно указать URL';
        }
    }

    if (!isset($_POST['Filters'])){
        $errorBag['filters'][] = 'Нужно выбрать хотя бы один фильтр';
    }

    $errorsCounter = count($errorBag['text'] + $errorBag['title'] + $errorBag['href'] + $errorBag['src'] + $errorBag['filters']);
    if ($errorsCounter == 0) {

        $sql = "INSERT INTO portfolio_gallery (text, title, href, src) VALUES (:text, :title, :href, :src);";
        $result = $pdo->prepare($sql);

        $result->bindParam(':text', $_POST['Text']);
        $result->bindParam(':title', $_POST['Title']);
        $result->bindParam(':href', $_POST['Href']);
        $result->bindParam(':src', $_POST['Src']);
        $result->execute();

        $id = $pdo->lastInsertId();

        foreach ($_POST['Filters'] as $filter) {
            $sql = "insert into filter_gallery (filter_id, gallery_id) values (:filter_id, :gallery_id);";
            $result = $pdo->prepare($sql);
            $result->bindParam(':gallery_id', $id);
            $result->bindParam(':filter_id', $filter);
            $result->execute();
        }

        $_SESSION['flash'] = ['status' => 'success', 'message' => 'Элемент портфолио '.$_POST['Title'].' успешно добавлен'];
        header("Location: /admin/portfolio/");
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

    <title>Portfolio</title>
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
            'href' => '/admin/portfolio',
            'title' => 'Portfolio'
        ],
        [
            'href' => '/admin/portfolio/index.php',
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
                    <label for="text" class="form-label">Text:</label>
                    <input type="text" class="form-control" id="text" name="Text" aria-describedby="emailHelp" value="<?=$_POST['Text'] ?? ''?>">
                    <?php if (count($errorBag['text']) > 0):?>
                        <?php foreach ($errorBag['text'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title: </label>
                    <input type="text" class="form-control" id="title" name="Title"  value="<?=$_POST['Title'] ?? ''?>">
                    <?php if (count($errorBag['title']) > 0):?>
                        <?php foreach ($errorBag['title'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="href" class="form-label">Href: </label>
                    <input type="text" class="form-control" id="href" name="Href"  value="<?=$_POST['Href'] ?? ''?>">
                    <?php if (count($errorBag['href']) > 0):?>
                        <?php foreach ($errorBag['href'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="src" class="form-label">Src: </label>
                    <input type="text" class="form-control" id="src" name="Src"  value="<?=$_POST['Src'] ?? ''?>">
                    <?php if (count($errorBag['src']) > 0):?>
                        <?php foreach ($errorBag['src'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="filters" class="form-label">Filters: </label>
                    <select class="form-select" name="Filters[]" id="filters" multiple aria-label="multiple select example">
                        <?php foreach ($filters as $filter):?>
                            <option value="<?=$filter['id']?>"><?=$filter['text']?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (count($errorBag['filters']) > 0):?>
                        <?php foreach ($errorBag['filters'] as $error):?>
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


