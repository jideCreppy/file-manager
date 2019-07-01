<?php
require "../vendor/autoload.php";
require_once "../model/curl_model.php";


$curl = new Curl_Model();


$id = isset($_POST['delete_id']) ? $_POST['delete_id'] : die();
$name = isset($_POST['delete_name']) ? $_POST['delete_name'] : die();


$response = $curl->destroy($id);

$status = json_decode($response);

if($status->status){
    unlink('uploads/'.$name);
}

header('Location: index.php');
die();