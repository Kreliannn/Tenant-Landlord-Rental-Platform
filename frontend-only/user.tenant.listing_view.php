<?php
    require_once ('../backend/Aglobal_file.php');
    require("../backend/check_user_session.php");
    $property = $database->get('select * from post_property join landlords on post_property.landlord_id = landlords.account_id where post_id = ?', [$_POST['post_id']], 'fetch');
    $property_images = $database->get('select * from property_post_pictures where post_id = ?', [$_POST['post_id']], 'fetchAll');
    $landlord_id = $database->get('select username, account_id from landlords where account_id = ?', [$property['landlord_id']], 'fetch');
    $isRenting = $_SESSION['user']['isRenting'];
 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="image/website_image/logo-house1-removebg.png">
</head>
<body>
    <input type="hidden" id="sender_fullname" value="<?= $_SESSION['user']['fullname'] ?>">
    <input type="hidden" id="tenant_id" value="<?= $_SESSION['user']['account_id'] ?>">
    <input type="hidden" id="user_contact" value="<?= $_SESSION['user']['contact'] ?>">
    <input type="hidden" id="user_email" value="<?= $_SESSION['user']['email'] ?>">
    <input type="hidden" id="landlord_username" value="<?= $landlord_id['username'] ?>">
    <input type="hidden" id="landlord_id" value="<?= $landlord_id['account_id'] ?>">
    <input type="hidden" id="landlord_fullname" value="<?= $property['fullname'] ?>">
    <input type="hidden" id='post_id' value="<?= $property['post_id'] ?>">
    <input type="hidden" id="account_type" value="<?= $property['account_type'] ?>">
    <input type="hidden" id='latitude' value="<?= $property['latitude'] ?>">
    <input type="hidden" id='longitude' value="<?= $property['longitude'] ?>">


    <!-- report pop up-->
    <div id="reportPopup" class="border shadadow bg-light p-4" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 300px; height: 300px; z-index: 9999;">
        <div class="popup-content">
            <button type="button" class="btn-close" id="close_report" aria-label="Close" style="position: absolute; top: 10px; right: 10px;"></button>
            <h3>Report</h3>
            <textarea id="report_message" class="form-control" rows="4" placeholder="Enter your report here..." style="height: 100px;"></textarea>
            <select id="report_reason" class="form-select" style="margin-top: 10px;">
                <option value="Inaccurate Information ">Inaccurate Information </option>
                <option value="Violation of Terms"> Violation of Terms </option>
                <option value="Inappropriate Content">Inappropriate Content</option>
                <option value="Unavailable Property">Unavailable Property</option>
                <option value="Misleading Photos"> Misleading Photos</option>
            </select>
            <button id="submit_report" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
        </div>
    </div>

    <div id="applyPopup" class="border shadadow bg-light p-4" style="display: none; position: absolute; top: 55%; left: 50%; transform: translate(-50%, -50%); width: 500px;  z-index: 9999;">
        <div class="popup-content">
            <button type="button" class="btn-close" id="close_apply" aria-label="Close" style="position: absolute; top: 10px; right: 10px;"></button>
            <h3 class='text-center'>request to rent this property</h3>
            <div class="mb-3">
                <label for="tenant_fullname" class="form-label">Tenant's Full Name</label>
                <input type="text" class="form-control" id="tenant_fullname" value='<?=$_SESSION['user']['fullname'] ?>' required>
            </div>
            <div class="mb-3">
                <label for="contact_phone" class="form-label">Contact Phone</label>
                <input type="text" class="form-control" id="contact_phone" value='<?=$_SESSION['user']['contact']?>' required>
            </div>
            <div class="mb-3">
                <label for="contact_email" class="form-label">Contact Email</label>
                <input type="email" class="form-control" id="contact_email" value="<?= $_SESSION['user']['email'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="num_occupants" class="form-label">Number of Occupants (including adults and children)</label>
                <input type="number" class="form-control" id="num_occupants" required>
            </div>
            <div class="mb-3">
                <label for="move_in_date" class="form-label">Planned Move-in Date</label>
                <input type="date" class="form-control" id="move_in_date" required>
            </div>
            <div class="mb-3">
                <label for="employment_income" class="form-label">Occupants' Employment or Source of Income (if applicable)</label>
                <input class="form-control" id="employment_work" rows="3" value="N/A"></input>
            </div>
            <button id="submit_apply" class="btn btn-success" style="margin-top: 10px;">Submit</button>
        </div>
    </div>



    <div class="row">
        <div class="col-12 col-md-2">
            <?php require('public_component/sidebar.tenant.php'); ?>
        </div>          
        <div class="col"  style='height:100dvh; overflow:auto'>
        <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <!-- User Information -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body row">
                                <div class="col-4 text-center">
                                    <img src="image/profile_image/<?= $property['profile_picture'] ?>" alt="User Profile" class="rounded-circle img-fluid" style="width: 150px; border: 2px solid #fff;">
                                </div>
                                <div class="col-8">
                                    <h5 class="my-3"><?= $property['fullname'] ?></h5>
                                    <p class="text-muted mb-1">User ID: <?= $property['account_id'] ?></p>

                                    <?php if($isRenting == 'yes'): ?>
                                        <button class="btn btn-success mt-3" id='apply_button' disabled>Apply</button>
                                    <?php else: ?>
                                        <button class="btn btn-success mt-3" id='apply_button'>Apply</button>
                                    <?php endif; ?>
                                    

                                    <button class="btn btn-primary mt-3" id='message_landlord' <?= $_SESSION['user']['account_type'] == 'landlord' ? 'disabled' : '' ?>>Message</button>
                                    <button class="btn btn-primary mt-3" id='visit_account'>Visit Account</button>
                                    <button class="btn btn-danger mt-3" id='report_button'> Report </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Property Details -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <img src="image/post_property_image/<?= $property['post_images'] ?>" alt="Property" class="card-img-top img-fluid" style="height: 400px; object-fit: cover; border-radius: 10px;">
                                <h3 class="card-title mt-3 mb-3"><?= $property['post_title'] ?></h3>
                                <h5 class="mb-3" style="color: #728C69;">₱<?= number_format($property['post_price'], 2) ?> per month</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-bed me-2"></i>Rooms</span>
                                        <span class="badge rounded-pill" style="background-color: #728C69;"><?= $property['room_count'] ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-bath me-2"></i>Bathrooms</span>
                                        <span class="badge  rounded-pill" style="background-color: #728C69;"><?= $property['bathroom_count'] ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-vector-square me-2"></i>Area</span>
                                        <span class="badge rounded-pill" style="background-color: #728C69;"><?= $property['sqr_meters'] ?> m²</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Property Images Carousel -->
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div id="propertyImageCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($property_images as $index => $image): ?>
                                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                <img src="image/post_property_image/<?= $image['image_name'] ?>" alt="Property Image" class="d-block w-100 img-fluid" style="height: 600px; object-fit: cover; border-radius: 10px;">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#propertyImageCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#propertyImageCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Description -->
                        <div class="mb-4 p-3 rounded card-body border shadow">
                            <h4 class="mb-3" style="color: #728C69;">Description</h4>
                            <p class="text-dark"><?= nl2br(htmlspecialchars($property['post_description'])) ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Map Div -->
                        <div class=" mt-4 border shadow mx-auto" style="height: 500px; width:80%" id='map'> </div>
                        <br>
                    </div>
                </div>
            </div>
    </div>
    <!-- Bootstrap JS -->
    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/sidebar.jquery.php'); ?>
    <?php require('public_component/sweetAlert.php'); ?>
    <script>
        
        $(document).ready(function(){

            let latitude = $("#latitude").val();
            let longitude = $("#longitude").val();

            let map = L.map('map', { center: [ latitude, longitude ],zoom: 15});

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
            }).addTo(map);

            landmark = L.marker([latitude, longitude]).addTo(map)

            $('#message_landlord').click((e)=>{
                e.preventDefault();
                $.ajax({
                    url : '../backend/message.listing.php',
                    method : 'POST',
                    data : {
                        landlord_id : $('#landlord_id').val()
                    },
                    success : () => {
                        window.location.href = 'user.messages.convo.php';
                    }

                })
            });

            $('#visit_account').click((e)=>{
                e.preventDefault();
                $.ajax({
                    url : '../backend/user.visit_account.php',
                    method : 'POST',
                    data : {
                        visit_account_id : $('#landlord_id').val(),
                        account_type : $('#account_type').val()
                    },
                    success : (response) => {
                        window.location.href = response;
                    }
                })
            });





            $("#close_report").click(()=>{
                $("#reportPopup").hide()
            })

            $("#report_button").click(()=>{
                $("#reportPopup").show()
            })

            $("#submit_report").click(()=>{
                $.ajax({
                    url : "../backend/submit_report.php",
                    method : "post",
                    data : {
                        report_account_id : $("#landlord_username").val(),
                        report_account_fullname : $("#landlord_fullname").val(),
                        post_id : $("#post_id").val(),
                        report_message: $("#report_message").val(),
                        report_reason: $("#report_reason").val(),
                        sender_fullname: $("#sender_fullname").val()
                    },
                    success : (response) => {
                        alertSuccess("report submited")
                        $("#reportPopup").hide()
                    }
                })
            })




            $("#apply_button").click(()=>{
                $("#applyPopup").show()
            })
            
            $("#close_apply").click(()=>{
                $("#applyPopup").hide()
            })


            $("#submit_apply").click(()=>{
                $.ajax({
                    url : "../backend/apply_submit.php",
                    method : "post",
                    data : {
                    tenant_fullname : $("#tenant_fullname").val(),
                    contact_phone : $("#contact_phone").val(),
                    contact_email : $("#contact_email").val(),
                    num_occupants : $("#num_occupants").val(),
                    move_in_date : $("#move_in_date").val(),
                    employment_work : $("#employment_work").val(),
                    post_id : $("#post_id").val(),
                    landlord_id : $("#landlord_id").val(),
                    tenant_id : $("#tenant_id").val()
                    },
                    success : (respond) => {
                        switch(respond) {
                            case "success":
                                alertSuccess("request submited")
                                $("#applyPopup").hide()
                            break;

                            case "empty":
                                alertError("please input all the information in the field");
                            break;

                            case "invalid date":
                                alertError("invalid date you cant set lower than todays date");
                            break;
                        }
                    }
                })
            })

        });

    </script>
</body>
</html>