<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location: /admin/login.php");
}
require_once ('../db.php');
/** @var PDO $pdo */
$sql = "select title from portfolio_gallery where id = :id;";
$result = $pdo->prepare($sql);
$result->bindParam(':id', $_GET['id']);
$result->execute();
$data = $result->fetch(PDO::FETCH_ASSOC);

$sql = "delete from filter_gallery where gallery_id = :id;";
$result = $pdo->prepare($sql);
$result->bindParam(':id', $_GET['id']);
$result->execute();

$sql = "delete from portfolio_gallery where id = :id;";
$result = $pdo->prepare($sql);
$result->bindParam(':id', $_GET['id']);
$result->execute();

$_SESSION['flash'] = ['status' => 'success', 'message' => 'Элемент портфолио '.$data['title'].' успешно удален'];
header("Location: /admin/portfolio/");
