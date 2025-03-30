<?php
    require_once('../backend/Aglobal_file.php');
    require("../backend/check_user_session.php");   
    $query = 'select * from post_property join landlords on post_property.landlord_id = landlords.account_id where landlords.account_id = ?';

    $property_data = $database->get($query, [$_SESSION['user']['account_id']], 'fetchAll');

    $landlord_name = $_SESSION['user']['fullname'];
    $landlord_id = $_SESSION['user']['account_id'];
    $isVerified = $_SESSION['user']['isRenting'];

    $database->update_session();
   
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="icon" type="image/x-icon" href="image/website_image/logo-house1-removebg.png">
    <style>
        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
        }
        .custom-file-input::before {
            content: 'Select file';
            display: inline-block;
            background: linear-gradient(top, #f9f9f9, #e3e3e3);
            border: 1px solid #999;
            border-radius: 3px;
            padding: 5px 8px;
            outline: none;
            white-space: nowrap;
            cursor: pointer;
            text-shadow: 1px 1px #fff;
            font-weight: 700;
            font-size: 10pt;
        }
        .custom-file-input:hover::before {
            border-color: black;
        }
        .custom-file-input:active::before {
            background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
        }
    </style>
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
            <?php if($isVerified == "yes"): ?>
            <div class="container mt-3">
                <div class="container mt-3">
                    <h4 class="mb-3 text-center">Add New Listing</h4>
                    <form action="#" method="POST" enctype="multipart/form-data" id='addPostForm' class="mx-auto" style="max-width: 700px;">
                        <div class="row g-2">
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label small">Title</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="title" name="title" required>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="image" class="form-label small">Main Image</label>
                                <input type="file" class="form-control form-control-sm rounded-0" id="image" name="image" accept="image/*">
                            </div>
                        </div>
                        <div id="mainImgContainer" class="mb-2"></div>
                        <div class="mb-2">
                            <label for="images" class="form-label small">Additional Images</label>
                            <input type="file" class="form-control form-control-sm rounded-0" id="images" name="images[]" multiple accept="image/*">
                        </div>
                        <div id="imgContainer" class="mb-2"></div>
                        <div class="mb-2">
                            <label for="address" class="form-label small">Address</label>
                            <input type='text'class="form-control form-control-sm rounded-0" id="address" name="address" required>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-4 mb-2">
                                <label for="price" class="form-label small">Price</label>
                                <input type="number" class="form-control form-control-sm rounded-0" id="price" name="price" step="0.01" required>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="location" class="form-label small">Location</label>
                                <select class="form-select form-select-sm rounded-0" id="location" name="location" required>
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
                                <label for="sqr_meter" class="form-label small">Square Meters</label>
                                <input type="number" class="form-control form-control-sm rounded-0" id="sqr_meter" name="sqr_meter" step="0.01" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6 mb-2">
                                <label for="room_count" class="form-label small">Room Count</label>
                                <input type="number" class="form-control form-control-sm rounded-0" id="room_count" name="room_count" min="1" value="1" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="bathroom_count" class="form-label small">Bathroom Count</label>
                                <input type="number" class="form-control form-control-sm rounded-0" id="bathroom_count" name="bathroom_count" min="1" value="1" required>
                            </div>
                        </div>
                        <div id='map' class="container border" style='height:400px'>
                            
                        </div>
                        <div class="mb-2">
                            <label for="description" class="form-label small">Description</label>
                            <textarea class="form-control form-control-sm rounded-0" id="description" name="description" rows="2" required></textarea>
                        </div>
                        <div>
                            <input type="hidden" id='latitude' name='latitude'>
                            <input type="hidden" id='longitude' name='longitude'>
                        </div>
                        <div class="">
                            <button id='btn-addPost' class="btn btn-primary btn-sm rounded-0 container">Submit</button>
                        </div>                     
                    </form>
                    <br><br>
                </div>
            </div>
        </div>

        <?php else: ?>
            
            <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg- text-white" style="background: #4c583a;">
                        <h1 class="text-center mb-0">Upload Valid ID or Papers</h1>
                    </div>
                    <div class="card-body">
                        <p class="text-center mb-4"> upload a picture of your valid ID before you can proceed with posting.</p>
                        <p> upload atleast one of the following</p>
                        <ul class="list-group">
                            <li class="list-group-item">Philippine Passport</li>
                            <li class="list-group-item">Unified Multi-Purpose ID (UMID)</li>
                            <li class="list-group-item">Professional Regulation Commission (PRC) ID</li>
                            <li class="list-group-item">Social Security System (SSS) Card</li>
                            <li class="list-group-item">Government Service Insurance System (GSIS) eCard</li>
                            <li class="list-group-item">Voter’s ID</li>
                        </ul>

                        <form action="#" method="POST" enctype="multipart/form-data" id="landlord_verification">
                            <div class="mb-3">
                                <label for="verification_img" class="form-label">Select your ID or papers:</label>
                                <input type="file" class="form-control custom-file-input" id="verification_img" name="verification_img" accept="image/*" required>
                            </div>
                            <input type="hidden" id="landlord_id" name="landlord_id" value="<?=$landlord_id?>">
                            <input type="hidden" id="landlord_name" name="landlord_name" value="<?=$landlord_name?>">
                            <div class="d-grid">
                                <button type="submit" id="btn_landlord_verification" style="background: #4c583a;" class="text-light btn btn-">Submit Verification</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php endif ?>

    </div>

    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/sweetAlert.php'); ?>
    <?php require('public_component/sidebar.jquery.php'); ?>

<script>

    $(document).ready(() => {

        
        $('#btn_landlord_verification').click((e)=> {
            e.preventDefault();

            let myFormData = new FormData($('#landlord_verification')[0]);

            $.ajax({
                url: '../backend/landlord.verification.php',
                method: 'POST',
                data: myFormData,
                contentType: false,
                processData: false,
                success: (response) => {
                    console.log(response)
                    let res = JSON.parse(response)
                    switch(res.type)
                    {
                        case 'success':
                            alertSuccess(res.text)
                        break;

                        case 'error':
                            alertError(res.text)
                        break;
                    }                 
                },
            });
          
        })







        map = L.map('map', { center: [ 14.27540325018385 , 121.12392425537111 ],zoom: 13});

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
        }).addTo(map);

        let landmark = L.marker([0, 0]);

            map.addEventListener('click', (event) => {
                let latitude = event.latlng.lat;
                let longitude = event.latlng.lng;

                landmark.remove()

                landmark = L.marker([latitude, longitude]).addTo(map)
                
                $("#latitude").val(latitude)
                $("#longitude").val(longitude)

            });

        $("#location").change((event)=>{
            let location = event.target.value

            switch(location)
            {
                case "niugan":
                        map.setView([ 14.262809181736962 , 121.12748622894289 ], 16)
                    break;

                    case "st joseph village":
                        map.setView([ 14.282439448180474 , 121.13868713378906 ], 16)
                    break;

                    case "golden city subdivision":
                        map.setView([ 14.292084533511252 , 121.1169719696045 ], 16)  
                    break;

                    case "cabuyao":
                        map.setView([ 14.278365106906739 , 121.12332344055176 ], 16)  
                    break;

                    case "mabuhay homes subdivision":
                        map.setView([ 14.288136594680278 , 121.12001895904542 ], 16)  
                    break;

                    case "villa anthurium":
                        map.setView([ 14.284103930776915 , 121.1134958267212 ], 16)  
                    break;
            }
        })


        $('#image').change((e) => {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(e) {
                $('#mainImgContainer').append('<img src="' + e.target.result + '" style="width: 100px; height: 100px; margin-right: 10px; margin-bottom: 10px;">');
            };
        })
        
        $('#images').change((e) => {

            var files = e.target.files;
            
            $('#imgContainer').empty();

            Array.from(files).forEach((file) => {

                var reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onload = function(e) {
                    $('#imgContainer').append('<img src="' + e.target.result + '" style="width: 100px; height: 100px; margin-right: 10px; margin-bottom: 10px;">');
                };
            });
        });


        $('#btn-addPost').click((e)=> {
            e.preventDefault();

            let myFormData = new FormData($('#addPostForm')[0]);

            $.ajax({
                url: '../backend/landlord.add_post.php',
                method: 'POST',
                data: myFormData,
                contentType: false,
                processData: false,
                success: (response) => {
                    console.log(response)
                    let res = JSON.parse(response)
                    switch(res.type)
                    {
                        case 'success':
                            alertNormal("success", "post uploaded successfuly", () => {
                                window.location.reload();
                            });
                        break;

                        case 'error':
                            alertError(res.text)
                        break;
                    }                 
                },
            });
          
        })

    });

</script>


</body>
</html>