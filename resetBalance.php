<?php
require_once "./config/dbConnection.php";
require_once "./helpers.php";

$database = new Database();
$conn = $database->connect();

$user_id = $_POST['user_id'];

$query = "SELECT * FROM user WHERE id=$user_id";
$stmt = $conn->prepare($query);
$stmt->execute();

$userDetails = $stmt->fetch(PDO::FETCH_ASSOC);
$points = 100;
$is_reset = 1;

$sql = "UPDATE `user` SET `points` = :points WHERE `user`.`id` = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':points', $points);
$stmt->bindParam(':user_id', $userDetails['id']);
$stmt->execute();

$sql = "UPDATE `user_bets` SET `is_reset` = :is_reset WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':is_reset', $is_reset);
$stmt->bindParam(':user_id', $userDetails['id']);
$stmt->execute();

echo "Balace reset to 100";