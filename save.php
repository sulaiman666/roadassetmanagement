<?php
include 'db.php';

$table = $_POST['tables'];
$attribute = $_POST['attributes'];
$number = $_POST['numbers'];
$text = $_POST['texts'];

$add_query = "UPDATE public.$table SET $attribute = '$text' WHERE objectid = $number;";
echo($add_query);
$query = pg_query($dbcon, $add_query);



if ($query){
    echo json_encode(array("statusCode"=>200));
} else {
    echo json_encode(array("statusCode"=>201));
}
?>