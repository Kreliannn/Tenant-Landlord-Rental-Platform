<?php

$like_count = count($database->get('select * from like_react where post_id = ?', [$property['post_id']], 'fetchAll'));

if($check_like = $database->get('select * from like_react where post_id = ? && user_id = ?', [$property['post_id'], $_SESSION['user']['account_id']], 'fetch'))
{
    echo 
    "<button type='button' class='like-btn col btn btn-primary text-light btn-sm ' data-post-id=" . $property['post_id']. ">
        <i class='bi bi-heart-fill'></i> 
        <b> {$like_count} </b>
    </button>";
}
else
{   
    echo "<button type='button' class='like-btn col btn btn-outline-primary btn-sm ' data-post-id='" . $property['post_id']. "'>
        <i class='bi bi-heart'></i> 
        <b> {$like_count} </b>
    </button>";
}