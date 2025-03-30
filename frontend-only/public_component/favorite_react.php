<?php


if($check_favorite = $database->get('select * from favorite where post_id = ? && user_id = ?', [$property['post_id'], $_SESSION['user']['account_id']], 'fetch'))
{
    echo 
    "<button type='button' class='favorite-btn col btn btn-warning btn-sm  text-dark' data-post-id='" . $property['post_id'] . "'>
        <i class='bi bi-star'></i>
    </button>";
}
else
{   
    echo 
    "<button type='button' class='favorite-btn col btn btn-outline-warning btn-sm  ' data-post-id='" . $property['post_id'] . "'>
        <i class='bi bi-star'></i>
    </button>";
}