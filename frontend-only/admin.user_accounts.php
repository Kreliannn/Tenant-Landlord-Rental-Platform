<?php

require_once ('../backend/Aglobal_file.php');
require("../backend/check_user_session.php");

$all_tenant = $database->get("select *  from tenants",[],"fetchAll");
$all_landlords = $database->get("select * from landlords",[],"fetchAll");

if($_SERVER['REQUEST_METHOD'] == "POST")
{

    if(isset($_POST['usernameT']))
    {
        $all_tenant = $database->get("select *  from tenants where username = ?",[ $_POST['usernameT'] ],"fetchAll");
    }

    if(isset($_POST['usernameL']))
    {
        $all_landlords = $database->get("select *  from landlords where username = ?",[$_POST['usernameL'] ],"fetchAll");
    }

    
}




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
    <!-- Tailwind CSS -->
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="image/website_image/logo-house1-removebg.png">
</head>
<body>
    
    <div class="row">
        <div class="col-12 col-md-2"> 
            <?php  require('public_component/sidebar.admin.php')  ?>
        </div>          

        <div class="col ms-4"  style='height:100dvh; overflow:auto'>
        <div class="row">

            <div class="col-md-6 mt-4">
                <div class="container" style="height: 90vh; border: 1px solid #ddd; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <h2 class="text-center">Tenant</h2>
                    <div class="container border m-0 p-0 overflow-auto" style="height: 75%;" id='tenant_container'>

                    <?php foreach ($all_tenant as $tenant): ?>
                        <div class="container-fluid border d-flex justify-content-between align-items-center" style="height: 70px;">
                            <div class="d-flex align-items-center" style='width:60%'>
                                <img src="image/profile_image/<?php echo htmlspecialchars($tenant['profile_picture']); ?>" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                <span class="ms-2"><?php echo htmlspecialchars($tenant['fullname']); ?></span>
                                <span class="ms-2"> @<?php echo htmlspecialchars($tenant['username']); ?></span>
                            </div>
                            
                            <?php if($tenant['account_status'] == "active"): ?>
                            <span class="ms-5 badge bg-success"> <?php echo htmlspecialchars($tenant['account_status']); ?></span>
                            <form action="../backend/delete_account.php" class='' method='post'>
                                <input type="hidden" name='account_type' value="<?=$tenant['account_type']?>">
                                <input type="hidden" name='account_id' value="<?=$tenant['account_id']?>">
                                <input type="hidden" name='account_status' value="<?=$tenant['account_status']?>">
                                <input type="submit" class='btn btn-primary' value='ban'>
                            </form>
                            <?php else: ?>
                            <span class="ms-5 badge bg-danger"> <?php echo htmlspecialchars($tenant['account_status']); ?></span>
                            <form action="../backend/delete_account.php" class='' method='post'>
                                <input type="hidden" name='account_type' value="<?=$tenant['account_type']?>">
                                <input type="hidden" name='account_id' value="<?=$tenant['account_id']?>">
                                <input type="hidden" name='account_status' value="<?=$tenant['account_status']?>">
                                <input type="submit" class='btn btn-primary' value='unban'>
                            </form>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>

                    </div>


                    <form action="" method='post' class='row mt-3'> 
                        <div class="col-9">
                            <input type="text" class="form-control form-control-lg" name='usernameT'>
                        </div>
                        <div class="col"> 
                            <input type="submit"  class='btn btn-primary'>          
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-md-6 mt-4">
                <div class="container" style="height: 90vh; border: 1px solid #ddd; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <h2 class="text-center">Landlord</h2>
                    <div class="container border m-0 p-0 overflow-auto" style="height: 75%;"  id='landord_container'>

                    <?php foreach ($all_landlords as $landlords): ?>
                        <div class="container-fluid border d-flex justify-content-between align-items-center" style="height: 70px;">
                            <div class="d-flex align-items-center" style='width:60%'>
                                <img src="image/profile_image/<?php echo htmlspecialchars($landlords['profile_picture']); ?>" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                <span class="ms-2"><?php echo htmlspecialchars($landlords['fullname']); ?></span>
                                <span class="ms-2"> @<?php echo htmlspecialchars($landlords['username']); ?></span>
                            </div>
                            
                            <?php if($landlords['account_status'] == "active"): ?>
                            <span class="ms-5 badge bg-success"> <?php echo htmlspecialchars($landlords['account_status']); ?></span>
                            <form action="../backend/delete_account.php" class='' method='post'>
                                <input type="hidden" name='account_type' value="<?=$landlords['account_type']?>">
                                <input type="hidden" name='account_id' value="<?=$landlords['account_id']?>">
                                <input type="hidden" name='account_status' value="<?=$landlords['account_status']?>">
                                <input type="submit" class='btn btn-primary' value='ban'>
                            </form>
                            <?php else: ?>
                            <span class="ms-5 badge bg-danger"> <?php echo htmlspecialchars($landlords['account_status']); ?></span>
                            <form action="../backend/delete_account.php" class='' method='post'>
                                <input type="hidden" name='account_type' value="<?=$landlords['account_type']?>">
                                <input type="hidden" name='account_id' value="<?=$landlords['account_id']?>">
                                <input type="hidden" name='account_status' value="<?=$landlords['account_status']?>">
                                <input type="submit" class='btn btn-primary' value='unban'>
                            </form>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                    </div>

                    <form action="" method='post' class='row mt-3'> 
                        <div class="col-9">
                            <input type="text" class="form-control form-control-lg" name='usernameL'>
                        </div>
                        <div class="col"> 
                            <input type="submit"  class='btn btn-primary'>          
                        </div>
                    </form>

                </div>
            </div>
        </div>
        </div>
    </div>


    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/sidebar.jquery.php'); ?>
    <script>
        $(document).ready(()=>{
        
        })
    </script>
</body>
</html>