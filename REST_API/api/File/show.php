<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

require_once('../../config/database.php');
require_once('../../model/File_Model.php');

$database   =   new Database();
$file_model  =   new File_Model($database->connect());

$file_model->id   =   isset($_GET['id']) ? $_GET['id'] : die('Please provide a valid id');

if($file_model->show()){

    print_r(json_encode([
        "id" => $file_model->id,
        "name" => $file_model->name,
        "extension" => $file_model->extension,
        "mime_type" => $file_model->mime_type,
        "size" => $file_model->size,
        "md5" => $file_model->md5,
        "dimensions" => $file_model->dimensions,
        "created_at" => $file_model->created_at,
    ]));


}else{

    echo json_encode(['message' => 'No record found']);
    http_response_code(404);
    die();

}

