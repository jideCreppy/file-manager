<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow_Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Header, Access-Control-Allow_Methods, Content-Type, X-Requested-With');

require_once('../../config/database.php');
require_once('../../model/File_Model.php');

$request_data = json_decode(file_get_contents("php://input"));

$database   =   new Database();
$file_model  =   new File_Model($database->connect());


$file_model->name = $request_data->name;
$file_model->extension = $request_data->extension;
$file_model->mime_type = $request_data->mime_type;
$file_model->size = $request_data->size;
$file_model->md5 = $request_data->md5;
$file_model->dimensions = $request_data->dimensions;


if(!empty($request_data) && $file_model->create()){

    echo json_encode(['message' => 'Record Saved']);

}else{

    echo json_encode(['message' => 'Record Not Saved']);
    http_response_code(404);
    die();
}

