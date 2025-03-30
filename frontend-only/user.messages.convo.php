<?php
    require_once '../backend/Aglobal_file.php';
    require("../backend/check_user_session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="image/website_image/logo-house1-removebg.png">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .message-container {
            height: calc(100vh - 130px);
            overflow-y: auto;
            padding: 20px;
            background-color: #F4F6FF;
            height: 80dvh;
            display: flex;
      
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }
        .message {
            max-width: 70%;
            margin-bottom: 12px;
            padding: 12px 16px;
            border-radius: 15px;
            clear: both;
            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            font-size: 14px;
            line-height: 1.4;
        }
        .sender {
            background-color: #a5b68d;
            color: #ffffff;
            align-self: flex-end;
            border-bottom-right-radius: 4px;
        }
        .receiver {
            background-color: #ffffff;
            color: #333333;
            align-self: flex-start;
            border-bottom-left-radius: 4px;
            border: 1px solid #e0e0e0;
        }
        .header {
            background-color: #626F47;
            color: white;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .footer {
            background-color: #626F47;
            padding: 15px;
            box-shadow: 0 -2px 4px rgba(0,0,0,0.1);
        }
        #messageInput {
            border: none;
            border-radius: 20px;
            padding: 10px 15px;
        }
        #btn_send {
            border-radius: 20px;
            padding: 10px 20px;
        }
    </style>
</head>
<body style='width: 100%; overflow: hidden;'>
   

    <input type="hidden" id='convo_id' value='<?php echo htmlspecialchars($_SESSION['convo_id']); ?>'>
    <input type="hidden" id='user' value='<?php echo htmlspecialchars(json_encode($_SESSION['user'])); ?>'>
    <div class="row">
        <div class="col-12 col-md-2 d-none d-md-block">
            <?php $_SESSION['user']['account_type'] == 'tenant' ? require('public_component/sidebar.tenant.php') : require('public_component/sidebar.landlord.php'); ?>
        </div>          
        <div class="col m-0 p-0"  style='height:100dvh; overflow:auto'>
            <div class="container-fluid h-100 d-flex flex-column p-0 m-0">
                <!-- Header -->
                <div class="row m-0">
                    <div class="col p-0">
                        <div class="header d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img id='receiver_image' src="image/profile_image/DEFAULT_PROFILE.png" alt="Receiver" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                <h5 class="mb-0" id='receiver_name'>Receiver Name</h5>
                            </div>
                            <a href="user.messages.php" class="btn btn-light">Back</a>
                        </div>
                    </div>
                </div>
                <!-- Body -->
                <div class="row flex-grow-1 m-0">
                    <div class="col p-0">
                        <div class="message-container" id="messageContainer">
                            <!-- Messages will be dynamically inserted here -->
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <div class="row m-0">
                    <div class="col p-0">
                        <div class="footer">
                            <form class="d-flex align-items-center">
                                <input type="text" id="messageInput" class="form-control me-2" placeholder="Type a message..." style="background-color: white; color: #626F47;">
                                <button type="button" class="btn btn-light" id='btn_send'>Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/sidebar.jquery.php'); ?>
    
    <script type='module'>

        let user = JSON.parse($('#user').val());
        let convo_id = $('#convo_id').val();

        $(document).ready(()=>{
    
            $.ajax({
                url : '../backend/messenger.fetch_convo_info.php',
                success : (response) => {
                    let res = JSON.parse(response);
                    $('#receiver_image').attr('src', `image/profile_image/${res.profile_picture}`);
                    $('#receiver_name').text(res.fullname);
                }
            })

            
        })

        
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.14.1/firebase-app.js";
        import { getFirestore, collection, addDoc, onSnapshot, query, where, orderBy, serverTimestamp } from "https://www.gstatic.com/firebasejs/10.14.1/firebase-firestore.js";

        const firebaseConfig = {
            apiKey: "AIzaSyClpggSiin_WXHwlc0AM-jUiwZK_4DENHs",
            authDomain: "test-c6a7a.firebaseapp.com",
            projectId: "test-c6a7a",
            storageBucket: "test-c6a7a.appspot.com",
            messagingSenderId: "236410288126",
            appId: "1:236410288126:web:ff00bd9636ad60e20772af"
        };

        

        const app = initializeApp(firebaseConfig);

        const db = getFirestore(app);       

        let messages = collection(db, 'quicktira_client4');

        let q = query(messages, where('convo_id', '==', Number(convo_id)), orderBy('createdAt', 'desc'));

       

        onSnapshot(q, (snapshot) => {
            let Allmessage = [];
            snapshot.forEach((doc) => {
                Allmessage.push(doc.data());
            });

            if (Allmessage.length < 10) {
                $('#messageContainer').css('flex-direction', 'column');
                Allmessage.reverse();
            } else {
                $('#messageContainer').css('flex-direction', 'column-reverse');
            }
            
            $('#messageContainer').empty();

            Allmessage.forEach((message) => {
                if(message.sender == user.fullname){
                    $('#messageContainer').append(`
                        <div class="message sender d-flex align-items-start justify-content-end">
                            <div class="message-content">
                                <p class="mb-0 fs-5 fs-sm-6 fs-md-5">${message.text}</p>
                            </div>
                        </div>
                    `);
                }
                else
                {
                    $('#messageContainer').append(`
                        <div class="message receiver d-flex align-items-start">
                            <div class="message-content">
                                <p class="mb-0 fs-5 fs-sm-6 fs-md-5">${message.text}</p>
                            </div>
                        </div>
                    `);
                }
            })
          
        })  



        $('#btn_send').click((e)=>{
            e.preventDefault();
           
            addDoc(messages , {
                convo_id : Number(convo_id),
                text : $('#messageInput').val(),
                sender : user.fullname,
                createdAt : serverTimestamp(),
            })

            $('#messageInput').val('');
        })



    </script>
     
</body>
</html>