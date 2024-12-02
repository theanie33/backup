<?php

//frontend purpose data
define('SITE_URL','http://127.0.0.1/MyWebsite/');
define('ABOUT_IMG_PATH',SITE_URL.'images/about/');
define('CAROUSEL_IMG_PATH',SITE_URL.'/images/carousel/');
define('FEATURES_IMG_PATH',SITE_URL.'/images/features/');

//backend upload process needs this data
define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] .'/MyWebsite/images/');
define('ABOUT_FOLDER', 'about/');
define('CAROUSEL_FOLDER', 'carousel/');
define('FEATURES_FOLDER', 'features/');

function adminLogin()
{
    session_start();
    if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] === true)) {
        echo "<script>
            window.location.href='index.php';
            </script>";
        exit;
    }
}

function redirect($url){
    echo "<script>
    window.location.href='$url';
    </script>";
    }
    function alert($type,$msg){
      $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    
    echo <<<alert
      <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
      <strong class="me-3">$msg</strong> 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>  </button>
    </div>
    alert;
    }


function uploadImage($image, $folder)
{
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img'; // Invalid image format
    } elseif (($image['size'] / (1024 * 1024)) > 2) {
        return 'inv_size'; // File size exceeds 2MB
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . ".$ext";

        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'upd_failed'; // File upload failed
        }
    }
}

function deleteImage($image,$folder)
{
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
      return true;  
    }
    else{
        return false;
    }
}

function uploadSVGImage($image, $folder)
{
    $valid_mime = ['image/svg+xml'];
    $img_mime = $image['type'];

    // Validate MIME type
    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img'; // Invalid image format
    }

    // Validate file size
    if (($image['size'] / (1024 * 1024)) > 1) { // Limit: 1MB
        return 'inv_size';
    }

    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $rname = 'IMG_' . random_int(11111, 99999) . ".$ext";
    $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

    // Ensure folder exists
    if (!file_exists(UPLOAD_IMAGE_PATH . $folder)) {
        mkdir(UPLOAD_IMAGE_PATH . $folder, 0777, true);
    }

    // Validate temporary file existence
    if (!file_exists($image['tmp_name'])) {
        error_log("Temporary file not found: " . $image['tmp_name']);
        return 'upd_failed';
    }
    if (!is_readable($image['tmp_name'])) {
        error_log("Temporary file is not readable: " . $image['tmp_name']);
        return 'upd_failed';
    }

    // Attempt to move the file
    if (move_uploaded_file($image['tmp_name'], $img_path)) {
        return $rname;
    } else {
        error_log("Failed to move uploaded file: From {$image['tmp_name']} to $img_path");
        return 'upd_failed';
    }
}



?>
