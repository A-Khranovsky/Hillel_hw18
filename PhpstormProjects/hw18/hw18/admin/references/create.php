<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location: /admin/login.php");
}
require_once ('../bread_crumbs.php');
/** @var PDO $pdo */
$errorBag = [
    'testimonial' => [],
    'person' => [],
    'position' => [],
    'image' => []
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $testimonial = $_POST['Testimonial'];
    $person = $_POST['Person'];
    $position = $_POST['Position'];
    $image = $_POST['Image'];

    if (empty($testimonial)) {
        $errorBag['testimonial'][] = 'Поле не должно быть пустым';
    } else {
        if (is_numeric($testimonial)) {
            $errorBag['testimonial'][] = 'Значение не должно быть числом';
        } else {
            if (mb_strlen($testimonial) < 5) {
                $errorBag['testimonial'][] = 'Значене менее 5 символов';
            }
            if (mb_strlen($testimonial) > 255) {
                $errorBag['testimonial'][] = 'Значение более 255 символов';
            }
        }
    }

    if (empty($person)) {
        $errorBag['person'][] = 'Поле не должно быть пустым';
    } else {
        if (is_numeric($person)) {
            $errorBag['person'][] = 'Значение не должно быть числом';
        } else {
            if (mb_strlen($person) < 5) {
                $errorBag['person'][] = 'Значене менее 5 символов';
            }
            if (mb_strlen($person) > 255) {
                $errorBag['person'][] = 'Значение более 255 символов';
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

    if (empty($image)) {
        $errorBag['image'][] = 'Поле не должно быть пустым';
    } else {
        if (filter_var($image, FILTER_VALIDATE_URL) === false) {
            $errorBag['image'][] = 'Нужно указать URL';
        }
    }
    $errorsCounter = count($errorBag['testimonial'] + $errorBag['image'] + $errorBag['person'] + $errorBag['position']);
    if ($errorsCounter == 0) {
        require_once ('../db.php');
        $sql = "insert into tb_references (testimonial, image, person, position) 
            values (:testimonial, :image, :person, :position);";
        $result = $pdo->prepare($sql);

        $result->bindParam(':testimonial', $_POST['Testimonial']);
        $result->bindParam(':image', $_POST['Image']);
        $result->bindParam(':person', $_POST['Person']);
        $result->bindParam(':position', $_POST['Position']);
        $result->execute();

        $_SESSION['flash'] = ['status' => 'success', 'message' => 'Ссылка '.$_POST['Testimonial'].' успешно добавлена'];
        header("Location: /admin/references/");
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
    <title>References</title>
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
            'href' => '/admin/references',
            'title' => 'References'
        ],
        [
            'href' => '/admin/references/create.php',
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
                    <label for="testimonial">Testimonial: </label><input type="text" class="form-control" name="Testimonial" id="testimonial" aria-describedby="emailHelp" value="<?=$_POST['Testimonial'] ?? ''?>">
                        <?php if (count($errorBag['testimonial']) > 0):?>
                        <?php foreach ($errorBag['testimonial'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="image">Image: </label><input type="text" class="form-control" name="Image" id="image" aria-describedby="emailHelp" value="<?=$_POST['Image'] ?? ''?>">
                        <?php if (count($errorBag['image']) > 0):?>
                        <?php foreach ($errorBag['image'] as $error):?>
                            <div id="emailHelp" class="form-text"> <?=$error ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="person">Person: </label><input type="text" class="form-control" name="Person" id="company" aria-describedby="emailHelp" value="<?=$_POST['Person'] ?? ''?>">
                        <?php if (count($errorBag['person']) > 0):?>
                        <?php foreach ($errorBag['person'] as $error):?>
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
                 <input type="submit" class="btn btn-primary" value="Create">
            </div>
        </div>
    </div>
</form>
</body>
</html>