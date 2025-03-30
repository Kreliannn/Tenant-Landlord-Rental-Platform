<?php
require_once ('../backend/Aglobal_file.php');
require("../backend/check_user_session.php");
$database->update_session();

$rental_property = $database->get("select * from taken_property where tenant_id = ?",[$_SESSION['user']["account_id"]], "fetch");

if($rental_property)
{
    $post_id = $rental_property["post_id"];

    $data = $database->get("select * from taken_property where post_id =?", [$post_id], "fetch");

    $landlord_info =  $database->get("select * from landlords where account_id =?", [$rental_property['landlord_id']], "fetch");

    $property_info =  $database->get("select * from post_property where post_id =?", [  $post_id ], "fetch");

    if(empty($data["deadline"]))
    {
        $currentDate = new DateTime();  
        $deadline = new DateTime($data['move_in_date']);
        $deadline->modify('+30 days');

        $interval = $currentDate->diff($deadline);

        $database->update("update taken_property set deadline = ? where property_id = ?", [$deadline->format('Y-m-d'), $data["property_id"]]);

        $days_left = $interval->days;
        $showDeadline = $deadline->format('Y-m-d');
        $today = $currentDate->format('Y-m-d');
    }
    else
    {
        $currentDate = new DateTime();
        $deadline = new DateTime($data["deadline"]);

        if($currentDate >= $deadline)
        {
            $deadline->modify('+30 days');
            $database->update("update taken_property set deadline = ? where property_id = ?", [$deadline->format('Y-m-d'), $data["property_id"]]);
        }

        $interval = $currentDate->diff($deadline);

        $days_left = $interval->days;
        $showDeadline = $data["deadline"];
        $today = $currentDate->format('Y-m-d');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js'></script>
    <link rel="icon" type="image/x-icon" href="image/website_image/logo-house1-removebg.png">
    <style>
        .fc .fc-daygrid-day {
            background-color: #f9f9f9; /* Change the background of day cells */
          
        }

        .fc .fc-day-today {
            background-color: #008000; /* Highlight the current day with a theme green */
        }

    </style>
    <title>Document</title>
</head>
<body>
    <input type="hidden" id="deadline" value="<?php echo htmlspecialchars($showDeadline); ?>">
    <input type="hidden" id="today" value="<?php echo htmlspecialchars($today); ?>">
    <input type="hidden" id="rent_start" value="<?php echo htmlspecialchars($data['move_in_date']); ?>">

    <input type="hidden" id="taken_property_id" value="<?php echo htmlspecialchars($data['property_id']); ?>">
    <input type="hidden" id="post_property_id" value="<?php echo htmlspecialchars($data['post_id'] ); ?>">
    <input type="hidden" id="tenant_id" value="<?php echo htmlspecialchars($data['tenant_id']); ?>">

    

    <div class="row">
        <div class="col-12 col-md-2"> 
            <?php $_SESSION['user']['account_type'] == 'tenant' ? require('public_component/sidebar.tenant.php') : require('public_component/sidebar.landlord.php'); ?>
        </div>          

        <div class="col " style='height:100dvh; overflow:auto'>
        <?php if($rental_property): ?>
            <div class="row p-4">
                <div class="col-md-6 card shadow">
                    <div class="property-info ">
                        <img src="image/post_property_image/<?php echo htmlspecialchars($property_info['post_images']); ?>" class="mt-2" alt="Property Image" style="width: 100%; height: auto;">
                    </div>
                </div>
                <div class="col-md-6 card shadow">
                    <div id="calendar" class='border shadow mx-auto' style='height: 90%; width: 90%;'>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 card shadow">
                    <div class="property-info">
                        <div class="p-4">
                            <h2>Property Details</h2>
                            <p><strong>Address:</strong> <?php echo htmlspecialchars($property_info['address']); ?></p>
                            <p><strong>Price:</strong> <?php echo htmlspecialchars($property_info['post_price']); ?></p>
                            <p><strong>Current Date:</strong> <?php echo htmlspecialchars($today); ?></p>
                            <p><strong>Deadline:</strong> <?php echo htmlspecialchars($showDeadline); ?></p>
                            <p><strong>Days Left:</strong> <?php echo htmlspecialchars($days_left); ?></p>
                            <button class="btn btn-danger" id='leave_btn'>Leave Property</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 card shadow">
                    <div class="tenant-info">
                        <div class="p-4">
                            <h2>landlord Information</h2>
                            <img src="image/profile_image/<?php echo htmlspecialchars($landlord_info['profile_picture']); ?>" class="mb-3" alt="Tenant Profile Image" style="width: 20%; height: auto;">
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($landlord_info['fullname']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($landlord_info['email']); ?></p>
                            <p><strong>Contact:</strong> <?php echo htmlspecialchars($landlord_info['contact']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12 mt-5">
                    <h2 class="text-center mb-4">No Rental Property Found</h2>
                    <p class="text-center">You have not rented any property yet.</p>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>


    <?php require('public_component/scripts.php'); ?>
    <?php require('public_component/sidebar.jquery.php'); ?>
    <script>
        $(document).ready(() => {
            let element = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(element, {
                initialView: 'dayGridMonth',
                events: [
                    {
                        title: 'today',
                        start: $("#today").val(), 
                        backgroundColor: 'white',
                        textColor: 'black' 
                    },
                    {
                        title: 'rent start', 
                        start:  $("#rent_start").val(),  
                        backgroundColor: 'gray', 
                        textColor: 'white' 
                    },
                    {
                        title: 'deadline',
                        start:  $("#deadline").val(),
                        backgroundColor: 'red',
                        textColor: 'white'
                    }
                ]
            });

            calendar.render();






            $("#leave_btn").click(()=>{
                $.ajax({
                    url : "../backend/tenant.leave_property.php",
                    method : "post",
                    data : {
                        taken_property_id : $("#taken_property_id").val(),
                        post_property_id : $("#post_property_id").val(),
                        tenant_id : $("#tenant_id").val()
                    },
                    success : (response) => {
                        window.location.reload();
                    }
                })
            })
        })

    </script>
</body>
</html>