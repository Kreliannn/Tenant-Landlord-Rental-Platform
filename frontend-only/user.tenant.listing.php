<?php
require_once ('../backend/Aglobal_file.php');
require("../backend/check_user_session.php");
$property_data = $database->get('select * from post_property join landlords on post_property.landlord_id = landlords.account_id where post_status = "active" order by post_id desc ', [], 'fetchAll');

require("../backend/filter_property.php");
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
        <div class="row mb-4 mt-5">
        <div class="ms-2 col-12 mt-3">
            <form action="" method="post" class="d-flex justify-content-center">
                <input type="text" name="search_id" class="form-control me-2" placeholder="Search...">
                <button type="submit" class="btn"  name='search_btn' style="background-color: #728C69; color:white;">Search</button>
            </form>
        </div>
    </div>
    
    <div class="container-fluid border p-4 rounded shadow">
                <form action="" method="post" class="row g-3">
                    <div class="col-md-4 mb-2">
                        <label for="min_price" class="form-label">Minimum Price</label>
                        <input type="number" class="form-control" id="min_price" name="min_price" placeholder="Minimum Price">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="max_price" class="form-label">Maximum Price</label>
                        <input type="number" class="form-control" id="max_price" name="max_price" placeholder="Maximum Price">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="location" class="form-label">Location</label>
                        <select class="form-select" id="location" name="location">
                            <option value=""> select barangay </option>
                            <option value="niugan">niugan</option>
                            <option value="st joseph village">st joseph village</option>
                            <option value="golden city subdivision">golden city subdivision</option>
                            <option value="cabuyao">cabuyao</option>
                            <option value="mabuhay homes subdivision">mabuhay homes subdivision</option>
                            <option value="villa anthurium">villa anthurium</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="max_room_count" class="form-label">Room Count</label>
                        <input type="number" class="form-control" id="room_count" name="room_count" placeholder="Room Count">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="max_bathroom_count" class="form-label">bathroom Count</label>
                        <input type="number" class="form-control" id="bathroom_count" name="bathroom_count" placeholder="bathroom Count">
                    </div>
                    <div class="col-md-4 mb-2">
                    <button type="submit" class="btn w-100 mt-4" name='filter_btn' style="background-color: #728C69; color:white; position:relative; top:8px;">Filter</button>
                    </div>
                </form>
            </div>
            
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