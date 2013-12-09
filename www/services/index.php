<?php
require_once('authenticate.php');
?>

<!doctype html>
<html lang="en">
    
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PFAI Tansfer List</title>
        <link rel="stylesheet" href="css/form.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        
    </head>
    
    <body>
        
        <ul class="nav nav-tabs">
          <li class="active"><a href="#">Transfer List</a></li>
          <li><a href="news.php">News Articles</a></li>
          <li><a href="#">Empty</a></li>
        </ul>
        
        <div id="formWrap">
        <div id="formHeader">
            <h1>Transfer List</h1>
            <span>input the required details and click "Add New Player"</span>
        </div>
        
        <form id="new-player" class="form-horizontal" role="form">
            
            <div class="form-group">
                <label class="control-label col-lg-2" for="new-player-name">Player Name</label>
                <div class="col-lg-10">
                    <input id="new-player-name" class="form-control" name="new-player-name" type="text" placeholder="Player Name" required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-lg-2" for="new-player-club">Previous Clubs</label>
                <div class="col-lg-10">
                    <input id="new-player-club" class="form-control" name="new-player-club" type="text" placeholder="Previous Clubs" required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-lg-2" for="new-player-pos">Positions</label>
                <div class="col-lg-10">
                    <input id="new-player-pos" class="form-control" name="new-player-pos" type="text" placeholder="Positions" required>
                </div>
            </div>
            
            <div class="form-group">        
                <label class="control-label col-lg-2" for="new-player-age">Age</label>
                <div class="col-lg-10">
                    <input id="new-player-age" class="form-control" name="new-player-age"  type="number" min="0" max="50" step="1" value="0">
                </div>
            </div>
            
            <div class="form-group"> 
                <label class="control-label col-lg-2" for="new-player-dob">Date Of Birth</label>
                <div class="col-lg-10">
                    <input id="new-player-dob" class="form-control" name="new-player-dob" type="datetime" placeholder="dd-mm-yyyy" required>
                </div>
            </div>
            
            <div class="form-group">        
                <label class="control-label col-lg-2" for="new-player-weight">Weight</label>
                <div class="col-lg-10">
                    <div class="input-group">
                        <input id="new-player-weight" class="form-control" name="new-player-weight" type="number" placeholder="kg" min="0" max="120" step="1">
                        <span class="input-group-addon">kg</span>
                    </div>
                </div>
            </div>
                
            <div class="form-group"> 
                <label class="control-label col-lg-2" for="new-player-exp">Experience Level</label>
                <div class="col-lg-10"> 
                    <input id="new-player-exp" class="form-control" name="new-player-exp" type="color">
                </div>
            </div>
            
            
            <!--<input type="submit" value="Add new player">-->
            <div type="submit" class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" name="submit" class="btn btn-default"><span class="glyphicon glyphicon-user"></span> Add New Player</button>
                </div>
            </div>
            
        </form>
            
        </div>
        
        
        
        <table id="transfer-list" class="table table-striped table-bordered">
            <caption><h2>Current Transfer List Of Availabe Players</h2></caption>
            <colgroup>
                <col />
                <col />
                <col />
                <col />
                <col />
                <col />
            </colgroup>
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Player Name</th>
                    <th scope="col">Previous Clubs</th>                            
                    <th scope="col">Positions</th>
                    <th scope="col">Age</th>
                    <th scope="col">Date Of Birth</th>
                    <th scope="col">Weight(kg)</th>
                    <th scope="col">Experience Level</th>
                </tr>
            </thead>
            <tbody>
                <!--<tr>
                    <th><input type="checkbox" id="1"></th>
                    <td>Finn O'Sullivan Byrne</td>
                    <td>Shelbourne</td>
                    <td>Midfield</td>
                    <td>24</td>
                    <td>1986-10-03</td>
                    <td>74</td>
                    <td style="background-color:#ffa700"></td>
                </tr>-->
                   
<?php
global $user_id;
$query = $connection->prepare("SELECT `task_id`, `task_name`, `task_club`, `task_pos`, `task_age`, `task_dob`, `task_weight`, `task_exp` FROM `tasks` WHERE `user_id` = ?");
$query->bind_param("i", $user_id);
$query->execute();

$query->bind_result($id, $name, $club, $pos, $age, $dob, $weight, $exp);
while ($query->fetch()) {
	echo '<tr id="task-' . $id . '" name="task_id"><th><input type="checkbox" id="'. $id .'"/></th><td id="player-' . $id . '">' . $name . '</td><td>' . $club . '</td><td>' . $pos . '</td><td>' . $age . '</td><td>' . $dob . '</td><td>' . $weight . '</td><td style="background-color: ' . $exp . '"></td></tr>';
}

$query->close();
?>
            </tbody>
        </table>
    
    <script src="js/jq.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/index.js" type="text/javascript"></script>
    
    </body>


</html>