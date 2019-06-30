<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow_Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Header, Access-Control-Allow_Methods, Content-Type, X-Requested-With');

require_once('../../config/database.php');
require_once('../../model/File_Model.php');

$request_data = json_decode(file_get_contents("php://input"));

$database   =   new Database();
$file_model  =   new File_Model($database->connect());


$file_model->id = $request_data->id;


if(!empty($request_data) && $file_model->delete()){

    echo json_encode(['message' => 'Record deleted','status' => true]);

}else{

    echo json_encode(['message' => 'Nothing to delete']);
    http_response_code(404);
    die();
}
