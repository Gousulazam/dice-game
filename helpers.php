<?php
require_once 'config/dbConnection.php';



function generateDiceNumber($min,$max)
{
    return rand($min, $max);
}
