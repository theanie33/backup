<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel - FACILITIES</title>

  <?php require('admin/inc/links.php'); ?>
  <style>
    .pop:hover {
        border-top-color: var(--teal) !important;
    }
  </style>
  <link rel="stylesheet" href="admin/css/common.css">
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?> <!-- Only include this here -->

<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        Odio id voluptas, <br>obcaecati ipsa consequuntur quas inventore similique 
        saepe praesentium corrupti!
    </p>
</div>

<div class="container">
    <div class="row">
        <!-- Facility 1 -->
        <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-items-center mb-2">
                    <img src="images/Facilities/wifi.webp" width="40px">
                    <h5 class="m-0 ms-3">Wifi</h5>  
                </div>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque quidem laudantium cupiditate, consequuntur fugiat magni.</p>
            </div>
        </div>
        
        <!-- Facility 2 -->
        <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-items-center mb-2">
                    <img src="images/Facilities/parking.webp" width="40px">
                    <h5 class="m-0 ms-3">Parking</h5>  
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque quidem laudantium cupiditate, consequuntur fugiat magni.</p>
            </div>
        </div>

        <!-- Facility 3 -->
        <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-items-center mb-2">
                    <img src="images/Facilities/pool.jpg" width="240px">
                    <h5 class="m-0 ms-3">Swimming Pool</h5>  
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque quidem laudantium cupiditate, consequuntur fugiat magni.</p>
            </div>
        </div>

        <!-- Facility 4 -->
        <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-items-center mb-2">
                    <img src="images/Facilities/spa.webp" width="40px">
                    <h5 class="m-0 ms-3">Spa</h5>  
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque quidem laudantium cupiditate, consequuntur fugiat magni.</p>
            </div>
        </div>

        <!-- Facility 5 -->
        <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-items-center mb-2">
                    <img src="images/Facilities/gym.webp" width="40px">
                    <h5 class="m-0 ms-3">Gym</h5>  
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque quidem laudantium cupiditate, consequuntur fugiat magni.</p>
            </div>
        </div>

        <!-- Facility 6 -->
        <div class="col-lg-4 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-items-center mb-2">
                    <img src="images/Facilities/restaurant.webp" width="40px">
                    <h5 class="m-0 ms-3">Restaurant</h5>  
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque quidem laudantium cupiditate, consequuntur fugiat magni.</p>
            </div>
        </div>

    </div>
</div>

<?php require('admin/inc/footer.php'); ?>

</body>
</html>
