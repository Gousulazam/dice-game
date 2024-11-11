<?php 
require_once "./config/dbConnection.php";
$database = new Database();
$conn = $database->connect();

$query = "SELECT * FROM user WHERE id=1;";
$stmt = $conn->prepare($query);
$stmt->execute();

// Fetch the unique Faculty values
$userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

// print_r($userDetails);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dice Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container card upload-card">
        <div class="card-body">
            <h5 class="card-title">Welcome to lucky 7 game</h5>
            <form id="uploadForm" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="bet_type" class="form-label">Place Your Bet (Rs 10)</label>
                    <select  class="form-control" id="bet_type" name="bet_type">
                        <option value="">Select Bet</option>
                        <option value="Below 7">Below 7</option>
                        <option value="7">7</option>
                        <option value="Above 7">Above 7</option>
                    </select>
                </div>
                <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
            </form>
            <div id="responseMessage" class="mt-3"></div>
            <br>
            <input type="hidden" name="dataTransferSts" id="dataTransferSts" value="0">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        

        $(document).ready(function() {
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();
                $('#responseMessage').html('');
                $('#submitBtn').attr('disabled', true);
                $('#submitBtn').html(`Please Wait For Result<span class="btn-spinner" style="display: none;">Loading...</span>`);
                
                let bet_type = $('#bet_type').val();
                let user_id = "<?php echo $userDetails['id']; ?>";

                if(bet_type){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo 'getBetResult.php'; ?>",
                        data: {bet_type,user_id},
                        success: function (data) {
                            $('#responseMessage').html(data);
                            $('#submitBtn').attr('disabled', false);
                            $('#submitBtn').html(`Submit`);

                            // $('#bet_type').val('');
                        }   
                    });
                }else{
                    alert('Please Select Bet');
                }
            });

            $(document).on('click','#resetBtn', function () {
                let user_id = "<?php echo $userDetails['id']; ?>";
                if(confirm('Are you sure once rest cannot recover ?')){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo 'resetBalance.php'; ?>",
                        data: {user_id},
                        success: function (data) {
                            alert(data);
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>