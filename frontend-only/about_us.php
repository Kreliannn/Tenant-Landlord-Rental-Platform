<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> About Us Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="image/website_image/logo-house1-removebg.png">
    <style>
  

button:hover{
  background-color:#7d8b68 !important;
  cursor: pointer;
  transition: 0.3s ease-in-out;
}

@media screen and (max-width: 321px){
  p{
    font-size:16px;
  }
  p.hehe{
    font-size:30px;
  }
  .img-fluid.haha{
    height: 270px;
    border-radius:60%;
  }
}
.card-box {
    border-radius: 8px;
    color: black;
    border: solid 2px;
    font-family: sans-serif;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); 
    transition: box-shadow 0.3s ease-in-out;
    box-sizing: border-box;
}

.card-box:hover {
    box-shadow: 0px 12px 24px rgba(30, 71, 2, 0.5); 
}

  </style>
    
</head>

<body>
  
      <?php require('public_component/navbar.php'); ?>
     


      <div class="container" style="margin-top:250px;">
        <div>
          <div class="text-center"style="font-size:50px;">
        <p class="hehe" style="font-family: sans-serif;"> ABOUT US </p>
          </div>
        <h1 style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif ; text-align: center; margin-bottom:40px; font-weight: bolder; margin-top:40px;"> Transforming the Rental Experience: A Digital Platform for Efficient Property and Tenant Management for Clients in cabuyao, laguna
          <hr>
        </h1>
   
       <h4 style="text-align:center; margin-bottom:150px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif "> Welcome to QuickTira! Come and see our mission, vision, and values in our website</h4>
        <div class="card" style="border:none;"> 
          </div>
          <div class="card-body">
            <div class="row" style="margin-top: 150px;">
              <div class="col-sm-6">
                <div style="font-size:40px; margin-top:30px; ">
                  <b style="color:#223b05"> About Us </b>
                </div>
                <div style="font-size: 20px; font-family: sans-serif;">
                  <p> QuickTira is a digital platform designed to simplify the rental process in cabuayo, Laguna. Whether you're a tenant searching for a home or a landlord managing properties, we're here to make everything smooth, transparent, and easy for everyone.
                  </p>
                </div>
              </div>
                
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-sm-2">

                  </div>
                  <div class="col-sm-9">
                <img class="img-fluid" src="image/website_image/house-work.gif" style="width:350px;">
                  </div>
                </div>
              </div>
            </div>

            <div class="row" style="margin-top:120px;">
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-sm-2">
                  </div>
                    <div class="col-sm-7">
                        <img class="img-fluid" src="image/website_image/house-to-rent.jpg" style="height:300px;">
                    </div>
                </div>
              </div>
                
              <div class="col-sm-6" style="margin-bottom:150px;">
                <div style="font-size:30px; margin-top:50px;">
                  <b style="color:#223b05"> Our Mission </b>
                </div>
                <div style="font-size:20px; font-family: sans-serif;">
                <p> Our mission is to create an efficient platform that connects tenants and landlords seamlessly. QuickTira simplifies property rentals by offering real-time communication, detailed property listings, and a hassle-free payment system. We are dedicated to building trust through transparency, responsiveness, and ease of use.
                </p>
                </div>
              </div>
            </div>

            <div class="row" style="margin-top:120px; margin-bottom:150px;">
              <div class="col-sm-6">
                <div style="font-size:30px; margin-top:80px;">
                <b style="color:#223b05"> Why We Exist </b>
                </div>
                <div style="font-size:20px; font-family: sans-serif;">
                     <p> Renting in cabuyao, Laguna often involves hurdles like unreliable information and lack of long-term rental options. Tenants struggle to find suitable homes, while landlords face challenges managing their properties. QuickTira addresses these issues by providing a reliable, transparent platform tailored for long-term rentals.
                </div>
                </p>
              </div>
                
              <div class="col-sm-6">
                <img class="img-fluid" src="image/website_image/house_for_rent.jpg">
              </div>
            </div>

            <div class="row" style="margin-top:140px;">
              <div class="col-sm-12 text-center">
                <div style="font-size:40px; font-family: sans-serif;">
                <b style="color:#223b05"> What We Offer </b>
                </div>
                <hr>
              </div>
                
              <div class="col-sm-12">
                <div class="container-fluid">
                  <div class="row text-center">
                   <!---->
                    <div class="col-sm-1">

                    </div>
                    <div class="col-sm-2 ms-1 mt-1 p-4 card-box" style="border-radius:8px; color:black; border-color: #223b05; border:solid 2px; border-color: #223b05; font-family:sans-serif">
                      <b> Effortless Property Management </b>
                      <p> Landlords can manage listings, tenants, payments, and maintenance in one place. </p>
                    </div>
                    
                    <div class="col-sm-2  ms-1 mt-1 p-4 card-box" style="border-radius:8px; color:black; border:solid 2px; border-color: #4c583a; font-family:sans-serif">
                      <b> Real-Time Availability </b>
                      <p> Only view properties that are currently available for rent. </p>
                    </div>

                    <div class="col-sm-2  ms-1 mt-1 p-4 card-box" style="border-radius:8px; color:black; border:solid 2px; border-color: #626F47;font-family:sans-serif">
                      <b> Instant Communication </b>
                      <p> Chat directly between tenants and landlords for inquiries, viewings, and negotiations. </p>
                    </div>

                    <div class="col-sm-2 ms-1 mt-1 p-4 card-box" style="border-radius:8px; color:black; border:solid 2px; border-color: #7d8b68; font-family:sans-serif">
                      <b> Location-Based Search </b>
                      <p> Filter by barangays in Dasmariñas to easily find homes in your preferred area. </p>
                    </div>

                    <div class="col-sm-2  ms-1 mt-1 p-4 card-box" style="border-radius:8px; color:black; border:solid 2px; border-color: #a5b68d; font-family:sans-serif">
                      <b> Reviews and Ratings </b>
                      <p> Tenants and landlords can leave feedback after rentals to build trust. </p>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>

            <br><br><br><br><br><br><br><br>
            
            <div class="row">
              <div class="col-sm-6" style="position:relative; bottom:100px;">
                <img class="img-fluid" src="image/website_image/discuss.jpg">
              </div>
                
              <div class="col-sm-6" style="position:relative; bottom:100px;">
                <div style="font-size: 30px; margin-top:60px;">
                   <b style="color:#223b05"> Our Vision </b>
                </div>
                <div style="font-size:20px; font-family: sans-serif;">
                  <p> We aim to make renting as easy as a few clicks. As QuickTira grows, we plan to expand to new areas, enhance management tools, and add features that make renting even more efficient for everyone involved.
                  </p>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  


    
  </div>
  <footer class="row text-light py-5" style="background-color: #626F47; margin-top: 80px; font-family: Poppins;">
    <div class="col-1"></div>
    <div class="col-md-2  ms-md-3 ms-0 text-center text-md-start">
        <h4 class="mb-4" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Follow Us</h4>
        <ul class="list-unstyled">
            <li><i class="fas fa-phone mr-2"></i> Stay connected!</li> <br>
            <li><i class="fas fa-envelope mr-2"></i> quicktira@gmail.com</li>
            <li><i class="fas fa-envelope mr-2"></i> quicktiraFbPage</li>
            <li><i class="fas fa-fax mr-2"></i> quicktiratiktok</li>
            <li><i class="fas fa-mobile-alt mr-2"></i> quicktiraTg</li>
        </ul>
        <p class="mt-4">&copy; 2024 Quickitira. All Rights Reserved.</p>
    </div>
    <div class="col-md-3  ms-md-3 ms-0 text-center text-md-start">
        <h4 class="mb-4" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Contact Our Team</h4>
        <ul class="list-unstyled">
            <li><i class="fas fa-phone mr-2"></i> Address: 123 Rental Lane, City, State, Zip</li> <br>
            <li><i class="fas fa-phone mr-2"></i> 123-4567-890</li> 
            <li><i class="fas fa-envelope mr-2"></i> 123-654-754</li> 
            <li><i class="fas fa-fax mr-2"></i> 123-4567-890</li> 
            <li><i class="fas fa-mobile-alt mr-2"></i> 1234567890</li>
        </ul>
       
    </div>
    <div class="col-md-5">
        <h4 class="mb-4 ms-3" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Contact Form</h4>
        <div class="mx-3 mx-md-0">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" id='first_name' class="form-control" placeholder="First name" style="background-color: box-shadow: 0 0 5px black inset; color:gray; box-shadow: 0 0 5px black inset">
                </div>
                <div class="col">
                    <input type="text" id='last_name' class="form-control" placeholder="Last name" style="background-color: box-shadow: 0 0 5px black inset;  color: gray; box-shadow: 0 0 5px black inset">
                </div>
            </div>
            <div class="mb-3">
                <input type="text"  id='email' class="form-control" placeholder="email" style="background-color: box-shadow: 0 0 5px black inset;  color: gray; box-shadow: 0 0 5px black inset">
            </div>
            <div class="mb-3">
                <textarea id='message' class="form-control" rows="3" placeholder="Message" style="background-color: box-shadow: 0 0 5px black inset;  color: gray; box-shadow: 0 0 5px black inset"></textarea>
            </div>
            <button id='contact_btn' class="btn text-dark bg-light" style='background:#626F47'>Send Message</button>
        </div>
    </div>
</footer>

<?php require('public_component/scripts.php'); ?>
<?php require('public_component/contact_script.php'); ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
