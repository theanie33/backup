<?php

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();


if (isset($_POST['get_general'])) {
    $q = "SELECT * FROM `settings` WHERE `sr_no`=?";
    $values = [1];
    $res = select($q, $values, "i");
    if ($res) {
        $data = mysqli_fetch_assoc($res);
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Query failed']);
    }
    exit;
}

if (isset($_POST['upd_general'])) {
    $frm_data = filteration($_POST);

    $q = "UPDATE `settings` SET `site_title`=?, `site_about`=? WHERE `sr_no`=?";
    $values = [$frm_data['site_title'], $frm_data['site_about'], 1];
    $res = update($q, $values, 'ssi');
    echo $res ? 1 : 0;
    exit;
}

// Update `shutdown` field in the `settings` table
if (isset($_POST['upd_shutdown'])) {
    $shutdown_value = $_POST['upd_shutdown'];

    $q = "UPDATE `settings` SET `shutdown`=? WHERE `sr_no`=?";
    $values = [$shutdown_value, 1];
    $res = update($q, $values, 'ii');
    echo $res ? 1 : 0;
    exit;
}

if (isset($_POST['get_contacts'])) {
    $q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [1];
    $res = select($q, $values, "i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
}



// Update contact details in the `contact_details` table
if (isset($_POST['upd_contacts'])) {
    $frm_data = filteration($_POST);

    $q = "UPDATE `contact_details` SET `address`=?,`gmap`=?,`pn1`=?,`pn2`=?,`email`=?,`fb`=?,`insta`=?,`tw`=?,`iframe`=? WHERE `sr_no`=?";
    $values = [
        $frm_data['address'],
        $frm_data['gmap'],
        $frm_data['pn1'],
        $frm_data['pn2'],
        $frm_data['email'],
        $frm_data['fb'],
        $frm_data['insta'],
        $frm_data['tw'],
        $frm_data['iframe'],
        1,
    ];
    $res = update($q, $values, 'sssssssssi');
    echo $res;
    exit;
}

// Add team member
if (isset($_POST['add_member'])) {
    $frm_data = filteration($_POST);

    $img_r = uploadImage($_FILES['picture'], ABOUT_FOLDER);

    if ($img_r == 'inv_img') {
        echo $img_r;
    } 
    elseif ($img_r == 'inv_size'){
        echo $img_r;
    } 
    elseif ($img_r == 'upd_failed'){
        echo $img_r;
    } 
    else {
        $q = "INSERT INTO `team_details`(`name`, `picture`) VALUES (?, ?)";
        $values = [$frm_data['name'], $img_r];
        $res = insert($q, $values, 'ss');
        echo $res;
    }
}

if (isset($_POST['get_members'])) {
    $res = selectAll('team_details');
    $output = "";

    while ($row = mysqli_fetch_assoc($res)) {
        $output .= <<<HTML
        <div class="col-md-3 mb-3">
            <div class="card bg-dark text-white">
                <img src="../images/about/{$row['picture']}" class="card-img img-fluid rounded" alt="{$row['name']}">
                <div class="card-img-overlay text-end">
                    <button type="button" onclick="rem_member({$row['sr_no']})" class="btn btn-danger btn-sm shadow-none">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
                <p class="card-text text-center px-3 py-2">{$row['name']}</p>
            </div>
        </div>
        HTML;
    }

    echo $output;
    exit;
}


if(isset($_POST['rem_member']))
{
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_member']];
    $pre_q = "SELECT * FROM `team_details` WHERE `sr_no`=?";
    $res = select($pre_q,$values,'i');
    $img = mysqli_fetch_assoc($res);

    if(deleteImage($img['picture'],ABOUT_FOLDER)){
        $q ="DELETE FROM `team_details` WHERE `sr_no`=?";
        $res = delete($q,$values,'i');
        echo $res;
    }
    else{
        echo 0;
    }

}

?>
