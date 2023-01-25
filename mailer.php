<?php
$allowedMethod = ['POST'];
$to = '';
$from = '';
$subject = '';
$message = '';


// Check if the request method is GET
if (!in_array($_SERVER['REQUEST_METHOD'], $allowedMethod)) {
    // Return an error response
    returnError('Invalid request method', 405);
    exit;
}

$body = file_get_contents("php://input");
$data = json_decode($body, true);

$allowedFields = ['name', 'email'];
$setFields = [];

// Check if all required fields are set
foreach ($allowedFields as $field) {
    if (!isset($data[$field]) || empty($data[$field])) {
        $setFields[] = $field;
    }
}

// Check if all required fields are set
if (!empty($setFields)) {
    returnError('Missing fields: ' . implode(', ', $setFields));
    exit;
}

// Check if email is valid
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    returnError('Invalid email address');
    exit;
}


// Send the email
sendMail($to, $from, $subject, $message);

// Function to return an error response
function returnError($errorMessage, $statusCode = 400)
{
    header('Content-Type: application/json');
    http_response_code($statusCode);
    echo json_encode(array('success' => false, 'error' => $errorMessage));
    exit;
}

// Function to return a success response
function returnSuccess($sucessMessage)
{
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode(array('success' => true, 'message' => $sucessMessage));
    exit;
}

function sendMail($to, $from, $subject, $message)
{
    $headers = "From: $from";
    mail($to, $subject, $message, $headers, "-f " . $from);
    returnSuccess('E-Mail sent');
    exit;
}

?>