<?php
    require_once ('../backend/Aglobal_file.php');
    $property = $database->get('select * from post_property join landlords on post_property.landlord_id = landlords.account_id where post_id = ?', [$_POST['post_id']], 'fetch');
    $property_images = $database->get('select * from property_post_pictures where post_id = ?', [$_POST['post_id']], 'fetchAll');

  
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
    <title>QuickTira</title>
    <link rel="icon" type="image/x-icon" href="image/website_image/logo-house1-removebg.png">
</head>
<body>

    <?php require('public_component/navbar.php'); ?>

    <input type="hidden" id='latitude' value="<?= $property['latitude'] ?>">
    <input type="hidden" id='longitude' value="<?= $property['longitude'] ?>">

    <br><br>
<!--
    <div class="row mt-4">
        <div class="col-12">
            <a href="landing_page.php" class="btn btn-primary">Back to Landing Page</a>
        </div>
    </div>-->
    <div class="container mt-5">
                
                <div class="row">
                    <div class="col-md-6">
                        <!-- Property Details -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <img src="image/post_property_image/<?= $property['post_images'] ?>" alt="Property" class="card-img-top img-fluid" style="height: 400px; object-fit: cover; border-radius: 10px;">
                                <h3 class="card-title mt-3 mb-3"><?= $property['post_title'] ?></h3>
                                <h5 class="mb-3" style="color: #728C69;">₱<?= number_format($property['post_price'], 2)?> per month</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-bed me-2"></i>Rooms</span>
                                        <span class="badge rounded-pill" style="background-color: #728C69;"><?= $property['room_count'] ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-bath me-2"></i>Bathrooms</span>
                                        <span class="badge rounded-pill" style="background-color: #728C69;"><?= $property['bathroom_count'] ?></span>
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

    <?php require('public_component/contact.php'); ?>

    <!-- Bootstrap JS -->
    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/contact_script.php'); ?>
    <?php require('public_component/sidebar.jquery.php'); ?>

    <script>
        $(document).ready(function(){

            let latitude = $("#latitude").val();
            let longitude = $("#longitude").val();

            let map = L.map('map', { center: [ latitude, longitude ],zoom: 15});

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(map);

            landmark = L.marker([latitude, longitude]).addTo(map)

        })
    </script>

</body>
</html>