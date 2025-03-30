<?php
    require_once('../backend/Aglobal_file.php');
    require("../backend/check_user_session.php");
    $query = 'select * from post_property where landlord_id = ? && post_status != "banned" && post_status != "remove"';

    $property_data = $database->get($query, [$_SESSION['user']['account_id']], 'fetchAll');


    function getRequest($post_id)
    {
        global $database;
        return count($database->get("select * from tenant_applications where post_id = ?", [$post_id], "fetchAll"));
    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="image/website_image/logo-house1-removebg.png">
</head>
<body>
    <!--alert-->
    <?php require('public_component/alert_success.php'); ?>
    <?php require('public_component/alert_error.php'); ?>
    
    <div class="row">
        <div class="col-12 col-md-2">  
            <?php require('public_component/sidebar.landlord.php'); ?>
        </div>          

        <div class="col"  style='height:100dvh; overflow:auto'>
            <div class="row mt-3">
                <?php foreach ($property_data as $property): ?>
                    <div class="col-md-4 mb-4 ">
                        <div class="card">
                            <img src="image/post_property_image/<?= htmlspecialchars($property['post_images']) ?>" class="card-img-top" alt="Property Image" style="height: 300px;">
                            <div class="card-body row">
                                <?php if($property['post_status'] == 'active'): ?>
                                    <i class=" text-center border border-rounded shadow p-1 col-12 bg-success text-light"> <?=getRequest($property['post_id'])?> request</i>
                                <?php else: ?>
                                    <i class="bi bi-key text-center border border-rounded shadow p-1 col-12 bg-warning"></i>
                                <?php endif; ?>
                                <button class="btn btn-primary col-12 mt-2" class='btn' value='<?= htmlspecialchars($property['post_id']) ?>'>  property </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/sweetAlert.php'); ?>
    <?php require('public_component/sidebar.jquery.php'); ?>

    <script>
        $(document).ready(()=>{
            $(".btn").click((event) => {
                $.ajax({
                    url: '../backend/manage_property.session.php',
                    type: 'POST',
                    data: {property_id: event.target.value},
                    success: function(response) {
                        switch(response) 
                        {
                            case 'active':
                                window.location.href = "user.landlord_property.view.php";
                            break;

                            case 'inactive':
                                window.location.href = "user.landlord_property.manage.php";
                            break;
                        }
                    },
                });
            });
        })
    </script>
</body>
</html>