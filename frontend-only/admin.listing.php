<?php
require_once ('../backend/Aglobal_file.php');
require("../backend/check_user_session.php");
$property_data = $database->get('select * from post_property join landlords on post_property.landlord_id = landlords.account_id  where post_status != "inactive" && post_status != "remove" order by post_id desc ', [], 'fetchAll');

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
        <?php  require('public_component/sidebar.admin.php')  ?>
        </div>          

        <div class="col"  style='height:100dvh; overflow:auto'>
            <div class="row mb-4">
                <div class="ms-2 col-12 mt-3">
                    <form action="" method="post" class="d-flex justify-content-center">
                        <input type="text" name="search_id" class="form-control me-2" placeholder="Search...">
                        <button type="submit" class="btn btn-success" style=';' name='search_btn'>Search</button>
                    </form>
                </div>
            </div>
           
            
            <div class="row">
                <?php require('public_component/admin.listing.display.php'); ?>
            </div>
        </div>
    </div>


    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/sidebar.jquery.php'); ?>
    <script>
        
    </script>
</body>
</html>