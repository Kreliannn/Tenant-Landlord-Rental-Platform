<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="image/website_image/logo-house1-removebg.png">

    <style>
        body {
            overflow-x: hidden;
        }

        .form {
            position: relative;
            top: 390px;
            left: 50%;
            max-width: 900px;
            width: 100%;
            background-color: #faf7f0;
            transform: translate(-50%, -50%);
            box-shadow: 0px 8px 10px #888888;
            border-radius: 20px;
        }

        .form .form-box {
            display: flex;
        }

        .form-box .form-details {
            max-width: 400px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: url('image/website_image/regsiterimg.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .form-box .form-details::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3); /* Adjust the alpha value to make it darker or lighter */
            z-index: 1;
        }

        .size {
            font-size: 45px; 
            color: #626f47;
            text-align: left;
        }

        .form-box .form-content {
            width: 100%;
            padding: 35px;
        }

        form button {
            width: 100%;
            outline: none;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            padding: 14px 0;
            border-radius: 5px;
            margin: 25px 0;
            color: white;
            cursor: pointer;
            background: #626f47;
        }

        hr {
            background-color: #253a01;
            height: 4px;
            margin: 10px 0;
        }

        @media (max-width: 760px) {
            .form {
                width: 95%;
            }

            .form-box .form-details {
                display: none;
            }

            .form-box .form-content {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <!--navbar start-->

    <?php require('public_component/navbar.php'); ?>
    

    <!--navbar end-->

    <!--register form start-->

    <div class="form" style="overflow: hidden;">
        <div class="form-box">
            <div class="form-details">

            </div>
            <div class="form-content row">
                <p class="fw-bold size col">Register</p>
                <!-- <span class="">Quicktira</span> -->
                 <p class="col fw-bold" style="text-align: right; margin-top: 30px; color: #626f47;">QuickTira</p>
                <form action="#">
                    <div class="row">
                        
                        <div class="col">
                            <input type="text" placeholder="First Name" name="firstname" id="firstname" class="form-control col" required>
                            <label for="firstname"></label>
                        </div>
                        
                        <div class="col">
                            <input type="text" placeholder="Surname" name="lastname" id="lastname" class="form-control col" required>
                            <label for="lastname"></label>
                        </div>    
                        
                    </div>

                    <div class="form-wrapper">
                        <input type="email" placeholder="Email Address" name="email" id="email" class="form-control" required>
                        <label for="email"></label>
                    </div>

                    <div class="row">
                        
                        <div class="col">
                            <select name="userType" id="userType" class="form-control col" required>
                                <option value="tenant">Tenant</option>
                                <option value="landlord">Landlord</option>
                            </select>
                            <label for="userType"></label>
                        </div>
                        
                        <div class="col">
                            <input type="text" placeholder="Contact Number" name="contactNumber" id="contactNumber" class="form-control col" required>
                            <label for="contactNumber"></label>
                        </div>    
                        
                    </div>

                    <div class="row">
                        
                        <div class="col">
                            <input type="text" placeholder="Username" name="username" id="username" class="form-control col" required>
                            <label for="username"></label>
                        </div>
                        
                        <div class="col">
                            <input type="password" placeholder="Password" name="password" id="password" class="form-control col" required>
                            <label for="password"></label>
                        </div>    
                        
                    </div>

                    <div class="row">
                        <div class="col-6 col-md-5">
                            <input type="checkbox" class="ms-2 custom-control-input" id="termsConditions" required>
                            <font class='text-muted' style="; font-size: small; text-decoration: underline;" id='showTerms'>Terms & Agreement</font>   
                        </div>

                        <div class="col">
                            <hr>
                        </div>

                    </div>

                    <button type="submit" id="register_btn">Register</button>
                </form>
            </div>
        </div>
      </div>

      <br><br><br><br><br>

      <!--registers form end-->

      <!--footer start-->

      <?php require('public_component/contact.php'); ?>
      <?php require('public_component/scripts.php'); ?>
      <?php require('public_component/contact_script.php'); ?>

      <!--footer end-->

      <!--terms and condition-->

      <div id="termsModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.6);" id='footer'>
        <div class="modal-content" style="background-color: #fefefe; margin: 5% auto; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 90%; max-width: 800px;">
            <h1 class="mb-4" style="color: #7d8b68; font-weight: bold;">Terms and Conditions</h1>
            <p>Welcome to QuickTira. By using our services, you agree to comply with and be bound by the following terms and conditions:</p>
            <ol>
                <li>You must be at least 18 years old to use our services.</li>
                <li>You agree to provide accurate and complete information when creating an account.</li>
                <li>You are responsible for maintaining the confidentiality of your account information.</li>
                <li>You agree not to use our services for any illegal or unauthorized purpose.</li>
                <li>We reserve the right to modify or terminate our services at any time without notice.</li>
                <li>You agree to comply with all applicable laws and regulations while using our services.</li>
                <li>You acknowledge that all content is protected by intellectual property rights.</li>
                <li>We are not liable for losses from your use of our services.</li>
                <li>You agree to indemnify us against claims from your use of our services.</li>
                <li>Any disputes arising from these terms will be resolved through arbitration.</li>
            </ol>
            <p>By using QuickTira, you acknowledge that you have read, understood, and agree to be bound by these terms and conditions.</p>
            <button id="closeTerms" class="btn text-light btn-lg mt-4" style="background:#7d8b68; padding: 10px 30px; font-weight: bold;">Close</button>
        </div>
      </div>



    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/contact_script.php');?>
    <?php require('public_component/sweetAlert.php'); ?>
    

    <script>
        
        $(document).ready(()=>{

            $("#showTerms").click(()=>{
               $("#termsModal").show();
            })

            $("#closeTerms").click(()=>{
               $("#termsModal").hide();
            })

            $("#register_btn").click((event)=>{
                event.preventDefault();
                $.ajax({
                    url : "../backend/home.register.php",
                    method : "post",
                    data : {
                        firstname : $('#firstname').val(),
                        lastname : $('#lastname').val(),
                        email : $('#email').val(),
                        type : $('#userType').val(),
                        contact : $('#contactNumber').val(),
                        username : $('#username').val(),
                        password : $('#password').val(),
                        terms_condition : $('#termsConditions').prop('checked')
                    },
                    success : (response) => {
                        console.log(response)
                        let res = JSON.parse(response);
                        switch(res.type)
                        {
                            case 'success':
                               alertSuccess(res.text)
                                $('#firstname').val("")
                                $('#lastname').val("")
                                $('#email').val("")
                                $('#contactNumber').val("")
                                $('#username').val("")
                                $('#password').val("")
                            break;

                            case 'error':
                                alertError(res.text)
                            break;
                        }
                    }
                })
            })


            $('a').click((event) => {

                event.preventDefault();
                
                const inputs = [
                    $('#firstname').val(),
                    $('#lastname').val(),
                    $('#email').val(),
                    $('#contactNumber').val(),
                    $('#username').val(),
                    $('#password').val()
                ];

                let confirms = false;

                inputs.forEach(input => {
                    if (input !== '') {
                        confirms = true;
                    }
                });

                if (confirms) 
                {
                    let text = "You have entered some information. Are you sure you want to leave this page?";
                    alertConfirm(text, ()=>{
                        window.location.href = event.target.href;
                    })
                }
                else
                {
                    window.location.href = event.target.href;
                }
            });


        })

    </script>
</body>
</html>