<?php

require_once ('../backend/Aglobal_file.php');

$randomNum = rand(1,10);
$query = "select * from post_property join landlords on post_property.landlord_id = landlords.account_id where post_property.post_status = 'active' LIMIT 6 offset $randomNum";
$property_data = $database->get($query, [], 'fetchAll');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="icon" type="image/x-icon" href="image/website_image/logo-house1-removebg.png">
    <style>
        
       
    </style>
</head>
<body style="margin: 0;">
    <!-- navbar-->

    <?php require('public_component/navbar.php'); ?>


    <input id='property_info' type="hidden" value=<?=json_encode($property_data)?>>


    <!-- first page-->
    <div class="container-fluid p-0" style="position: relative; z-index: 1;">
        <div class="card vh-100 border-0" style="background-color: #f8f9fa;">
            <div class="row h-100 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 px-5 text-center text-lg-start" >
                    <h1 class="display-3 fw-bold" style="color: #1c3302; font-family: 'Arial', sans-serif;">Find Your Ideal Home in Dasma!</h1>
                    <p class="lead" style="color: #4c583a;">Need a place to rent in Dasmarinas, Cavite? Explore top listings, compare, and rent easily with our online platform. Find your perfect home today!</p>
                    <div class="mt-4">
                        <a href='login_page.php' class="btn btn-primary btn-lg me-2 shadow" style="background-color: #626F47; border: none;">Login</a>
                        <a href='register_page.php' class="btn btn-secondary btn-lg shadow" style="background-color: #A5B68D; border: none;">Register</a>
                    </div>
                </div>

                <div class="col-lg-6 h-100 d-none d-lg-flex align-items-center ">
                    <div id="homeCarousel" class="carousel slide shadow-lg w-100 " data-bs-ride="carousel">
                        <div class="carousel-inner rounded">
                            <div class="carousel-item active">
                                <img class="d-block w-100 img-fluid" src="image/website_image/webimg2.jpg" alt="First slide" style="height: 70vh; object-fit: cover;">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 img-fluid" src="image/website_image/webimg3.jpg" alt="Second slide" style="height: 70vh; object-fit: cover;">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 img-fluid" src="image/website_image/webimg1.jpg" alt="Third slide" style="height: 70vh; object-fit: cover;">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 img-fluid" src="image/website_image/webimg2.jpg" alt="Fourth slide" style="height: 70vh; object-fit: cover;">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold" style="color: #4c583a;"> Listings in Dasma</h2>
        </div>

        <div class="row mb-4">
        <?php foreach ($property_data as $property): ?>
            <div class="col-12 col-md-4">
                <form class="container mt-3" action="landing.listing.view.php" method="post">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <img src="image/profile_image/<?php echo htmlspecialchars($property['profile_picture']); ?>" alt="Profile" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                            <div>
                                <h6 class="card-title mb-0"> <?php echo htmlspecialchars($property['fullname']); ?> </h6>
                                <small class="text-muted"><?php echo htmlspecialchars($property['post_created_at']); ?></small>
                            </div>
                        </div>
                        <img src="image/post_property_image/<?php echo htmlspecialchars($property['post_images']); ?>" alt="Property" class="card-img-top img-fluid" style="width:100%; height:300px;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($property['post_title']); ?></h5>
                            <h6 class="mb-2">$<?php echo htmlspecialchars($property['post_price']); ?></h6>
                            <div class="d-flex justify-content-between mb-2">
                                <small class="text-muted"><?php echo htmlspecialchars($property['room_count']); ?> Rooms • <?php echo htmlspecialchars($property['bathroom_count']); ?> Baths • <?php echo htmlspecialchars($property['sqr_meters']); ?> m²</small>
                            </div>
                            <p class="card-text small"><i class="bi bi-geo-alt-fill"></i> <?php echo htmlspecialchars($property['post_location']); ?></p>
                            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($property['post_id']); ?>">
                            <input type='submit' class="btn btn-sm text-light" value='View Post' style="background-color: #A5B68D">
                        </div>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>    
        </div>

        <!--<div class="row mt-4">
            <div class="col-12 text-end">
                <a href="#" class="btn btn-lg btn-outline-light text-dark shadow"> See More</a>
            </div>
        </div> -->
    </div>
    
    <div class="container text-center mx-auto">
        <select class="form-select form-select-sm rounded-0 mx-auto" id="location" name="location" style="width: 50%; background-color: #f8f9fa; border: 1px solid #ced4da; padding: 0.375rem 0.75rem; font-size: 0.875rem; line-height: 1.5; color: #495057;">
            <option value=""> select barangay </option>
            <option value="niugan">niugan</option>
            <option value="st joseph village">st joseph village</option>
            <option value="golden city subdivision">golden city subdivision</option>
            <option value="cabuyao">cabuyao</option>
            <option value="mabuhay homes subdivision">mabuhay homes subdivision</option>
            <option value="villa anthurium">villa anthurium</option>
        </select>
    </div>
    <div class="container border shadow" style="height: 500px;" id='map'>
        
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4" style="color: #1c3302; font-size: 2.5rem; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">Why Choose Us?</h2>
        <p class="text-center mb-4 text-muted">At QuickTira, we're committed to making your property search in Dasmarinas, Cavite as smooth and efficient as possible. Here's why we stand out:</p>
        <div class="row justify-content-center">
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm transition-hover">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <i class="fas fa-list-ul fa-3x mb-3" style="color: #4c583a;"></i>
                        <h5 class="card-title" style="color: #4c583a; font-weight: bold;">Extensive Listings</h5>
                        <p class="card-text">Discover a wide range of properties in Dasmarinas, Cavite, tailored to every need and budget. From cozy apartments to spacious family homes, we have it all.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm transition-hover">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <i class="fas fa-balance-scale fa-3x mb-3" style="color: #4c583a;"></i>
                        <h5 class="card-title" style="color: #4c583a; font-weight: bold;">Easy Comparison</h5>
                        <p class="card-text">Effortlessly compare properties side by side with our intuitive platform. Our detailed listings and comparison tools help you make informed decisions quickly.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm transition-hover">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <i class="fas fa-handshake fa-3x mb-3" style="color: #4c583a;"></i>
                        <h5 class="card-title" style="color: #4c583a; font-weight: bold;">Reliable Service</h5>
                        <p class="card-text">Experience trustworthy support throughout your entire rental journey. Our dedicated team is always ready to assist you, from property viewing to lease signing.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm transition-hover">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <i class="fas fa-map-marked-alt fa-3x mb-3" style="color: #4c583a;"></i>
                        <h5 class="card-title" style="color: #4c583a; font-weight: bold;">Local Expertise</h5>
                        <p class="card-text">Benefit from our team's in-depth knowledge of the Dasmarinas, Cavite real estate market. We provide valuable insights on neighborhoods, amenities, and property values to guide your decision.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <?php require('public_component/contact.php'); ?>
    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/contact_script.php'); ?>
    <?php require('public_component/sidebar.jquery.php'); ?>
    <script>
        
        $(document).ready(function(){
            
            let map;

            $.ajax({
                url : '../backend/map_landmarks.php',
                success : (response) => {
                    let res = JSON.parse(response)
                    console.log(res)    
                    
                    map = L.map('map', { center:[ 14.27540325018385 , 121.12392425537111 ],zoom: 14});

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19
                    }).addTo(map);

                    for(property of res)
                    {   
                        let component = 
                        `
                            <form action="landing.listing.view.php" method="post" >
                                <input type='hidden' name="post_id" value='${property.post_id}' >
                                <input type="submit" value="view" class='btn btn-primary'>
                            </form>
                        `
                        L.marker([ property.latitude,  property.longitude]).addTo(map)
                        .bindPopup(component)
                    }

                }                
            })


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

        })
    </script>
</body>
</html>