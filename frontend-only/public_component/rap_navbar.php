
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
  <style>
    /* css ng sidebar */
    .sidenav {
      height: 100%;
      width: 220px;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #faf7f0;
      overflow-x: hidden;
      overflow-y:auto;
      transition: 0.5s;
      padding-top: 30px;
      
      
    }
    .sidenav::-webkit-scrollbar {
    display: none;
    }
    

    .sidenav a {
      padding: 5px 5px 5px 16px;
      text-decoration: none;
      font-size: 25px;
      color: black;
      display: block;
      transition: 0.2s;
    }

    .sidenav a:hover {
      color: #f1f1f1;
    }

   
    
    .resize {
      margin: -155px 20px -30px -142px;
    }

    .img {
      width: 220px;
      height: 220px;
      overflow: hidden;
    }

    .side-menu a {
      text-decoration: none;
      display: block;
      line-height: 60px;
      transition: 0.3s;
    }

    .side-menu a:hover {
      background: #a5b68d;
      padding-left: 15px;
    }

    .side-menu span {
      font-size: 20px;
      margin-left: 10px;
      color: black;
    }

    .side-menu i {
      font-size: 20px;
      margin-left: 20px;
      color: #626f47;
    }
    .button1:hover{
      background-color:#626f47;
      color:white;
 
    }

    /* media query ng sidebar and navbar */
    @media screen and (max-width: 621px){
      .sidebarTemplate{
        display:none;
      }
      .navbarTemplate{
        display:block;
      }
    }
    @media screen and (min-width: 1439px){
      .navbarTemplate{
        display: none;
      }
    }

    @media screen and (min-width: 574px){
      .navbarTemplate{
        display: none;
      }
    } 

    /* css ng navbar */
    #mynavbar.show {
      background:linear-gradient(to right,#223b05, #a5b68d);
      opacity: 0.92;     
  }
  #mynavbar{
    width: 100%; 
  }
  .navbar-nav .nav-item {
    padding: 10px 15px; 
  }
  .navbar-nav {
    justify-content: end; 
    width: 100%; 
  }
  .navbar-nav .nav-link{
    font-weight: bold;
    color:#f1f1f1;
    font-family: Arial;
  }
  .navbar-nav .nav-link:hover{
  color: #f1f1f1;
  position:relative;
}
.navbar-nav .nav-link::after {
  content: '';
  position: absolute;
  width: 100%;
  height: 2px;
  bottom: 0;
  left: 0;
  background:linear-gradient(to right,#4c583a, #223b05);
  transform: scaleX(0);
  transition: transform 0.2s ease;
}

.navbar-nav .nav-link:hover::after {
  transform: scaleX(1);
}
/* Para sumama yung navbar kada scroll */
.navbar {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000;
}

body {
  padding-top: 100px; 
} 

.main-content {
  padding-top: 100px;
}
  </style>

<div class="navbarTemplate">
  <nav class="navbar navbar-expand-sm" style="background:linear-gradient(to right,#223b05, #7d8b68); opacity: 0.92; height:75px;">
    <div class="container-fluid p-0 m-0">
      <a class="navbar-brand" href="#">
        <img src="image/website_image/imag-logo1.png" style="height:80px; position:relative; bottom:10px;">
        <b style="font-family:League Spartan,Arial, Helvetica; color:#f1f1f1; font-size:25px; position:relative; bottom:8px;" class="logo">QuickTira</b>
      </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar" aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation" style="position:relative; bottom:15px;"> 
        <span class="navbar-toggler-icon"></span>
      </button> 
      <div class="collapse navbar-collapse" id="mynavbar" style="position:relative; bottom:23px;">
        <ul class="navbar-nav ms-auto">
          <div class="side-menu">
            <!-- <a href="#" class="closebtn" onclick="closeNav()">&times;</a> -->
            
              <br>
              <a href="#">
                <i class="fa-solid fa-user text-light"></i>
                <span class="text-light">Account</span>
              </a>
              <a href="#">
                <i class="fa-solid fa-house text-light"></i>
                <span class="text-light">Account</span>
              </a>
              <a href="#">
                <i class="fa-solid fa-note-sticky text-light"></i>
                <span class="text-light">Account</span>
              </a>
              <a href="#">
                <i class="fa-solid fa-landmark text-light"></i>
                <span class="text-light">Account</span>
              </a>
              <a href="#">
                <i class="fa-solid fa-circle-info text-light"></i>
                <span class="text-light">Account</span>
              </a>
              <a href="#">
                <i class="fa-solid fa-circle-arrow-right text-light"></i>
                <span class="text-light">Log out</span>
              </a>
            
            </div>
        </ul>
      </div>
    </div>
  </nav>
</div>


<div class="sidebarTemplate">
<div class="row">
  <div class="col-sm-12">
    <div id="mySidenav" class="sidenav">
      <div class="side-menu">
      <!-- <a href="#" class="closebtn" onclick="closeNav()">&times;</a> -->
        <div class="img">
          <img src="image/imag-logo1.png" class="resize">
        </div>
        <div class="text-center">
          <h2>QuickTira</h2>
        </div>
        <br>
        <a href="#">
          <i class="fa-solid fa-user"></i>
          <span>Account</span>
        </a>
        <a href="#">
          <i class="fa-solid fa-house"></i>
          <span>Account</span>
        </a>
        <a href="#">
          <i class="fa-solid fa-note-sticky"></i>
          <span>Account</span>
        </a>
        <a href="#">
          <i class="fa-solid fa-landmark"></i>
          <span>Account</span>
        </a>
        <a href="#">
          <i class="fa-solid fa-circle-info"></i>
          <span>Account</span>
        </a>
        <a href="#">
          <i class="fa-solid fa-circle-arrow-right"></i>
          <span>Log out</span>
        </a>
      
      </div>
    </div>
  </div>
</div>
