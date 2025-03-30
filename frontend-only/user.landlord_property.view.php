<?php
    require_once('../backend/Aglobal_file.php');
    require("../backend/check_user_session.php");

    $post_id = $_SESSION['manage_property_id'];

    $query = 'select * from post_property where post_id = ?';

    $property_data = $database->get($query, [ $post_id ], 'fetch');

    $request = $database->get("select * from  tenant_applications where post_id = ?", [ $post_id ], 'fetchAll');

    $likes = count($database->get("select * from  like_react where post_id = ?", [ $post_id ], 'fetchAll'));
    $favorite= count($database->get("select * from  favorite where post_id = ?", [ $post_id ], 'fetchAll'));
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
    
    <input type="hidden" id='post_id' value='<?=$post_id?>'>

    <div class="row">
        <div class="col-12 col-md-2">  
            <?php require('public_component/sidebar.landlord.php'); ?>
        </div>          

        <div class="col" id='container'  style='height:100dvh; overflow:auto'>

        <div class="row ">
            <?php if($property_data['post_status'] == 'active') : ?>
                <?php require('public_component/property_view.no_tenant.php'); ?>
            <?php else : ?>
                <script> window.location.href = `https://example.com/page?param=${value}`; </script>
            <?php endif; ?>
        </div>

        </div>
    </div>

    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/sweetAlert.php'); ?>
    <?php require('public_component/sidebar.jquery.php'); ?>

    <script>
        $(document).ready(()=>{

            $("#delete").click(()=>{
                $.ajax({
                    url: "../backend/delete_post.landlord.php",
                    method : "post",
                    data : {
                        post_id : $("#post_id").val()
                    },
                    success: (response) => {
                        window.location.href = "user.landlord_properties.php";
                    }
                })    
            })


           $(".req").click((event) => {
                $.ajax({
                    url: "../backend/get_tenant_request.php",
                    method : "post",
                    data : {
                        request_id : event.target.value
                    },
                    success: (response) => {
                        let request_data = JSON.parse(response);
                        let popupContent = `
                            <div class="card" id='popUp'style="position: fixed; z-index: 9999; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 350px; height: 600px;">
                                <div class="card-header">
                                    <h5 class="card-title ">Request Details</h5>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="post_id" value="${request_data.post_id}">
                                    <input type="hidden" id="tenant_id" value="${request_data.tenant_id}">
                                    <input type="hidden" id="landlord_id" value="${request_data.landlord_id}">
                                    <p><strong>Tenant Fullname:</strong> <font id="tenant_fullname">${request_data.tenant_fullname}</font></p>
                                    <p><strong>Contact Phone:</strong> <font id="contact_phone">${request_data.contact_phone}</font></p>
                                    <p><strong>Contact Email:</strong> <font id="contact_email">${request_data.contact_email}</font></p>
                                    <p><strong>Number of Occupants:</strong> <font id="num_occupants">${request_data.num_occupants}</font></p>
                                    <p><strong>Move In Date:</strong> <font id="move_in_date">${request_data.move_in_date}</font></p>
                                    <p><strong>Employment/Work:</strong> <font id="employment_work">${request_data.employment_work}</font></p>
                                </div>
                                <div class="card-footer">
                                    <button type="button" id='approve'class="btn btn-success" style="width: 100px; height: 50px;">Approve</button>
                                    <button type="button" id='reject' class="btn btn-danger" style="width: 100px; height: 50px;">Reject</button>
                                    <button type="button"id='close_req' class="btn btn-dark" style="width: 100px; height: 50px;">Close</button>
                                </div>
                            </div>
                        `;

                        $("#container").append(popupContent)   
                        
                        $("#close_req").click(()=>{
                            $("#popUp").remove();
                        })

                        $("#reject").click(()=>{
                            $.ajax({
                                url : "../backend/landlord.reject_request.php",
                                method : "post",
                                data : { 
                                    apply_id : request_data.apply_id
                                },
                                success : (response) => {
                                    window.location.reload();
                                }
                            })
                               
                        })

                        $("#approve").click(()=>{
                            $.ajax({
                                url : "../backend/landlord.approved_request.php",
                                method : "post",
                                data : {
                                    post_id : $("#post_id").val(),
                                    tenant_fullname : $("#tenant_fullname").text(),
                                    contact_phone : $("#contact_phone").text(),
                                    contact_email : $("#contact_email").text(),
                                    num_occupants : $("#num_occupants").text(),
                                    move_in_date : $("#move_in_date").text(),
                                    tenant_id : $("#tenant_id").val(),
                                    landlord_id : $("#landlord_id").val()
                                },
                                success : (response) => {
                                    window.location.href = "user.landlord_property.manage.php"
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