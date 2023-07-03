<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_token = $_POST['id_token'];
    $CLIENT_ID = '479911254247-einbcc83hp7rfuf5s49cripiqk0ikfjb.apps.googleusercontent.com'; // Replace with your actual client ID

    // Verify the ID token using cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/tokeninfo?id_token=' . $id_token);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response);

    if ($data->aud == $CLIENT_ID) {
        $user_name = $data->name;

        // Return the user's name
        $response = array('success' => true, 'userName' => $user_name);
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'error' => 'Invalid client ID');
        echo json_encode($response);
    }
}
?>