<?php
require_once ('../backend/Aglobal_file.php');

$request = $database->get("select * from landlord_verification", [], "fetchAll");


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

    <style>
        .landlord_request{
            border: 1px solid #98BF64;

        }

        button.landlord_request:hover{
            background-color:#98BF64;
            color:black;
        }

       

    </style>
</head>
<body>
    
    <div class="row">
        <div class="col-12 col-md-2"> 
        <?php  require('public_component/sidebar.admin.php')  ?>
        </div>          

        <div class="col"  style='height:100dvh; overflow:auto'>
            <h1 class='text-center'> Landlord Request </h1>
            <div class='border shadow container ' style='height:600px'>
                <?php foreach($request as $req): ?>
                    <button class='landlord_request container-fluid p-3' value="<?=$req['verification_id']?>"> Request from <?=$req['landlord_name']?>  </button>
                <?php endforeach ?>
            </div>
        </div>
    </div>


    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/sidebar.jquery.php'); ?>
    <script>
        $(document).ready(()=>{
            let request_id;
            $(".landlord_request").click((event)=>{
                        let id = event.target.value
                        request_id = id;
                        $.ajax({
                            url : "../backend/landlord_verification_info.php",
                            method : "post",
                            data : { id : id},
                            success : (response) => {
                                console.log(response)
                                let req_info = JSON.parse(response)
                                component = `
                                    <div id="pop_up" class="card border-0 shadow-lg" style=" z-index: 9999; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 70%; max-height: 80vh; overflow-y: auto;">
                                    <div class="card-header  text-white d-flex justify-content-between align-items-center py-3" style='background: #4c583a;'>
                                        <h5 class="card-title mb-0" style=''>Landlord Verification</h5>
                                        <button id="close" type="button" class="btn-close btn-close-white" aria-label="Close"></button>
                                    </div>
                                    <div class="card-body p-4">
                                        <h2 class="mb-4">Name: <span class="text-dark">${req_info.landlord_name}</span></h2>
                                        <div class="text-center mb-4">
                                        <img class="img-fluid rounded" style="max-height: 300px; object-fit: contain;" src="image/landlord_verification_image/${req_info.verification_image}" alt="Landlord Verification Image">
                                        </div>
                                        <div class="d-flex justify-content-center gap-3 mt-4">
                                        <button class="btn btn-success btn-lg" id="approve" value="${req_info.landlord_id}">Approve</button>
                                        <button class="btn btn-danger btn-lg" id="decline" value="${req_info.landlord_id}">Decline</button>
                                        </div>
                                    </div>
                                    </div>                             
                                `

                                $("body").append(component)

                                $("#close").click(() => {
                                    $("#pop_up").remove()
                                })



                                $("#approve").click((event)=>{
                                        let landlord_id = event.target.value;
                                        $.ajax({
                                            url : "../backend/landlord_set_verified.php",
                                            method : "post",
                                            data : {
                                                landlord_id  : landlord_id,
                                                request_id : request_id
                                            },
                                            success : (response) => {
                                                window.location.reload()
                                            }
                                        })
                                })

                                $("#decline").click((event)=>{
                                        let landlord_id = event.target.value;
                                        $.ajax({
                                            url : "../backend/landlord_decline_verified.php",
                                            method : "post",
                                            data : {
                                                request_id : request_id
                                            },
                                            success : (response) => {
                                                window.location.reload()
                                            }
                                        })
                                })



                            }
                        })
            })
        })
    </script>
</body>
</html>