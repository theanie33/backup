<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

// Debugging: Log input data
file_put_contents('debug.log', json_encode($_POST, JSON_PRETTY_PRINT), FILE_APPEND);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

if (isset($_POST['add_room'])) {
    // Safely handle features and facilities data
    $features = isset($_POST['features']) && is_array($_POST['features']) ? $_POST['features'] : [];
    $facilities = isset($_POST['facilities']) && is_array($_POST['facilities']) ? $_POST['facilities'] : [];

    $features = filteration($features);
    $facilities = filteration($facilities);

    $frm_data = [
        'name' => $_POST['name'] ?? '',
        'area' => $_POST['area'] ?? '',
        'price' => $_POST['price'] ?? '',
        'quantity' => $_POST['quantity'] ?? '',
        'adult' => $_POST['adult'] ?? '',
        'children' => $_POST['children'] ?? '',
        'description' => $_POST['desc'] ?? '' // Use 'desc' for the description key
    ];

    // Sanitize the data
    $frm_data = filteration($frm_data);

    // Insert room data
    $q1 = "INSERT INTO `rooms` (`name`, `area`, `price`, `quantity`, `adult`, `children`, `description`) VALUES (?,?,?,?,?,?,?)";
    $values = [
        $frm_data['name'],
        $frm_data['area'],
        $frm_data['price'],
        $frm_data['quantity'],
        $frm_data['adult'],
        $frm_data['children'],
        $frm_data['description']
    ];

    if (!insert($q1, $values, 'siiiiis')) {
        file_put_contents('debug.log', "Query Failed: $q1, Values: " . json_encode($values) . "\n", FILE_APPEND);
        echo json_encode(['status' => 'error', 'message' => 'Room insertion failed']);
        exit;
    }

    $room_id = mysqli_insert_id($con);

    // Insert facilities
    $q2 = "INSERT INTO `room_facilities` (`room_id`, `facilities_id`) VALUES (?, ?)";
    if ($stmt = mysqli_prepare($con, $q2)) {
        foreach ($facilities as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    }

    // Insert features
    $q3 = "INSERT INTO `room_features` (`room_id`, `features_id`) VALUES (?, ?)";
    if ($stmt = mysqli_prepare($con, $q3)) {
        foreach ($features as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    }

    echo json_encode(['status' => 'success', 'message' => 'Room added successfully']);
    exit;
}

// Default response if no operation matches
echo json_encode(['status' => 'error', 'message' => 'Invalid operation']);
exit;
?>
