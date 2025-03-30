<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
        *{
    padding: 0;
    margin: 0;
    text-decoration: none;
    list-style: none;
    box-sizing: border-box;
}

nav {
    background: #a5b68d;
    line-height: 50px;
    position: fixed;
    width: 100%;
}

nav ul {
    float: right;
    margin-right: 20px;
}

nav ul li{
    line-height: 50px;
    margin: 0 10px;
}

.side-menu {
    position: relative;
    background: #faf7f0;
    width: 100%;
    height: 100%;
    z-index: 9999; /* Ensures it's always on top */
    top: 0; /* Aligns to the top of the viewport */
    left: 0; /* Aligns to the left of the viewport */
}

.img {
    width: 220px;
    height: 220px;
    overflow: hidden;
}

.resize {
    margin: -135px 20px -30px -142px;
}

.side-menu center div h2 {
    color: #a5b68d;
}

.side-menu a{
    text-decoration: none;
    display: block;
    line-height: 50px;
    transition: 0.4s;
}

.side-menu a:hover {
    background: #a5b68d;
    padding-left: 20px;
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

nav .menu-bar {
    float: right;
    margin-top: 20px;
    display: none;
    margin-right: 20px;
}

#menu {
    display: none;
} 

@media (max-width:850px) {

    .side-menu a span {
        display: none;
    }

    .side-menu center {
        display: none;
    }

    .side-menu {
        width: 100px;
        display: block;
    }

    .side-menu a i {
        display: block;
        line-height: 80px;
        text-align: center;
        margin-left: 0;
        font-size: 35px;
    }

    .side-menu a {
    position : relative;
    bottom : 0px;
}

}

@media (max-width:650px) {

    nav ul {
        display: none;
    }

    .side-menu {
        width: 100%;
        text-align: center;
        display: none;
        background-color: #faf7f0;
        transition: all 0.3s ease;
        padding-top: 60px;
        position: fixed;
        top: 80px;
        height: calc(100% - 50px);
        overflow-y: auto;
    }

    .side-menu a {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .side-menu a i {
        display: inline-block;
        margin-right: 10px;
        font-size: 20px;
    }

    .side-menu a span {
        display: inline-block;
        font-size: 16px;
    }

    

    .side-menu center {
        display: block;
        margin-bottom: 20px;
    }

    .side-menu center .img {
        width: 80px;
        height: 80px;
        margin: 0 auto;
    }

    .side-menu center .img img {
        width: 100%;
        height: auto;
    }

    #menu:checked ~ .side-menu {
        left: 0;
    }

    .side-menu a {
    position : relative;
    bottom : 100px;
}
}

#menu:checked ~ .side-menu {
    left: 0;
} 

.nav-menu a {
      text-decoration: none;
      display: block;
      line-height: 60px;
      transition: 0.3s;
    }

    .nav-menu a:hover {
      background: #a5b68d;
      padding-left: 15px;
    }

    .nav-menu span {
      font-size: 20px;
      margin-left: 10px;
      color: black;
    }

    .nav-menu i {
      font-size: 20px;
      margin-left: 40px;
      color: #626f47;
    }
    .button1:hover{
      background-color:#626f47;
      color:white;
 
    }

    /* media query ng sidebar and navbar */
    @media screen and (max-width: 370px){
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

    </style>

    <div>
    <div class="navbarTemplate">
      <nav class="navbar navbar-expand-sm" style="background:#626F47; height:75px;">
        <div class="container-fluid p-0 m-0">
          <a class="navbar-brand" href="#">
            <b class='text-light ms-3' style="font-family:League Spartan,Arial, Helvetica; color:#f1f1f1; font-size:25px; position:relative; bottom:-2px;" class="logo">QuickTira</b>
          </a>
          <button class="navbar-toggler me-4 bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar" aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation" style="position:relative;"> 
              <span class="navbar-toggler-icon"></span>
          </button> 
          <div class="collapse navbar-collapse" id="mynavbar" style="position:relative; top: 5px;">
            <ul class="navbar-nav ms-auto">
              <div class="nav-menu">
                <!-- <a href="#" class="closebtn" onclick="closeNav()">&times;</a> -->
                
                <a href="user.profile.php" class="text-light">
                <i class="fa-solid fa-user text-light"></i>
                <span class="text-light">Profile</span>
            </a>
            <a href="user.landlord.addpost.php" class="text-light">
                <i class="fa-solid fa-plus-circle text-light"></i>
                <span class="text-light">Add Post</span>
            </a>
            <a href="user.landlord_properties.php" class="text-light">
                <i class="fa-solid fa-home"></i>
                <span>properties</span>
            </a>
            <a href="user.messages.php" class="text-light">
                <i class="fa-solid fa-message text-light"></i>
                <span class="text-light">Messages</span>
            </a>
    
            <a id='logout2' class="text-light">
                <i class="fa-solid fa-sign-out-alt text-light"></i>
                <span class="text-light">Logout</span>
            </a>
                
                </div>
            </ul>
          </div>
        </div>
      </nav>
    </div>
        
     

        <div class="side-menu shadow" id="side-menu" style='height : 100dvh'>
            <div class="d-none d-md-block">
                <center>
                    <div class="img">
                        <img src="image/website_image/imag-logo1.png" class="resize">
                    </div>
                    <div>
                        <h2 style="font-weight: bold;">Landlord</h2>
                    </div>
                </center>
            </div>
            <br>

            <a href="user.profile.php">
                <i class="fa-solid fa-user"></i>
                <span>Profile</span>
            </a>
            <a href="user.landlord.addpost.php">
                <i class="fa-solid fa-plus-circle text-green"></i>
                <span>add post</span>
            </a>
            <a href="user.landlord_properties.php">
                <i class="fa-solid fa-home"></i>
                <span>properties</span>
            </a>
            <a href="user.messages.php">
                <i class="fa-solid fa-message"></i>
                <span>Messages</span>
            </a>
            
        
          
            <a id='logout1' class="">
                <i class="fa-solid fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>

        </div>    
    </div>





















         