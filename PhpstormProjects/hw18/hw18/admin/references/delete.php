<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("Location: /admin/login.php");
}
require_once ('../db.php');
/** @var PDO $pdo */
$sql = "select testimonial from tb_references where id = :id;";
$result = $pdo->prepare($sql);
$result->bindParam(':id', $_GET['id']);
$result->execute();
$data = $result->fetch(PDO::FETCH_ASSOC);

$sql = "delete from tb_references where id = :id;";
$result = $pdo->prepare($sql);
$result->bindParam(':id', $_GET['id']);
$result->execute();

$_SESSION['flash'] = ['status' => 'success', 'message' => 'Ссылка '.$data['testimonial'].' успешно удалена'];
header("Location: /admin/references/");
