<?php

require_once ('../backend/Aglobal_file.php');
require("../backend/check_user_session.php");

$query = 'select * from post_property join landlords on post_property.landlord_id = landlords.account_id join favorite on post_property.post_id = favorite.post_id where favorite.user_id = ? && post_status = "active"';
$property_data = $database->get($query, [$_SESSION['user']['account_id']], 'fetchAll');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="image/website_image/logo-house1-removebg.png">
</head>
<body>
    
    <div class="row">
        <div class="col-12 col-md-2"> 
            <?php $_SESSION['user']['account_type'] == 'tenant' ? require('public_component/sidebar.tenant.php') : require('public_component/sidebar.landlord.php'); ?>
        </div>          

        <div class="col"  style='height:100dvh; overflow:auto'>
            <div class="row">
                <?php require('public_component/display_post.php'); ?>
            </div>
        </div>
    </div>


    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/sidebar.jquery.php'); ?>
    <script>
        $(document).ready(() => {
            $('.like-btn').click(function(e){
                e.preventDefault();

                let like_element = $(this);

                $.ajax({
                    url: '../backend/user.like_post.php',
                    method: 'post',
                    data: {
                        post_id: $(this).data('post-id')
                    },
                    success: function(response){
                        let res = JSON.parse(response);
                        switch (res.type)
                        {
                            case 'like':
                                like_element.removeClass('btn-outline-primary');
                                like_element.addClass('btn-primary text-light');
                                like_element.children('b').text(res.like_count);
                            break;

                            case 'unlike':
                                like_element.removeClass('btn-primary text-light');
                                like_element.addClass('btn-outline-primary');
                                like_element.children('b').text(res.like_count);
                            break;
                        }

                    }
                })
            })

            $(".favorite-btn").click(function(e){
                e.preventDefault();

                let favorite_element = $(this);
                let favorite_post = $(this).parent().parent().parent().parent().parent().parent();

                $.ajax({
                    url: '../backend/user.favorite_post.php',
                    method: 'post',
                    data: {
                        post_id: $(this).data('post-id')
                    },
                    success: () =>{
                        favorite_post.fadeOut(500);
                    }
                })

            })
           
        })

    </script>
</body>
</html> 