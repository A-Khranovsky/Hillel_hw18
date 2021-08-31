<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location: /admin/login.php");
}
require_once ('../db.php');
/** @var PDO $pdo */
$sql = "select text from portfolio_filters where id = :id;";
$result = $pdo->prepare($sql);
$result->bindParam(':id', $_GET['id']);
$result->execute();
$data = $result->fetch(PDO::FETCH_ASSOC);

$sql = "delete from portfolio_filters where id = :id;";
$result = $pdo->prepare($sql);
$result->bindParam(':id', $_GET['id']);
$result->execute();

$_SESSION['flash'] = ['status' => 'success', 'message' => 'Фильтр '.$data['text'].' успешно удален'];
header("Location: /admin/filters/");
