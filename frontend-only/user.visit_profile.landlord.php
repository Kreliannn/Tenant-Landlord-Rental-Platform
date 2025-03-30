<?php
    require_once('../backend/Aglobal_file.php');
    require("../backend/check_user_session.php");
    $account_id = $_SESSION['visit_account_id'];

    $account_info = $database->get('select * from landlords where account_id = ?', [$account_id], 'fetch');

    $query = 'select * from post_property join landlords on post_property.landlord_id = landlords.account_id where landlords.account_id = ? && post_status = "active"';

    $property_data = $database->get($query, [$account_id], 'fetchAll');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="image/website_image/logo-house1-removebg.png">
</head>
<body>
<div class="row">
        <div class="col-12 col-md-2"> 
            <?php $_SESSION['user']['account_type'] == 'tenant' ? require('public_component/sidebar.tenant.php') : require('public_component/sidebar.landlord.php'); ?>
        </div>          

        <div class="col"  style='height:100dvh; overflow:auto'>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="image/profile_image/<?= htmlspecialchars($account_info['profile_picture']) ?>" class="card-img-top" alt="Profile Picture">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($account_info['fullname']) ?></h5>
                                <p class="card-text">User ID: <?= htmlspecialchars($account_info['account_id']) ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h2>Landlord Profile</h2>
                        <table class="table">
                            <tr>
                                <th>account_type:</th>
                                <td><?= htmlspecialchars($account_info['account_type']) ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?= htmlspecialchars($account_info['email']) ?></td>
                            </tr>
                            <tr>
                                <th>contact:</th>
                                <td><?= htmlspecialchars($account_info['contact']) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <?php require('public_component/display_post.php'); ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <br>
    <br>
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
                $.ajax({
                    url: '../backend/user.favorite_post.php',
                    method: 'post',
                    data: {
                        post_id: $(this).data('post-id')
                    },
                    success: function(response){
                        let res = JSON.parse(response);
                        switch (res.type)
                        {
                            case 'addFavorite':    
                                favorite_element.removeClass('btn-outline-warning');
                                favorite_element.addClass('btn-warning text-dark');
                            break;

                            case 'removeFavorite': 
                                favorite_element.removeClass('btn-warning text-dark');
                                favorite_element.addClass('btn-outline-warning');
                            break;
                        }
                    }
                })

            })
        })

    </script>
</body>
</html>