<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="image/website_image/logo-house1-removebg.png">

    <style>

        .form{
            position: relative;
            top: 340px;
            left: 50%;
            max-width: 720px;
            width: 100%;
            background-color: #faf7f0;
            transform: translate(-50%,-50%);
            box-shadow: 10px  8px 10px #888888;
        }

        .form .form-box {
            display: flex;
        }

        .size {
            font-size: 55px; 
            color: #626f47;
            text-align: center;
        }

        .form-box .form-content{
            width: 100%;
            padding: 35px;
        }

        .form-box .form-details{
            max-width: 330px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: url('image/website_image/loginhouse.jpg');
            background-size: cover;
        }

        form .input-field {
            height: 50px;
            width: 100%;
            margin-top: 20px;
            position: relative;
        }

        form .input-field input {
            width: 100%;
            height: 89%;
            outline: none;
            padding: 0 15px;
            font-size: 1rem;
            font-weight:700;
            border-radius: 25px;
            border: 2px solid #626f47;
            color: #181C14
        }

        .input-field input:is(:focus, :valid) {
            padding: 16px 15px 0;
        }

        form .input-field label{
            font-weight: bold;
            color: #7d8b68;
            position: absolute;
            top: 45%;
            left: 10px;
            pointer-events: none;
            transform: translateY(-50%);
        }

        form button {
            width: 100%;
            outline: none;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            padding: 14px 0;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            background: #626f47;
        }

        .bottom-link {
            font-weight: bold;
            margin-top: 15px;
            text-align: center;
        }

        .input-field input:is(:focus, :valid) ~ label {
            color:  #7d8b68;
            font-size: 0.75rem;
            transform: translateY(-120%);
            position: absolute;
            left:15px;
            bottom: 12px;
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

    <?php require('public_component/navbar.php'); ?>
        
    <br><br>

    <div class="form">
        <div class="form-box">
            <div class="form-details ">

            </div>
            <div class="form-content">
                <p class="fw-bold size">Login</p>
                <form action="#">
                    <div class="input-field">
                        <input id='username'type="text" name="username" required>
                        <label for="">Username</label>
                    </div>
                    <div class="input-field">
                        <input id='password' type="password" name="password" required>
                        <label for="">Password</label>
                    </div>
                    <hr>
                    <button type="submit" id='login_btn' class='shadow'>Log In</button>
                </form>
                <div class="bottom-link">
                    <a href="register_page.php" style="color: rgb(44, 42, 42);">Create Account?</a>
                </div>
            </div>
        </div>
      </div>

      <!--log in form end-->

      <!--footer start-->
      <br><br><br><br><br><br><br>

    <?php require('public_component/contact.php'); ?>

      <!--footer end-->

    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/contact_script.php'); ?>
    <?php require('public_component/sweetAlert.php'); ?>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(() => {
            $('#login_btn').click((e) => {
                e.preventDefault();
                $.ajax({
                    url: '../backend/home.login.php',
                    method: 'POST',
                    data: {
                        username: $("#username").val(),
                        password: $("#password").val()
                    },
                    success: (response) => {
                        if(response == 'success')
                        {
                            window.location.href = 'user.profile.php';
                        }
                        else if(response == "admin")
                        {
                            window.location.href = 'admin.dashboard.php';
                        }
                        else
                        {
                            alertError(response)
                        }
                        
                    },
                });
            });
        });
    </script>
    
</body>
</html>