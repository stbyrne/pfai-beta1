<?php
require_once('authenticate.php');
?>

<!doctype html>
<html lang="en">
    
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Latest News</title>
        <link rel="stylesheet" href="css/form.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <!--<link href="css/bootstrap-responsive.css" rel="stylesheet">-->
    
    </head>
    
    <body>
        
        <ul class="nav nav-tabs">
          <li><a href="index.php">Transfer List</a></li>
          <li class="active"><a href="#">News Articles</a></li>
          <li><a href="#">Empty</a></li>
        </ul>
        
        <div id="formWrap">
        <div id="formHeader">
            <h2>Latest News</h2>
            <p>input details for the new article and click "Add New Article"</p>
        </div>
        
    
        
        <form id="new-article" class="form-horizontal" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label class="control-label col-lg-2" for="new-article-headline">Article Headline</label>
                <div class="col-lg-10">
                    <input id="new-article-headline" class="form-control" name="new-article-headline" type="text" placeholder="Article Headline" required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-lg-2" for="new-article-image">Article Image</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="new-article-image" name="new-article-image" placeholder="Image Filename i.e image.png">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-lg-2" for="new-article-caption">Article Caption</label>
                <div class="col-lg-10">
                    <input id="new-article-caption" class="form-control" name="new-article-caption" type="text" placeholder="Article Caption" required>
                    
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-lg-2" for="new-article-text">Article Story</label>
                <div class="col-lg-10">
                    <textarea class="form-control" rows="3" id="new-article-text" name="new-article-text" type="text" placeholder="Article Story" required></textarea>
                </div>
            </div>
            
            <!--<input type="submit" value="Add new player">-->
            <div type="submit" class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span> Add New Article</button>
                </div>
            </div>
            
        </form>
            
        </div>
        
        <table id="news-articles" class="table table-striped table-bordered">
            <caption><h2>Latest News Articles</h2></caption>
            <!--<colgroup>
                <col />
                <col />
                <col />
                <col />
                <col />
                <col />
            </colgroup>-->
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Article Headline</th>
                    <th scope="col">Article Image</th>                            
                    <th scope="col">Article Caption</th>
                    <th scope="col">Article Text</th>
                    
                </tr>
            </thead>
            <tbody>
                
<?php
global $user_id;
$query = $connection->prepare("SELECT `article_id`, `article_headline`, `article_image`, `article_caption`, `article_text` FROM `articles` WHERE `user_id` = ?");
$query->bind_param("i", $user_id);
$query->execute();

$query->bind_result($id, $headline, $image, $caption, $text);
while ($query->fetch()) {
	echo '<tr id="article-' . $id . '" name="article_id"><th><input type="checkbox" id="'. $id .'"/></th><td id="article-' . $id . '">' . $headline . '</td><td><img src="../images/news/' . $image . '"></td><td>' . $caption . '</td><td>' . $text . '</td></tr>';
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