<?php
require "../vendor/autoload.php";
require_once "../model/curl_model.php";
require_once "../helper/helper.php";

// Create instance of the curl_model
$curl = new Curl_Model();

//Fetch id or record to delete
$id = isset($_POST['delete_id']) ? $_POST['delete_id'] : die();

//Fetch name of file to be removed
$name = isset($_POST['delete_name']) ? $_POST['delete_name'] : die();

// HTTP call to delete the record
$response = $curl->destroy($id);

// Convert response to JSON
$status = json_decode($response);

// Remove file from filesystem
if ($status->status) {
    unlink('uploads/' . $name);
}

// Helper method to redirect the user to the home page
redirect_home();
die();