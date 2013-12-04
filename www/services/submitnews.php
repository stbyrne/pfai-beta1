<?php
require_once('authenticate.php');

$headline = null;
$image = 'news.png';
$caption = null;
$text = null;
    
$result = array();
$result['error'] = array();
    
if (!empty($_POST['new-article-headline']))
    $headline = $_POST['new-article-headline'];
else 
    array_push($result['error'], 'Please specify a headline for the article');
    
if (!empty($_POST['new-article-image']))
    $image = $_POST['new-article-image'];

    
if (!empty($_POST['new-article-caption']))
    $caption = $_POST['new-article-caption'];

    
if (!empty($_POST['new-article-text']))
    $text = $_POST['new-article-text'];
else 
    array_push($result['error'], 'Please input text for the article');

if(isset($result['error']) && count($result['error']) > 0){
    $result['success'] = false;
} else {
   
    $query = $connection->prepare("INSERT INTO `articles` ( `user_id`, `article_headline`, `article_image`, `article_caption`, `article_text` ) VALUES ( ?, ?, ?, ?, ? );");
	$query->bind_param("issss", $user_id, $headline, $image, $caption, $text );
	$query->execute();
	$result['id'] = $query->insert_id;
	$query->close();
    
    $result['success'] = true;
    $result['headline'] = $headline;
    $result['image'] = $image;
    $result['caption'] = $caption;
    $result['text'] = $text;
}

echo json_encode($result);

?>
