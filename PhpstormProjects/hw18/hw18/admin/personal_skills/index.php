<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location: /admin/login.php");
}
require_once ('../bread_crumbs.php');
require_once ('../db.php');
$sql = "select * from personal_skills;";

/** @var PDO $pdo */
$result = $pdo->prepare($sql);
$result->execute();

$data = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Personal skills</title>
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
            'href' => '/admin/personal_skills',
            'title' => 'Personal skills'
        ]
    ]
)?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-7">
                <?php if(isset($_SESSION['flash'])):?>
                    <div class="alert alert-<?=$_SESSION['flash']['status']?>" role="alert">
                        <?=$_SESSION['flash']['message']?>
                    </div>
                    <?php unset($_SESSION['flash']); ?>
                <?php endif ?>
                <a href="create.php" class="btn btn-outline-primary">Add</a>
                <a href="/admin/" class="btn btn-outline-primary">Back</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Score</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $item): ?>
                        <tr>
                            <th scope="row"><?=$item['id']?></th>
                            <td><?=$item['name']?></td>
                            <td><?=$item['score']?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <a href="update.php?id=<?=$item['id']?>"  class="btn btn-outline-primary">Edit</a>
                                    <a href="delete.php?id=<?=$item['id']?>" class="btn btn-outline-primary">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
