<?php
require_once 'includes/request.php';
require_once 'includes/response.php';

$data = array(
    "name" => "Name",
    "surname" => "Surname",
    "age" => 19
);

$sendResponse = sendResponse($data, 200, 'application/json');

echo $sendResponse;