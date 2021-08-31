<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CV Admin</title>
</head>
<body>
<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
<div class="container">
    <div class="d-flex justify-content-center">
            <h1>CV Admin</h1>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-md-10">
            <a href="\admin\personal_skills\" class="btn btn-primary"> Personal skills </a>
            <a href="\admin\professional_skills\" class="btn btn-primary"> Professional skills </a>
            <a href="\admin\work_experience" class="btn btn-primary"> Work experience </a>
            <a href="\admin\diplomas" class="btn btn-primary"> Diplomas </a>
            <a href="\admin\references" class="btn btn-primary"> References </a>
            <a href="\admin\portfolio" class="btn btn-primary">Portfolio  </a>
            <a href="\admin\filters" class="btn btn-primary">Filters </a>
            <a href="\" class="btn btn-primary"> CV </a>
            <a href="\admin\logout.php" class="btn btn-primary"> Exit </a>
        </div>
    </div>
</body>
</html>

<!--<a href="\admin\personal_skills\" class="btn btn-primary"> Personal skills </a>
<a href="\admin\professional_skills\" class="btn btn-primary"> Professional skills </a>
<a href="\admin\work_experience" class="btn btn-primary"> Work experience </a>
<a href="\admin\diplomas" class="btn btn-primary"> Diplomas </a>
<a href="\admin\references" class="btn btn-primary"> References </a>
<a href="\" class="btn btn-primary"> CV </a>-->