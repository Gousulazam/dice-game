<?php
require_once "./config/dbConnection.php";
require_once "./helpers.php";

$database = new Database();
$conn = $database->connect();

$bet_type = $_POST['bet_type'];
$user_id = $_POST['user_id'];

$dice1 = generateDiceNumber(1, 6);
$dice2  = generateDiceNumber(1, 6);
$result = $dice1 + $dice2;


$query = "SELECT * FROM user WHERE id=$user_id";
$stmt = $conn->prepare($query);
$stmt->execute();

$userDetails = $stmt->fetch(PDO::FETCH_ASSOC);
$totalPoints = $userDetails['points'];

if($totalPoints >= 10){
    $totalPoints -= 10;
    $points = -10;
    $isWin = false;
    if ($bet_type == "Below 7") {
        if ($result < 7) {
            $totalPoints += 20;
            $points = 20;
            $isWin = true;
        }
    } else if ($bet_type == "7") {
        if ($result == 7) {
            $totalPoints += 30;
            $points = 30;
            $isWin = true;
        }
    } else if ($bet_type == "Above 7") {
        if ($result > 7) {
            $totalPoints += 20;
            $points = 20;
            $isWin = true;
        }
    }
    
    $insertQuery = "INSERT INTO `user_bets` (`user_id`, `predicted_number`, `result`, `points`) VALUES (:user_id, :predicted_number, :result, :points);";
    $insertStmt = $conn->prepare($insertQuery);
    // Bind the Faculty value to the branch_name
    $insertStmt->bindParam(':user_id', $userDetails['id']);
    $insertStmt->bindParam(':predicted_number', $bet_type);
    $insertStmt->bindParam(':result', $result);
    $insertStmt->bindParam(':points', $points);
    
    // Execute the insert query
    $insertStmt->execute();
    
    
    $sql = "UPDATE `user` SET `points` = :points WHERE `user`.`id` = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':points', $totalPoints);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    
    echo "
    <h5>Game Result</h5>
    Dice 1 : $dice1<br>
    Dice 2 : $dice2<br>
    Total : $result<br>
    ";
    if($isWin){
    echo  "Congratulations ! You Win !";
    }else{
        echo  "You Lost !";
    }
    
    echo " Your Balance is Now $totalPoints";
}else{
    echo "Sorry Cannot place your bet due low balance $totalPoints";
}

echo '<br> <br><button type="button" id="resetBtn" class="btn btn-danger">Reset Balance to 100</button>';