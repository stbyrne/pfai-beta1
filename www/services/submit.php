<?php
require_once('authenticate.php');

$name = null;
$club = null;
$pos = null;
$age = 0;
$dob = date('c');
$weight = 0;
$exp = #ffffff;
    
$result = array();
$result['error'] = array();
    
if (!empty($_POST['new-player-name']))
    $name = $_POST['new-player-name'];
else 
    array_push($result['error'], 'Please specify a name for the player');
    
if (!empty($_POST['new-player-club']))
    $club = $_POST['new-player-club'];

    
if (!empty($_POST['new-player-pos']))
    $pos = $_POST['new-player-pos'];
else 
    array_push($result['error'], 'Please specify a position for the player');
    
if (!empty($_POST['new-player-age']))
    $age = $_POST['new-player-age'];
    
if (!empty($_POST['new-player-dob']))
    $dob = new DateTime($_POST['new-player-dob']);
else 
    array_push($result['error'], 'Please specify a date of birth for the player');
    
if (!empty($_POST['new-player-weight']))
    $weight = $_POST['new-player-weight'];
    
if (!empty($_POST['new-player-exp']))
    $exp = $_POST['new-player-exp'];

if(isset($result['error']) && count($result['error']) > 0){
    $result['success'] = false;
} else {
    $dob = $dob->format('Y-m-d');
    
    $query = $connection->prepare("INSERT INTO `tasks` ( `user_id`, `task_name`, `task_club`, `task_pos`, `task_age`, `task_dob`, `task_weight`, `task_exp` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ? );");
	$query->bind_param("isssisis", $user_id, $name, $club, $pos, $age, $dob, $weight, $exp );
	$query->execute();
	$result['id'] = $query->insert_id;
	$query->close();
    
    $result['success'] = true;
    $result['name'] = $name;
    $result['club'] = $club;
    $result['pos'] = $pos;
    $result['age'] = $age;
    $result['dob'] = $dob;
    $result['weight'] = $weight;
    $result['exp'] = $exp;
}

echo json_encode($result);

?>
